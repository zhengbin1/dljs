<?php 
    header('Content-Type:text/html;charset=utf-8');
    
    if ( ! defined('BASEPATH')) exit('不允许直接访问此文件。');
    
    class News_Model{  // 新闻数据处理模型
        
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
        
        public function insertNew($title, $keywords, $descn, $datetime, $content){  // 插入一条新闻
            
            if(0 == preg_match('/\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}/', $datetime, $array)){
            	$datetime = date('Y-m-d H:i:s', time());
            }
            
            $ret = self::$mysql_link -> query("insert into news values(NULL, '{$title}', '{$keywords}', '{$descn}', '{$datetime}', '{$content}')");
            return $ret;
        }
        
        public function read_data($row){  // 获取全部新闻
            $result = self::$mysql_link -> query("select * from news order by time desc limit {$row},10");
            return $result -> fetch_all(MYSQLI_ASSOC);
        }
        
        public function num_row(){  // 获取行数
            $query = self::$mysql_link -> query('select count(*) as rows from news');
            $array = $query -> fetch_assoc();
            $query -> free();
            return $array['rows'];
        }
        
        public function del_rows($id) {  // 删除行
            $result = self::$mysql_link -> query("delete from news where `id`={$id}");
            return $result;
        }
        
        public function read_data_id($id){  // 根据id获取行数据
            $query = self::$mysql_link -> query("select * from news where id='{$id}'");
            $array = $query -> fetch_assoc();
            $query -> free();
            return $array;
        }
        
        public function update_news($id, $title, $keywords, $descn, $datetime, $content) {
           		
           	if(0 == preg_match('/\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}/', $datetime, $array)){
            	$datetime = date('Y-m-d H:i:s', time());
            }
			
            $query = self::$mysql_link -> query("update news set `title`='{$title}',`keywords`='{$keywords}',`descn`='{$descn}',`time`='{$datetime}',`content`='{$content}' where id={$id}");
            return $query;
        }
        
        function __destruct(){
           self::$mysql_link -> close();
        }
        
        private static $mysql_link = NULL;
        private static $obj = NULL;
    }
?>