<?php 
    require_once "control/services/viewUserLogin.php";
    require_once "control/services/mysqlDB.php";

    class userLoginController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_userLoginpage(){
            return View::createView('userLogin.php', []);
        }
    }
?>