<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <title>德隆健身培训</title>
        <link type="text/css" rel="stylesheet" href="./index/css/student.css" />
        <link type="text/css" rel="stylesheet" href="./index/css/index_head.css" />
        <link type="text/css" rel="stylesheet" href="./index/css/index_bottom.css" />
        <link rel="shortcut icon" href="./index/images/dljs.ico" />
        <link rel="bookmark" href="./index/images/dljs.ico" />
        
        <style type="text/css">
        	.student-a{
        		color:#FF0000;
        	}
        </style>
        
        <script type="text/javascript">            
            //字符串为空
            function isNull(str) {
                if (str == null || str == "" || str.length < 1)
                    return true;
                else
                    return false;
            }
               
        </script>
    </head>
    <body>
        <?php require './index/views/index_head.php';?>
        
        <div class="head"><img src="./index/images/heng.jpg" /></div>
        
        <div class="bottom">
           <div class="main">
               <div class="main_title1">首页&nbsp;>&nbsp;学员风采</div><br />
               <div class="main_title2">学&nbsp;员&nbsp;风&nbsp;采</div><br />
               <div class="main_content">
                   <br /><br />
                   <?php
                   		if(isset($arrImages)){
                   			foreach($arrImages as $key => $value){                  				
                   				echo '<div class="main_content_image">';
			                   	echo '<div class="content_image">';
			                   	echo '<a href="index.php?f=imagelist&im=' . $key . '"><img src="./index/images3/images' . $key .  '/fengmian.jpg"/></a>';
			                   	echo '</div>';
			                   	echo '<p class="p1">' . $value . '</p>';
			                    echo '</div>';
                   			}
                   		}
                   ?>
               </div>
           </div>
           
           <?php require './index/views/index_bottom.php';?>
        </div>
    </body>
</html>