<?php 
    require_once "control/services/viewIndexTeacher.php";
    require_once "control/services/mysqlDB.php";

    class indexTeacherController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_mainpageTeacher(){
            return View::createView('indexTeacher.php', []);
        }
    }
?>