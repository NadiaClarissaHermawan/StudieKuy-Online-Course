<?php 
    require_once "control/services/view.php";
    require_once "control/services/mysqlDB.php";

    class indexController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_mainpage(){
            return View::createView('index.php', []);
        }
    }
?>