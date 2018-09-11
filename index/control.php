<?php
    header('Content-Type:text/html;charset=utf-8');
    
    if ( ! defined('BASEPATH')) exit('不允许直接访问此文件。');
    
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
    
    require './index/models/news_model.php';
	require './admin/models/base_model.php';
    
    function index(){  // 首页显示
        $news_model = News_Model::getObject();
		$base_model = Base_Model::getObject();
        
        $array = $news_model -> read_data(0);
		$base = $base_model -> getbaseinfo();
        
        require './index/views/index.php';
    }
   
    function newlist(){  // 学院新闻页
        
        $news_model = News_Model::getObject();
        
        $pageid = empty($_GET['pageid'])? 0 : $_GET['pageid'];  // 获取当前页号
        $pageid2 = $pageid;  // 显示当前选择的页码
        if($pageid > 0){
            $pageid *= 20;  // 每页显示20行
        } 
        
        $array = $news_model -> read_data($pageid);
        $rows = $news_model -> num_row();
        $rows = $rows > 100 ? 100 : $rows;  // 最多显示10个分页
        
        require './index/views/new_list.php';    
    }
    
    function newcontent(){  // 学院新闻内容
        $news_model = News_Model::getObject();
        
        if(empty($_GET['id'])){
            header('location: index.php?f=newlist');
        } else {
            $array = $news_model -> read_data_id($_GET['id']);
        }
        
        require './index/views/new_content.php';
    }
    
    function introduction(){  // 学院介绍
        require './index/views/introduction.php';
    }
    
    function course(){  // 课程介绍
        require './index/views/course.php';
    }
    
    function education(){  // 持续教育
        require './index/views/education.php';
    }
    
    function train(){  // 培训团队
        require './index/views/train.php';
    }
    
    function student(){  // 学员风采
    	
    	if (($str = file_get_contents('./index/images3/images')) != false){  // 获取相册的个数和名字
    		$arrImages = json_decode($str, true);
    	}
    
        require './index/views/student.php';
    }
	
	function matter(){  // 常见问题
        require './index/views/matter.php';
    }
	
	function contact(){  // 联系我们
        require './index/views/contact.php';
    }
	
	function teacher1(){
		require './index/views/teacher1.php';
	}
	
	function teacher2(){
		require './index/views/teacher2.php';
	}
    
	function teacher3(){
		require './index/views/teacher3.php';
	}
	
	function teacher4(){
		require './index/views/teacher4.php';
	}
	
	function teacher5(){
		require './index/views/teacher5.php';
	}
	
	function teacher6(){
		require './index/views/teacher6.php';
	}
	
	function teacher7(){
		require './index/views/teacher7.php';
	}

	function teacher8(){
		require './index/views/teacher8.php';
	}
	
	function tuancao(){
		require './index/views/tuancao.php';
	}
	
	function sijiao(){
		require './index/views/sijiao.php';
	}

	function taban(){
		require './index/views/taban.php';
	}

	function yoga(){
		require './index/views/yoga.php';
	}
	
	function enschool(){
		require './index/views/enschool.php';
	}

	function imagelist(){  // 学员风采
		
		if(empty($_GET['im'])){
			header('location: index.php?f=student');
		} else {
			$photo_id = $_GET['im'];
		}
	
		if (is_dir('./index/images3/images' . $photo_id)) {
			$image_dir = './index/images3/images' . $photo_id;
		} else {
			header('location: index.php?f=student');
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
		
        require './index/views/image_list.php';
    }
	
	
    if (empty($_GET['f'])){
        index();
    } else {
        $fun = $_GET['f'];  // 根据url里面的f参数值，选择要调用的函数
        
        if(function_exists($fun)){
            $fun();
        }
    }
?>