<?php 
    header('Content-Type:text/html;charset=utf-8');
    
    if ( ! defined('BASEPATH')) exit('不允许直接访问此文件。');
    
    class Admin_Model{  // 管理员数据处理模型
        
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
        
        public function is_name_pass($name, $pass){  // 判断用户名和密码是否存在
            $pass = md5($pass);
            $result = self::$mysql_link -> query("select * from admin where `name` = '{$name}' and `password` = '{$pass}'");
            
            if($result -> num_rows >= 1){
                return true;
            } else {
                return false;
            }
        }
        
        public function getadmininfo($username){  // 获取管理员的信息
            $result = self::$mysql_link -> query("select * from admin where `name` = '{$username}'");
            return $result -> fetch_assoc();
        }

        public function modify_pass($username, $password){  // 修改管理员密码
            $result = self::$mysql_link -> query("update admin set `password`=md5('{$password}') where `name`='{$username}'");
            return $result;
        }
        
        function __destruct(){
           self::$mysql_link -> close();
        }
        
        private static $mysql_link = NULL;
        private static $obj = NULL;
    }
?>