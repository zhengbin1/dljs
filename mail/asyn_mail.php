<?php
	
	$from = $_POST['from'];        // 发件人
	$to = $_POST['to'];            // 收件人
	$title = $_POST['title'];      // 标题
	$content = $_POST['content'];  // 内容
	
	$headers = 'MIME-Version: 1.0' . "\r\n"; 
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; 
	$headers .= 'From: ' . $from . "\r\n"; 
	
	/*
	 * mail函数的参数：
	 * 1、收件人的E-mail地址；
	 * 2、E-mail的标题；
	 * 3、E-mail的主体内容
	 * 4、E-mail发件人信息
	 */
	mail( $to, $title, $content, $headers);
?>