<?php
	$pos = strrpos($_SERVER['SCRIPT_NAME'], '/');
    $baseurl = 'http://' . $_SERVER['SERVER_NAME'] . substr($_SERVER['SCRIPT_NAME'], 0 ,$pos);
	
	$srv_ip = '127.0.0.1'; // 你的目标服务地址
	$srv_port = 80;  //端口   
	$url = $baseurl . '/mail/asyn_mail.php'; // 接收你post的URL具体地址      
	$errno = 0;      // 错误处理   
	$errstr = '';    // 错误处理   
	$timeout = 10;   // 多久没有连上就中断   
	$post_str = "from={$from}&to={$to}&title={$title}&content={$content}";  // 要提交的内容

	// 打开网络的Socket连接   
	$fp = fsockopen($srv_ip,$srv_port,$errno,$errstr,$timeout);   
	if ($fp != false)
	{
		 $content_length = strlen($post_str);   
		 $post_header = "POST {$url} HTTP/1.1\r\n";   
		 $post_header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		 $post_header .= "User-Agent: MSIE\r\n";
		 $post_header .= "Host: " . $srv_ip . "\r\n";
		 $post_header .= "Content-Length: " . $content_length . "\r\n";
		 $post_header .= "Connection: close\r\n\r\n";   
		 $post_header .= $post_str . "\r\n\r\n";   
		 
		 fwrite( $fp, $post_header);

		 fclose($fp);
	}
?> 