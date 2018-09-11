<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <title>德隆健身培训</title>
        <link type="text/css" rel="stylesheet" href="./index/css/new_list.css" />
        <link type="text/css" rel="stylesheet" href="./index/css/index_head.css" />
        <link type="text/css" rel="stylesheet" href="./index/css/index_bottom.css" />
        <link rel="shortcut icon" href="./index/images/dljs.ico" />
        <link rel="bookmark" href="./index/images/dljs.ico" />
        
        <style type="text/css">
        	.newlist-a{
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
            
            function currpage(pageid){
                window.location.href="index.php?f=newlist&pageid=" + pageid;
            }    
        </script>
    </head>
    <body>
        <?php require './index/views/index_head.php';?>
        
        <div class="head"><img src="./index/images/heng.jpg" /></div>
        
        <div class="bottom">
           <div class="main">
               <div class="main_title1">首页&nbsp;>&nbsp;学院新闻</div><br />
               <div class="main_title2">学&nbsp;院&nbsp;新&nbsp;闻</div><br />
               <div class="main_list">
                   <div class="main_list_content">
                       <?php
                            if(!empty($array)){
                                foreach($array as $row){
                                    $moi = '';
                                    if(mb_strlen($row['title'], 'utf-8') > 30){
                                        $moi = '&nbsp;&nbsp;......';
                                    }
                                    
                                    preg_match('/\d+-\d+-\d+/', $row['time'], $date);
                                    $date = $date[0];   
                                    echo '<p>
                                            <span>●&nbsp;&nbsp;</span>
                                            <span class="span1"><a class="newtitle" href="index.php?f=newcontent&id=' . $row['id'] . '">' 
                                                . mb_substr($row['title'], 0, 30, 'utf-8') . $moi . '</a>
                                            </span>
                                            <span class="span2">' . $date . '</span>
                                            <span class="span2"><a class="detail" href="index.php?f=newcontent&id=' . $row['id'] . '" target="_blank">点击详情</a></span>
                                          </p><br />';
                                }
                            }
                        ?>
                       
                       <div class="paged">
                           <?php            
                                   $npage = intval(ceil($rows / 20));
                                    
                                   if ($npage > 0){
                                   	   echo '<span>&lt;</span>';
                                       for($i = 1, $j = 0; $i <= $npage ; $i++, $j++) {    
                                           if($pageid2 + 1 == $i){
                                               echo '&nbsp;<span class="current2" onclick="currpage(' . $j . ')">&nbsp;' . $i . '&nbsp;</span>&nbsp;';
                                           }else{
                                               echo '&nbsp;<span class="current" onclick="currpage(' . $j . ')">&nbsp;' . $i . '&nbsp;</span>&nbsp;';
                                           }      
                                       }
									   echo '<span>&gt;</span>';
                                   }
                            ?>
                       </div>
                   </div> 
               </div>
           </div>
           
           <?php require './index/views/index_bottom.php';?>
        </div>
    </body>
</html>