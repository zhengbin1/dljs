<?php
	// 上传图片到相册
	
	if(empty($_POST['images'])){
		exit;
	}
	
	$photo_id = $_POST['images'];
	
	if (is_dir('../../index/images3/images' . $photo_id)) {
		$image_dir = '../../index/images3/images' . $photo_id;
		
		$array = array();
		
		$dh = opendir($image_dir);
	
		while(($fn = readdir($dh)) !== false){
			
			if($fn == '.' || $fn == '..'){
				continue;
			}
			
			if(preg_match('/^\d+/', $fn, $tmp) == true){
				$array[] = $tmp[0];	
			}
		}
		
		closedir($dh);
		
		if(empty($array)){
			$num = 1;
		} else {
			$num = max($array);
			$num ++;  // 文件名里数字的最大值+1
		}
		
		$ext = strrchr($_FILES["Filedata"]["name"], '.');  // 获取文件的扩展名
		
		$path = $image_dir . '/' . $num . $ext;
		
		move_uploaded_file($_FILES["Filedata"]["tmp_name"],  $path);
		
		switch (strrchr($path, '.')) {
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
		
		// 要缩放的尺寸
		$width = 1024;
		$height = 768;
		
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
		
		switch (strrchr($path, '.')) {
			case '.jpg':
				imagejpeg($dst_image, $path);
				break;
			
			case '.png':
				imagepng($dst_image, $path);
				break;
			
			case '.gif':
				imagegif($dst_image, $path);
				break;
		}
		
		imagedestroy($src_image);
		imagedestroy($dst_image);
	}
	
	chown($path, 'root');
	chmod($path, 0777);
?>