<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
    	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <script type="text/javascript" src="./index/js/jquery-1.8.3.min.js"></script>
        <link type="text/css" rel="stylesheet" href="./admin/css/admin_login.css" />
        <script type="text/javascript" language="javascript">
        	//字符串为空
            function isNull(str) {
                if (str == null || str == "" || str.length < 1)
                    return true;
                else
                    return false;
            }
            
        	//生成随机参数
            function getRand() {
                var mydate = new Date();
                var rnd = Math.floor(Math.random() * 9999) + 1;
                var result = mydate.getHours().toString() + mydate.getMinutes().toString() + mydate.getSeconds().toString() + rnd;
                return result;
            }
            
            function changecode(){ // 更换验证码
                $('#checkcode').attr("src","./admin/checkcode/checkcode.php" + "?rnd=" + getRand());
            }
            
             //在客户端验证用户输入合法性
            function confirmInput()
            {
                if(formlogin.username.value == ''){
                    alert('请填写您的用户名!');
                    $('#username').focus();
                    return false;
                }
                
                if(formlogin.password.value == ''){
                    alert('请填写您的密码!');
                    $('#password').focus();
                    return false;
                }
            }
        </script>
    </head>
    <body>
    	<div id="login">
            <h2 class="title">网&nbsp;站&nbsp;后&nbsp;台&nbsp;登&nbsp;录</h2><br />
            <div class="content">
            	<br />
            	<?php
            	   $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'];
                   
            	   if(isset($prompt)){
            	       echo $prompt;
            	   }
            	?>
            	<form id="formlogin" action="<?php echo $url . '?c=admin&&f=adminlogin';?>" method="post" onSubmit="return confirmInput();">
                	<table>
                    	<tr>
                            <td class="td1">用户名：</td>
                            <td class="td2"><input id="username" name="username" type="text" size="30" /></td>
                        </tr>
                        <tr>
                            <td class="td1">密&nbsp;&nbsp;码：</td>
                            <td class="td2"><input id="password" name="password" type="password" size="30" /></td>
                        </tr>
                        <tr>
                            <td class="td1">验证码：</td>
                            <td class="td2">
                            	<input type="text" size="10" value="暂时不填" readonly />
                            	<a href="javascript:void(0)" onclick="changecode()"  class="warning prompt codeImg">
                                    <img src="./admin/checkcode/checkcode.php" id="checkcode" width="80" height="40" style="width:80px;height:40px;border:1px solid #cccccc; vertical-align:middle;" alt="验证码图片，点我换新图" />
                                </a>
                            </td>
                        </tr>
                    </table>
                    <table>
                    	<tr>
                            <td class="td3"><input type="submit" value="登  录"/></td>
                            <td class="td4">&nbsp;</td>
                            <td class="td5"><input type="reset" value="重  置" /></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>