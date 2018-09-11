<?php
	if($argc != 2){
		exit(iconv('utf-8','gb2312',"参数不能少于2个。\n"));
	}
	
	if(!is_dir($argv[1])){
		exit(iconv('utf-8', 'gb2312', "这不是一个目录。"));
	}
	
	$dh = opendir($argv[1]);
	
	while(($fn = readdir($dh)) !== false){
		
		if($fn == '.' || $fn == '..'){
			continue;
		}

		$path = "./{$argv[1]}/{$fn}";

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
			
			echo $array[0] . "\n";
				
			
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
			
			switch (strrchr($array[0], '.')) {
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
	}

	closedir($dh);
?>