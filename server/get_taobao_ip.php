<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php
/*
 * 获取 IP  地理位置
 * 淘宝IP接口
 * @return: array
 */
 
function get_ali_ip($ip)
{
	$url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip;
	$ip = json_decode(file_get_contents($url)); 
	
	if((string)$ip -> code == '1'){
		return false;
	}
	
	$data = (array)$ip->data;
	return $data; 
}

	$data = get_ali_ip($_GET['ip']);
	
	echo '<table align="center" width="1200px" height="100px" border="1">';
	echo '<caption><h2>获得IP地理位置</h2></caption>';
	
	echo '<tr><th>国家/地区</th><th>国家编号</th><th>区&nbsp;&nbsp;域</th><th>区域编号</th><th>省&nbsp;&nbsp;份</th><th>省份编号</th><th>城&nbsp;&nbsp;市</th><th>城市编号</th><th>县</th><th>县编号</th><th>运营商</th><th>运营商编号</th><th>ip</th></tr>';
	
	echo '<tr>';
	foreach($data as $value){
		if(empty($value)){
			echo '<td>&nbsp;</td>';
		}else{
			echo '<td>' . $value . '</td>';
		}	
	}
	
	echo '</tr></table>';
?>