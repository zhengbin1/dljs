<?php 
    header('Content-Type:text/html;charset=utf-8');
    
    if ( ! defined('BASEPATH')) exit('不允许直接访问此文件。');
    
    class News_Model{  // 数据处理模型
        
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
        
        public function read_data($row){  // 获取全部新闻
            $result = self::$mysql_link -> query("select * from news order by time desc limit {$row},20");
            return $result -> fetch_all(MYSQLI_ASSOC);
        }
        
        public function num_row(){  // 获取行数
            $query = self::$mysql_link -> query('select count(*) as rows from news');
            $array = $query -> fetch_assoc();
            $query -> free();
            return $array['rows'];
        }
        
        public function read_data_id($id){  // 根据id获取行数据
            $query = self::$mysql_link -> query("select * from news where id='{$id}'");
            $array = $query -> fetch_assoc();
            $query -> free();
            return $array;
        }
        
        function __destruct(){
           self::$mysql_link -> close();
        }
        
        private static $mysql_link = NULL;
        private static $obj = NULL;
    }
?>