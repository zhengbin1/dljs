<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>德隆健身网站后台管理</title>
	<link type="text/css" rel="stylesheet" href="./admin/css/admin.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_manage.css"/>
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_left.css" />
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
    	    <div class="path">网站基本设置&nbsp;>&nbsp;管理员设置</div>
    	    <div class="main_right_table">
    	        <table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="4%" class="tabletitle"><input type="checkbox" id="checkAll" name="checkAll" title="全选/全取消" /></td>
                    <td width="20%" class="tabletitle">用户名</td>
                    <td class="tabletitle">说明信息</td>
                    <td width="12%" class="tabletitle">状态</td>
                    <td width="12%" class="tabletitle">开通日期</td>
                    <td width="12%" class="tabletitle">管理</td>
                  </tr>
                  
                  <?php
                        echo '<tr><td align="center" class="tablecontent"><input type="checkbox" id="checkGroup" name="checkGroup" value="' . $admininfo['id'] . '" /></td>';
                        echo '<td align="center" class="tablecontent">' . $admininfo['name'] . '</td>';
                        echo '<td class="tablecontent">' . $admininfo['info'] . '</td>';
                        $tmp = $admininfo['status'] == 1 ? '启用' : '停用';
                        echo '<td id="ctl00_body_Repeater1_ctl00_Eval_Status" align="center" class="tablecontent fontGray"><span style="color:green">' . $tmp . '</span></td>';
                        echo '<td id="ctl00_body_Repeater1_ctl00_Eval_CreateTime" align="center" class="tablecontent">' . $admininfo['time'] . '</td>';
                        echo "<td align=\"center\" class=\"tablecontent\"><a href=\"index.php?c=admin&f=passwordsetting\">修改密码</a></td>";
                        echo '</tr>';      
                  ?>
                </table>
    	    </div>
    	</div>
    </div>
</body>
</html>
