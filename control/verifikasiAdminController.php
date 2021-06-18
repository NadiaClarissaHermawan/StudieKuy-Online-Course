<?php 
    require_once "control/services/viewVerifikasiAdmin.php";
    require_once "control/services/mysqlDB.php";

    class verifikasiAdminController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_verifpageAdmin(){
            return View::createView('verifikasiAdmin.php', []);
        }
    }
?>