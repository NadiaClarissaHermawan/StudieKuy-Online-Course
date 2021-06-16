<?php 
    require_once "control/services/viewIndexAdmin.php";
    require_once "control/services/mysqlDB.php";

    class indexAdminController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_mainpageAdmin(){
            return View::createView('indexAdmin.php', []);
        }
    }
?>