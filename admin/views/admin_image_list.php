<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>德隆健身网站后台管理</title>
    <script type="text/javascript" src="./index/js/jquery-1.8.3.min.js"></script>
    <link type="text/css" rel="stylesheet" href="./admin/css/admin.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_left.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_image_list.css" />
    
	<script src="./admin/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="./admin/uploadify/uploadify.css" />
    
    <script type="text/javascript">
    	function form_submit() {                   
            if (confirm('是否删除相片？')){
            	return true;
            } else {
            	return false;
            }
        }
        
    </script>
    
    <script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
					'images'    : '<?php echo $photo_id;?>'
				},
				'swf'      : './admin/uploadify/uploadify.swf',
				'fileObjName':'Filedata',
				//上传处理程序
				'uploader':'./admin/uploadify/uploadimagelist.php',
				//浏览按钮的背景图片路径
				'buttonImage':'./admin/uploadify/upload.png',
				//浏览按钮的宽度
				'width':'70',
				//浏览按钮的高度
				'height':'70',
				//在浏览窗口底部的文件类型下拉菜单中显示的文本
				'fileTypeDesc':'支持的格式：',
				//允许上传的文件后缀
				'fileTypeExts':'*.jpg;*.jpeg;*.png',
				//上传文件的大小限制
				'fileSizeLimit':'4MB',
				//上传数量
				'queueSizeLimit' : 5,
				
				//返回一个错误，选择文件的时候触发
				'onSelectError':function(file, errorCode, errorMsg){
					switch(errorCode) {
						case -100:
							alert("上传的文件数量已经超出系统限制的"+$('#file_upload').uploadify('settings','queueSizeLimit')+"个文件！");
							break;
						case -110:
							alert("文件 ["+file.name+"] 大小超出系统限制的"+$('#file_upload').uploadify('settings','fileSizeLimit')+"大小！");
							break;
						case -120:
							alert("文件 ["+file.name+"] 大小异常！");
							break;
						case -130:
							alert("文件 ["+file.name+"] 类型不正确！");
							break;
					}
				},
				//检测FLASH失败调用
				'onFallback':function(){
					alert("您未安装FLASH控件，无法上传图片！请安装FLASH控件后再试。");
				},
				//上传到服务器，服务器返回相应信息到data里
				'onUploadSuccess':function(file, data, response){
					alert('文件 ['+file.name+'] 上传成功。');
				}
			});
		});
	</script>
	
</head>

<body>
    <div class="head">
        <p class="head_text">德隆健身培训后台管理</p>
        <div class="head_btn">
            <div>当前登录的用户是：<?php echo empty($username)?'':$username;?></div>
            <a href="index.php?c=admin&&f=adminmanage">后台首页</a>&nbsp;&nbsp;
            <a href="index.php" target="_blank">网站首页</a>&nbsp;&nbsp;
            <a href="index.php?c=admin&&f=adminexit">安全退出</a>
        </div>
    </div>
    <div class="main">
        <div class="main_left">
            <?php require './admin/views/admin_left.php';?>
        </div>
        <div class="main_right">
            <div class="path">相册管理&nbsp;>&nbsp;相册<?php echo empty($photo_id)?'':$photo_id;?></div>
            <div class="main_right_content">
            	<form action="" method="post" onsubmit="javascript:return form_submit();">
            		<?php
                   		if(isset($image_list)){
	                   		foreach($image_list as $val){
	                   			preg_match('/\d+\.(jpg|png|gif)/', $val, $tmp);
								$val2 = preg_replace('/image\d+\.(jpg|png|gif)/', $tmp[0], $val);
	                   			echo '<div class="main_content_image">';
								echo '<a href="' . $val2 . '" target="_blank"><img src="' . $val . '"/></a>';
								echo '<p class="p1"><input name="images[]" type="checkbox" value="' . $val2 .  '"/>&nbsp;选择后点击删除</p>';
								echo '</div>';
	                   		}
                   		}
                   ?>
                   <p class="p2"><input class="del" type="submit" value="删  除"></p>
            	</form>
            	
        		<div class="upload">
        			<p style="font-size:18px;">上传图片，请上传尺寸为1020×700的图片，上传完请按F5刷新本页面。</p>
               		<p class="p3"><input id="file_upload" name="file_upload" type="file" multiple="multiple" /></p>
                </div>
            	
            </div>
        </div>
    </div>
</body>
</html>