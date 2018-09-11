<?php
	/* 客户端的访问信息写入数据库 */
	
	$clientAddr = $_SERVER['REMOTE_ADDR'];  	// 浏览当前页面的用户的 IP 地址
	$clientPost = $_SERVER['REMOTE_PORT']; 		// 用户机器上连接到 Web 服务器所使用的端口号
	$HTTP_REFERER = empty($_SERVER['HTTP_REFERER'])? '' : $_SERVER['HTTP_REFERER'];   // 引导用户代理到当前页的前一页的地址
	$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];  // 获取浏览器信息	
	
	$date = date('Y-m-d H:i:s');
	
	$db = new mysqli('localhost','root','');
	$db -> select_db('dljs2');
	$db -> query('set names utf8');
	$strSql = "insert into access_info values(NULL, '{$clientAddr}', {$clientPost}, '{$HTTP_REFERER}', '{$HTTP_USER_AGENT}', '{$date}')";
	$db -> query($strSql);
	$db -> close();
	
	/* 
     *  Table: access_info
		Create Table: CREATE TABLE `access_info` (
		  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
		  `addr` char(32) NOT NULL DEFAULT '' COMMENT '访问用户的IP地址',
		  `post` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户机器上连接到 Web 服务器所使用的端口号',
		  `referer` char(255) NOT NULL DEFAULT '' COMMENT '引导用户代理到当前页的前一页的地址',
		  `agent` char(255) NOT NULL DEFAULT '' COMMENT '浏览器信息',
		  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8
		  PARTITION BY HASH (id)
		  PARTITIONS 10
	 */
?>
