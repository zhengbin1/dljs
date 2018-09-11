<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>德隆健身网站后台管理</title>
    <script type="text/javascript" src="./index/js/jquery-1.8.3.min.js"></script>
    <link type="text/css" rel="stylesheet" href="./admin/css/admin.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_left.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_base.css" />
    
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
        
        function form_submit() {          
	        
            if(isNull($('#beian').val())){
                alert('网站备案信息不能为空！');
                $('#beian').focus();
                return false;
            }
            if(isNull($('#keywords').val())){
                alert('Keywords不能为空！');
                $('#keywords').focus();
                return false;
            }
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
            <div class="path">网站基本设置&nbsp;>&nbsp;网站基本设置</div>
            <div class="main_right_content">
            	<form action="" method="post" onsubmit="javascript:return form_submit();">
                    <table class="table1" width="100%" border="0" cellspacing="1" cellpadding="0">
                          <tr>
                          	 <td class="td1"><u>网站备案信息</u><br />
								显示在网站页面底部，若您的网站已通过备案，可在此输入备案号 (在线备案与查询 <a href="http://www.miitbeian.gov.cn/" target="_blank" title="工业和信息化部备案网站">www.miitbeian.gov.cn</a>)
							 </td>
							 <td class="td1"><input id="beian" name="beian" type="text" maxlength="50" size="50" value="<?php echo $array['beian'];?>"/></td>
                          </tr>
                          <tr>
                            <td class="td2"><u>Meta Keywords</u><br />
                            Keywords 项出现在页面头部的 Meta 标签中，用于记录关键词，多个关键词用半角逗号 "," 分隔</td>
                            <td class="td2"><textarea id="keywords" name="keywords" rows="3" cols="40" maxlength="200"><?php echo $array['keywords'];?></textarea></td>
                          </tr>
                          <tr>
                            <td class="td1"><u>Meta Description</u><br />
                            Description 项出现在页面头部的 Meta 标签中，用于记录概要描述</td>
                            <td class="td1"><textarea name="descn" rows="8" cols="40" style="margin:10px 0 10px 0;"><?php echo $array['descn'];?></textarea></td>
                          </tr>
                          <tr>
                          	<td class="td2" colspan="2"><u>第三方Script脚本信息 (底部)</u><br />
									此处填加的脚本将加载到页脚</td>
                          </tr>
                          <tr>
                            <td class="td2" colspan="2">
                                <textarea name="script" style="width:98%; height:200px;margin:10px 0 10px 0;"><?php echo $array['script'];?></textarea>
                            </td>
                          </tr>
                    </table>
                    <table class="table2">
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        <tr>
                            <td><input type="submit" value="保   存"/></td>
                            <td><input type="reset"  value="重   置"/></td>
                            <td><a href="index.php?c=admin&f=adminmanage">返&nbsp;&nbsp;回</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>