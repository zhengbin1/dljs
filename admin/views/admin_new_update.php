<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>德隆健身网站后台管理</title>
    <script type="text/javascript" src="./index/js/jquery-1.8.3.min.js"></script>
    <link type="text/css" rel="stylesheet" href="./admin/css/admin.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_left.css" />
    <link type="text/css" rel="stylesheet" href="./admin/css/admin_new_update.css" />
    
    <!-- 配置文件 -->
    <script type="text/javascript" src="./admin/ueditor/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="./admin/ueditor/ueditor.all.js"></script>
    <!-- 语言包文件(建议手动加载语言包，避免在ie下，因为加载语言失败导致编辑器加载失败) -->
    <script type="text/javascript" src="./admin/ueditor/lang/zh-cn/zh-cn.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function (){
            var editor = UE.getEditor('container');
            
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
            
            if(isNull($('#newtitle').val())){
                alert('新闻标题不能为空！');
                $('#newtitle').focus();
                return false;
            }
            if(isNull($('#container').val())){
                alert('新闻内容不能为空！');
                $('#container').focus();
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
            <div class="path">网站基本设置&nbsp;>&nbsp;新闻发布管理&nbsp;>&nbsp;修改新闻</div>
            <div class="main_right_content">
                <form action="" method="post" onsubmit="javascript:return form_submit();">
                    <table class="table1" width="100%" border="0" cellspacing="1" cellpadding="0">
                          <tr>  
                            <td class="td1"><u>新闻标题</u> <span style="color:#ff0000;">*</span><br />
                                                            必填项，字数限制在100字以内
                            </td>
                            <td class="td1">
                                <input id="newtitle" name="title" type="text" maxlength="100" size="50" value="<?php echo $array['title'];?>"/>
                            </td>
                          </tr>
                          <tr>
                            <td class="td2"><u>Meta Keywords</u><br />
                            Keywords 项出现在页面头部的 Meta 标签中，用于记录关键词，多个关键词用半角逗号 "," 分隔</td>
                            <td class="td2"><textarea name="keywords" rows="3" cols="40"><?php echo $array['keywords'];?></textarea></td>
                          </tr>
                          <tr>
                            <td class="td1"><u>Meta Description</u><br />
                            Description 项出现在页面头部的 Meta 标签中，用于记录概要描述</td>
                            <td class="td1"><textarea name="descn" rows="3" cols="40"><?php echo $array['descn'];?></textarea></td>
                          </tr>
                          <tr>
                            <td class="td2">发&nbsp;布&nbsp;时&nbsp;间<br />
                            	时间的格式必须是YY-MM-DD HH:II:SS后面不能有空格。
                            </td>
                            <td class="td2"><input name="datetime" type="text" maxlength="100" size="50" value="<?php echo $array['time'];?>"/></td>
                          </tr>
                          <tr>
                            <td class="td1" colspan="2"><u>正文内容</u><br />
                                                    填写文章正文内容，编辑器支持图文混排、自定义排版布局</td>
                          </tr>
                          <tr>
                            <td class="td2" colspan="2" align="center" valign="top">
                                <textarea id="container" name="content" style="height:600px;"><?php echo $array['content'];?></textarea>
                            </td>
                          </tr>
                    </table>
                    <table class="table2">
                        <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                        <tr>
                            <td><input type="submit" value="发   布"/></td>
                            <td><input type="reset"  value="重   置"/></td>
                            <td><a href="index.php?c=admin&f=adminnewlist">返&nbsp;&nbsp;回</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>