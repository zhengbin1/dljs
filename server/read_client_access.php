<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />

        <style type="text/css">
            .header{
                width:1000px;
                height:auto;
                margin:0 auto;
            }
            .bottom{
                width:auto;
                height:50px;
                line-height:50px;
                margin:0 auto;
            }
        </style>
    </head>
    <body>
        <?php
            /* 从数据库读取客户端的访问信息 */
            function my_get_browser($HTTP_USER_AGENT) {  // 获取浏览器类型

                if(empty($HTTP_USER_AGENT)){
                    return '机器人来了，应该是网络爬虫！';
                }else if(false!==strpos($HTTP_USER_AGENT,'MSIE 11.0')){
                    return 'Internet Explorer 11.0';
                }else if(false!==strpos($HTTP_USER_AGENT,'MSIE 10.0')){
                    return 'Internet Explorer 10.0';
                }else if(false!==strpos($HTTP_USER_AGENT,'MSIE 9.0')){
                    return 'Internet Explorer 9.0';
                } else if(false!==strpos($HTTP_USER_AGENT,'MSIE 8.0')){
                    return 'Internet Explorer 8.0';
                } else if(false!==strpos($HTTP_USER_AGENT,'MSIE 7.0')){
                    return 'Internet Explorer 7.0';
                } else if(false!==strpos($HTTP_USER_AGENT,'MSIE 6.0')){
                    return 'Internet Explorer 6.0';
                } else if(false!==strpos($HTTP_USER_AGENT,'Firefox')){
                    return 'Firefox';
                } else if(false!==strpos($HTTP_USER_AGENT,'Chrome')){
                    return 'Chrome';
                } else if(false!==strpos($HTTP_USER_AGENT,'Safari')){
                    return 'Safari';
                } else if(false!==strpos($HTTP_USER_AGENT,'Opera')){
                    return 'Opera';
                } else if(false!==strpos($HTTP_USER_AGENT,'360SE')){
                    return '360SE';
                }

                return $HTTP_USER_AGENT;
            }

            $db = new mysqli('localhost','root','');

            if(false == $db -> select_db('dljs2')){
                exit('选择数据库错误！');
            }

            $db -> query('set names utf8');

            $url = substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/') + 1);  // 每次请求的URL

            $result = $db -> query('select count(*) as total from access_info');
            $result2 = $db -> query('select * from access_info where instr(time,current_date())');
            $today_num = $result2 -> num_rows;
            $today_robot = 0;

            $seo = array('google' => 0, 'baidu' => 0, 'so' => 0, 'sogou' => 0, 'bing' => 0, 'soso' => 0);
            while($row2 = $result2 -> fetch_row()){
                if (empty($row2[4])){
                    $today_robot ++;
                }
                if (strpos($row2[3],'google')){
                    $seo['google'] ++;
                } else if(strpos($row2[3],'baidu')){
                    $seo['baidu'] ++;
                } else if(strpos($row2[3],'.so.')){
                    $seo['so'] ++;
                } else if(strpos($row2[3],'sogou')){
                    $seo['sogou'] ++;
                } else if(strpos($row2[3],'bing')){
                    $seo['bing'] ++;
                } else if(strpos($row2[3],'soso')){
                    $seo['soso'] ++;
                }
            }
            $result2 -> free();

            $result3 = $db -> query('select referer from access_info');

            $seo2 = array('google' => 0, 'baidu' => 0, 'so' => 0, 'sogou' => 0, 'bing' => 0, 'soso' => 0);
            while($row3 = $result3 -> fetch_row()){
                if(strpos($row3[0],'google')){
                    $seo2['google'] ++;
                } else if(strpos($row3[0],'baidu')){
                    $seo2['baidu'] ++;
                } else if(strpos($row3[0],'.so.')){
                    $seo2['so'] ++;
                } else if(strpos($row3[0],'sogou')){
                    $seo2['sogou'] ++;
                } else if(strpos($row3[0],'bing')){
                    $seo2['bing'] ++;
                } else if(strpos($row3[0],'soso')){
                    $seo2['soso'] ++;
                }
            }
            $result3 -> free();

            echo '<div class="header">';
            echo '<h1 style="text-align:center;">访&nbsp;问&nbsp;统&nbsp;计</h1>';
            echo '<p style="font-size:18px;">' . date('Y年m月d日访问量：',time()) . $today_num .'次&nbsp;&nbsp;网络爬虫或是机器人访问：' . $today_robot . '次</p>';
            echo "<p style=\"font-size:18px;\">" . date('Y年m月d日搜索引擎跳转：',time()) . "谷歌：{$seo['google']}次&nbsp;&nbsp;百度：{$seo['baidu']}次&nbsp;&nbsp;360：{$seo['so']}次&nbsp;&nbsp;搜狗：{$seo['sogou']}次&nbsp;&nbsp;必应：{$seo['bing']}次&nbsp;&nbsp;搜搜：{$seo['soso']}次</p>";
            echo "<p style=\"font-size:18px;\">搜索引擎跳转的全部次数：谷歌：{$seo2['google']}次&nbsp;&nbsp;百度：{$seo2['baidu']}次&nbsp;&nbsp;360：{$seo2['so']}次&nbsp;&nbsp;搜狗：{$seo2['sogou']}次&nbsp;&nbsp;必应：{$seo2['bing']}次&nbsp;&nbsp;搜搜：{$seo2['soso']}次</p>";
            echo '</div>';

            $num = 30; //每页显示的条数

            $total = $result -> fetch_assoc();  // 总记录数
            $total = $total['total'];

            $currpage = isset($_GET["page"]) ? $_GET["page"] : 1; // 当前页

            $offset = ($currpage - 1) * $num;   // 开始取数据的位置

            $result = $db -> query("select * from access_info order by id desc limit {$offset},{$num}");

            $pagenum = ceil($total/$num);  // 总页数


            $start = $offset + 1;   // 开始记录

            $end = ($currpage == $pagenum) ? $total : ($currpage * $num);  //结束记录

            $next = ($currpage == $pagenum)?  0 : ($currpage + 1);

            $prev = ($currpage == 1) ? 0 : ($currpage - 1);

            echo '<table align="center" width="1000px" border="1">';
            echo '<tr><th>行号</th><th>用户的 IP</th><th>用户端口号</th><th>访问来源</th><th>浏览器信息</th><th>访问时间</th></tr>';

                $id = 0;
                while($row = $result -> fetch_assoc()) {
                    echo '<tr>';
                        foreach($row as $key => $value) {
                            echo '<td>';
                            if(strcmp($key,'id') == 0){
                                echo $value;
                                $id = $value;
                            }else if (strcmp($key,'agent') == 0) {
                                echo "<a href='detail_browser_info.php?id={$id}' alt='点击显示详细浏览器信息'>" . my_get_browser($value) . '</a>';
                            } else if(strcmp($key,'addr') == 0){
                                echo "<a href='get_taobao_ip.php?ip={$value}' target='_blank'>" . $value . '</a>';
                            } else if(empty($value)){
                                echo '&nbsp;';
                            } else {
                                echo $value;
                            }
                            echo '</td>';
                        }
                    echo '</tr>';
                }
            echo '</table>';

            echo '<br/><center>';
            echo '<div class="bottom">';
            echo "共<b>{$total}</b>条记录, 本页显示<b>{$start}-{$end}</b> &nbsp;&nbsp;{$currpage}/{$pagenum}";
            if($currpage==1)
                echo "&nbsp;&nbsp;首页&nbsp;&nbsp;";
            else
                echo "&nbsp;&nbsp;<a href='{$url}?page=1'>首页</a>&nbsp;&nbsp;";

            if($prev)
                echo "&nbsp;&nbsp;<a href='{$url}?page={$prev}'>上一页</a>&nbsp;&nbsp;";
            else
                echo "&nbsp;&nbsp;上一页&nbsp;&nbsp;";

            if($next)
                echo "&nbsp;&nbsp;<a href='{$url}?page={$next}'>下一页</a>&nbsp;&nbsp;";
            else
                echo "&nbsp;&nbsp;下一页&nbsp;&nbsp;";

            if($currpage==$pagenum)
                echo "&nbsp;&nbsp;尾页&nbsp;&nbsp;";
            else
                echo "&nbsp;&nbsp;<a href='{$url}?page={$pagenum}'>尾页</a>&nbsp;&nbsp;";

            echo '</div></center>';

            $result -> free();
            $db -> close();
        ?>
    </body>
</html>
