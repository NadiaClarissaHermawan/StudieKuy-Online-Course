<?php 
    class View{
        public static function createView($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutIndex.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewList($view, $param, $saldo){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $saldo = $saldo[0]->getSaldo();

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutList.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewCourseDetail($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutCourseDetail.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
        public static function createViewBidangCourse($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutBidangCourse.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewCourseModul($view, $param, $saldo){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $saldoUser = $saldo;

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutCourseModul.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewCourseExam($view, $param, $saldo, $namaCourse){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $saldoUser = $saldo;
            $namaCourse = $namaCourse;

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutCourseExam.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
    }
?>