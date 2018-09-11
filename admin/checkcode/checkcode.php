<?php
	header('content-type:text/html;charset=utf-8');
	header('content-type:image/png');
	$width = 80;
	$height = 40;
	$codeNum = 4;  // 验证码的位数
	$code = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$num = count($code) - 1;  // 生成验证码的元素个数
	$checkcode='';
	
	putenv('GDFONTPATH=' . realpath('.'));
	$fontfile='arialbd.ttf';	
	
	$image = imagecreatetruecolor($width, $height);
	imagefill($image, 0, 0, imagecolorallocate($image, 255, 255, 255));
	
	$color = array(
		imagecolorallocate($image, 255, 0, 0),
		imagecolorallocate($image, 0, 0, 255),
		imagecolorallocate($image, 0, 255, 0),
		imagecolorallocate($image, 0, 255, 255),
		imagecolorallocate($image, 255, 0, 255)
	);
	
	
	for ($i = 0; $i < 300; $i ++) {  // 绘制干扰像素
		imagesetpixel($image, rand(0, $width), rand(0, $height), imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)));
	}
	
	for($i = 0; $i < $codeNum; $i ++){  // 生成验证码字符
		
		$tmp = $code[rand(0, $num)];
		$checkcode .= $tmp;
		imagettftext($image, 25, 0 , $i * 20, 30, $color[rand(0, 4)], $fontfile, $tmp);
	}
	
	imagepng($image);
	imagedestroy($image);
	
	setcookie('dljs_admin_vcode', $checkcode, time() + 300, '/');
?>