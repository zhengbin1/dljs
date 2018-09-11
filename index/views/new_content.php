<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <title>德隆健身培训</title>
        <meta name="keywords" content="<?php echo $array['keywords'];?>"/>
        <meta name="description" content="<?php echo $array['descn'];?>"/>
        <link type="text/css" rel="stylesheet" href="./index/css/index_head.css" />
        <link type="text/css" rel="stylesheet" href="./index/css/new_content.css" />
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
               <div class="main_title1">首页&nbsp;>&nbsp;学院新闻</div>
               <div class="main_title3"><a href="index.php?f=newlist">返&nbsp;回</a></div><br />
               <div class="main_title2">学&nbsp;院&nbsp;新&nbsp;闻</div><br />
               <div class="main_content">
                    <br /><br />
                    <div class="main_content_title"><?php echo $array['title'];?></div>
                    <div class="main_content_time"><?php echo $array['time'];?></div><br />
                    <div class="main_content_body"><?php echo $array['content'];?></div>
               </div>
           </div>
           <div class="blank1"></div>
           
           <?php require './index/views/index_bottom.php';?>
        </div>
    </body>
</html>