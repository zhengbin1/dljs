<?php 
    header('Content-Type:text/html;charset=utf-8');
    
    if ( ! defined('BASEPATH')) exit('不允许直接访问此文件。');
    
    class Base_Model{  // 网站基本设置数据处理模型
        
        private function __construct(){
            require './config/database.php';
            
            self::$mysql_link = new mysqli($db['hostname'], $db['username'], $db['password']);
            self::$mysql_link -> select_db($db['database']);
        }
        
        public static function getObject(){
            if(self::$obj == NULL){
                self::$obj = new self;
                
                return self::$obj;
            } else {
                return self::$obj;
            }
        }
        
        public function getbaseinfo(){  // 获取网站基本信息
            $result = self::$mysql_link -> query("select * from base where `id` = '1'");
            return $result -> fetch_assoc();
        }
		
		public function modify_base($beian, $keywords, $descn, $script){  // 修改网站基本设置
			$beian = addslashes($beian);
			$keywords = addslashes($keywords);
			$descn = addslashes($descn);
			$script = addslashes($script);
			$result = self::$mysql_link -> query("update base set `beian`='{$beian}', `keywords`='{$keywords}', `descn`='{$descn}', `script`='{$script}' where `id`='1'");
            return $result;
		}
        
        function __destruct(){
           self::$mysql_link -> close();
        }
        
        private static $mysql_link = NULL;
        private static $obj = NULL;
    }
?>