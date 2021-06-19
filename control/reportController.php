<?php 
    require_once "control/services/viewReport.php";
    require_once "control/services/mysqlDB.php";

    class reportController{
        protected $db;

        public function __construct(){
            $this->db = new MySQLDB("localhost", "root", "", "tubes");
        }

        public function view_courseReport(){
            return View::createView('reportCourse.php', []);
        }
        public function view_topUpReport(){
            return View::createView('reportTopUp.php', []);
        }
        public function view_courseTransactionReport(){
            return View::createView('reportCourseTransaction.php', []);
        }
    }
?>