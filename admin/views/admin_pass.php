<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>德隆健身网站后台管理</title>
    <script type="text/javascript" src="./index/js/jquery-1.8.3.min.js"></script>
    <link type="text/css" rel="stylesheet" href="./admin/css/admin.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_left.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_pass.css" />
    
    <script type="text/javascript">
        $(document).ready(function (){
            <?php 
            	echo empty($strinfo)?'':$strinfo;
            ?>
        });
        
        //字符串为空
        function isNull(str) {
            if (str == null || str == "" || str.length < 1)
                return true;
            else
                return false;
        }
            
        function form_submit() {          
            
            if(isNull($('#oldpwd').val())){
                alert('原始密码不能为空！');
                $('#oldpwd').focus();
                return false;
            }
            if(isNull($('#newpwd').val())){
                alert('新密码不能为空！');
                $('#newpwd').focus();
                return false;
            }
            if($('#newpwd').val() != $('#newpwd2').val()){  // 新密码和确认新密码如果不一致
                alert('新密码和确认新密码不一致');
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
            <div class="path">网站基本设置&nbsp;>&nbsp;管理员设置&nbsp;>&nbsp;密码修改</div>
            <div class="main_right_pass">
                <form id="form1" name="form1" method="post" action="" onsubmit="javascript:return form_submit();">
                    <table class="table1" width="100%" border="0" cellspacing="1" cellpadding="0">
                      <tr>
                        <td class="tabletitle" colspan="2" >登录密码设置</td>
                      </tr>
                      <tr>
                        <td class="td2" width="50%"><u>原密码</u> <span style="color:#FF0000;">*</span><br />
                        输入原登录密码以确认您有更改权</td>
                        <td class="td2"><input name="oldpwd" type="password" id="oldpwd" class="textbox" maxlength="20" /></td>
                      </tr>
                      <tr>
                        <td class="td1"><u>新密码</u> <span style="color:#FF0000;">*</span><br />
                        设置新登录密码，使用6位以上的字符，设置后请妥善保管密码，以备登录和再次修改密码使用</td>
                        <td class="td1"><input name="newpwd" type="password" id="newpwd" class="textbox" maxlength="20" /></td>
                      </tr>
                      <tr>
                        <td class="td2"><u>确认新密码</u> <span style="color:#FF0000;">*</span><br />
                        再次输入新登录密码，确认无误</td>
                        <td class="td2"><input name="newpwd2" type="password" id="newpwd2" class="textbox" maxlength="20" /></td>
                      </tr>
                      <tr>
                        <td class="td1" colspan="2" align="center">&nbsp;</td>    
                      </tr>
                      <tr>
                        <td class="td2" align="center"><input type="submit" value="保存修改" /></td>
                        <td class="td2" align="center"><input type="reset" value="重新填写" /></td> 
                      </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>