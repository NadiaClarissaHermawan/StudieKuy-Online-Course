<?php 
    require_once "control/services/viewCourses.php";
    require_once "control/services/mysqlDB.php";

    class coursesController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_courses(){
            return View::createView('courses.php', []);
        }
    }
?>