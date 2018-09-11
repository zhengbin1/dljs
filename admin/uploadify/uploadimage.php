<?php
	// 新建相册并上传封面
	
	if (($str = file_get_contents('../../index/images3/images')) != false){  // 获取相册的个数和名字
		$arrImages = json_decode($str, true);
		end($arrImages);
		$key = key($arrImages) + 1;
		$arrImages[$key] = '';
		file_put_contents('../../index/images3/images', json_encode($arrImages));
	} else {
		exit;
	}
	
	$imagedir = '../../index/images3/images' . $key;
	chown($imagedir, 'root');
	mkdir($imagedir, 0777);
	
	if (is_dir($imagedir)) {
		
		$ext = strrchr($_FILES["Filedata"]["name"], '.');  // 获取文件的扩展名
		
		$path = $imagedir . '/' . 'fengmian' . $ext;
		
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
		$width = 280;
		$height = 210;
		
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