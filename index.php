<?php
    header('Content-Type:text/html;charset=utf-8');
    define('BASEPATH', 'index');
    
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME']; 
    //$pos = strrpos($_SERVER['SCRIPT_NAME'], '/');
    //$baseurl = 'http://' . $_SERVER['SERVER_NAME'] . substr($_SERVER['SCRIPT_NAME'], 0 ,$pos);
    $request_uri = $_SERVER['REQUEST_URI'];
    
    preg_match('/\/\w*$/', $request_uri, $array);
    
    if(!empty($array)){  // 转换/admin
        if(strcmp($array[0], '/admin') == 0){
            header('location:' . $url . '?c=admin');
        } else if(strcmp($array[0], '/admin') != 0) {
            header('location:' . $url);
        }
    }
	
    // 程序的入口
    if(empty($_GET['c'])){
        require './index/control.php';
    } else if(strcmp($_GET['c'], 'admin') == 0){
        require './admin/control.php';    
    }
	
	include './server/write_client_access.php';
?>