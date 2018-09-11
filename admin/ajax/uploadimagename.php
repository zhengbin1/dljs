<?php
	// 修改相册的名字
	
	if(isset($_POST['id']) && isset($_POST['name'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		if (($str = file_get_contents('../../index/images3/images')) != false){  // 获取相册的个数和名字
    		$arrImages = json_decode($str, true);
			$arrImages[$id] = $name;
			file_put_contents('../../index/images3/images', json_encode($arrImages));
			echo 'true';
    	} else {
			echo 'false';
		}
	} else {
		echo 'false';
	}
?>