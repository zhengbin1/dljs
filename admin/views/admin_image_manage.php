<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>德隆健身网站后台管理</title>
    <script type="text/javascript" src="./index/js/jquery-1.8.3.min.js"></script>
    <link type="text/css" rel="stylesheet" href="./admin/css/admin.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_left.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_image_manage.css" />
    
    <script src="./admin/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="./admin/uploadify/uploadify.css" />
    
    <script type="text/javascript">
    	function form_submit() {                   
            if (confirm('是否删除相册？')){
            	return true;
            } else {
            	return false;
            }
        }
        
        function imagemodifyname(id){
        	var imagename = $('#imagename' + id).val();
        	$.post(
        		'./admin/ajax/uploadimagename.php',
        		{id:id,name:imagename},
        		function(status){
        			if (status == 'true'){
        				alert('相册名修改成功。');
        			}	
        		}
        	);
        }
        
        <?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : './admin/uploadify/uploadify.swf',
				'fileObjName':'Filedata',
				//上传处理程序
				'uploader':'./admin/uploadify/uploadimage.php',
				//浏览按钮的背景图片路径
				'buttonImage':'./admin/uploadify/upload.png',
				//浏览按钮的宽度
				'width':'70',
				//浏览按钮的高度
				'height':'70',
				//在浏览窗口底部的文件类型下拉菜单中显示的文本
				'fileTypeDesc':'支持的格式：',
				//允许上传的文件后缀
				'fileTypeExts':'*.jpg;*.jpeg',
				//上传文件的大小限制
				'fileSizeLimit': '0',
				//上传数量
				'queueSizeLimit' : 1,
				
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
            <div class="path">学员风采&nbsp;>&nbsp;相册管理</div>
            <div class="main_right_content">
            	<br /><br />
            	<form action="./index.php?c=admin&f=adminimagemanage" method="post" onsubmit="javascript:return form_submit();">
            		<?php
                   		if(isset($arrImages)){
                   			foreach($arrImages as $key => $value){
                   				echo '<div class="main_content_image">';
			                   	echo '<div class="content_image">';
			                   	echo '<a href="index.php?c=admin&f=adminimagelist&im=' . $key . '"><img src="./index/images3/images' . $key .  '/fengmian.jpg"/></a>';
			                   	echo '</div>';
			                   	echo '<p class="p1">
			                   		      <input name="images[]" type="checkbox" value="./index/images3/images' . $key .  '" />&nbsp;
			                   			  <input id="imagename' . $key . '" type="text" maxlength="30" value="' . $value . '" />
			                   			  <input id="' . $key . '" type="button" value="修改名称" onclick="javascript:imagemodifyname(this.id);"/>
			                   		  </p>';
			                    echo '</div>';
                   			}
                   		}
                   ?>
                   <p class="p2"><input class="del" type="submit" value="删  除"></p>
            	</form>
            	<br />
            	<p style="font-size:20px;">相册的名字最多只能写30个字，上传完相册的封面图片后相册就自动建好了，封面的图片大小最好为280宽×210高，只能是jpg格式，其他格式不支持。</p>
            	<div class="upload">
        			<p style="font-size:18px;">上传图片，请上传尺寸为280×210的图片，上传完请按F5刷新本页面。</p>
               		<p class="p3"><input id="file_upload" name="file_upload" type="file" multiple="multiple" /></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>