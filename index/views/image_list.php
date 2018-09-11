<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <title>德隆健身培训</title>
        <link type="text/css" rel="stylesheet" href="./index/css/image_list.css" />
        <link type="text/css" rel="stylesheet" href="./index/css/index_head.css" />
        <link type="text/css" rel="stylesheet" href="./index/css/index_bottom.css" />
        <link rel="shortcut icon" href="./index/images/dljs.ico" />
        <link rel="bookmark" href="./index/images/dljs.ico" />
        
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
               <div class="main_title1"><a href="index.php">首页</a>&nbsp;>&nbsp;<a href="index.php?f=student">学员风采</a>&nbsp;>&nbsp;相册</div><br />
               <div class="main_title2">学&nbsp;员&nbsp;风&nbsp;采</div><br />
               <div class="main_content">
                   <?php	
                   		foreach($image_list as $val){                 			
                   			preg_match('/\d+\.(jpg|png|gif)/', $val, $tmp);
							$val2 = preg_replace('/image\d+\.(jpg|png|gif)/', $tmp[0], $val);
                   			echo '<div class="main_content_image">';
							echo '<a href="' . $val2 . '" target="_blank"><img src="' . $val . '"/></a>';
							echo '</div>';
                   		}
                   ?>
               </div>
           </div>
           
           <?php require './index/views/index_bottom.php';?>
        </div>
    </body>
</html>