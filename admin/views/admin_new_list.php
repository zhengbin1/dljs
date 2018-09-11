<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>德隆健身网站后台管理</title>
    <script type="text/javascript" src="./index/js/jquery-1.8.3.min.js"></script>
    <link type="text/css" rel="stylesheet" href="./admin/css/admin.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_left.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_new_list.css" />

    
    <script type="text/javascript">
        $(document).ready(function (){       
            <?php echo empty($strinfo)?'':$strinfo;?>
        });
        
        //字符串为空
        function isNull(str) {
            if (str == null || str == "" || str.length < 1)
                return true;
            else
                return false;
        }
        
        function deleteOne(id){
            if (confirm('是否删除？')){
                window.location.href="index.php?c=admin&&f=adminnewlist&id=" + id + '&del=true' + '&pageid=0';
            } else {
                window.location.href="index.php?c=admin&&f=adminnewlist&id=" + id + '&pageid=0'; 
            }
        }
        
        function batch_del(){  // 批量删除留言
            if(confirm('是否删除？')){
                var array_id = new Array();
                var i = 0;
                $("[name=checkGroup]:checkbox").each(function(){
                    if($(this).attr('checked')){
                        array_id[i] = $(this).val();
                        i++;    
                    }
                });
                if(array_id.length == 0){
                    alert('请选择要删除的信息。');
                } else {
                    var url = 'index.php?c=admin&f=ajaxnewsdel';
                    var data = {'array_id':array_id};
                    var dataType = 'json';
                    $.post(url,data,function (){
                        window.location.href="index.php?c=admin&f=adminnewlist&pageid=0";
                    },dataType);
                }
            }
        }
        
        $(document).ready(function () {  // 全选或是全取消留言的选择
            $('#checkAll').click(function (){
                if($(this).attr('checked') == 'checked'){
                    $('[name=checkGroup]:checkbox').each(function (){
                        $(this).attr('checked', 'checked');
                    });
                }else{
                    $('[name=checkGroup]:checkbox').each(function (){
                        $(this).removeAttr('checked');
                    });
                }
            });
        });
        
        function currpage(pageid){
            window.location.href="index.php?c=admin&f=adminnewlist&pageid=" + pageid;
        }    
    </script>
</head>

<body>
    <div class="head">
        <p class="head_text">德隆健身培训后台管理</p>
        <div class="head_btn">
            <div>当前登录的用户是：<?php echo empty($username)?'':$username;?></div>
            <a href="index.php?c=admin&&f=adminmanage">后台首页</a>&nbsp;&nbsp;
            <a href="index.php" target="_blank">网站首页</a>&nbsp;&nbsp;
            <a href="index.php?c=admin&&f=adminexit">安全退出</a>
        </div>
    </div>
    <div class="main">
        <div class="main_left">
            <?php require './admin/views/admin_left.php';?>
        </div>
        <div class="main_right">
            <div class="path">网站基本设置&nbsp;>&nbsp;新闻发布管理&nbsp;>&nbsp;新闻列表</div>
            <div class="main_right_content">
                <div class="main_right_head"><a href="javascript:void(0);" onclick="batch_del()">批量删除</a></div>
                <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="4%" class="listtitle"><input type="checkbox" id="checkAll" name="checkAll" title="全选/全取消" /></td>
                    <td class="listtitle">文章标题</td>
                    <td width="38%" class="listtitle">发布日期</td>
                    <td width="12%" class="listtitle">管理</td>
                  </tr>
                  <?php
                    if(!empty($array)){
                        foreach($array as $row){
                            echo '<tr>';
                            echo '<td align="center" class="td1"><input type="checkbox" id="checkGroup" name="checkGroup" value="' . $row['id'] . '" /></td>';
                            echo '<td class="td1"><a href="index.php?f=newcontent&id=' . $row['id'] . '" target="_blank">' . mb_substr($row['title'], 0, 20, 'utf-8') . '</a></td>';
                            echo '<td align="center" class="td1">' . $row['time'] . '</td>';
                            echo '<td align="center" class="td1"><a href="index.php?c=admin&f=newupdate&id=' . $row['id'] . '">编辑</a> | <a href="javascript:;" onclick="deleteOne(' . $row['id'] . ')">删除</a></td>';
                            echo '</tr>';
                        }
                    }
                  ?>
                
                </table>
                <div class="paged">                  
                    <?php            
                            $npage = intval(ceil($rows / 10));
                            
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
</body>
</html>