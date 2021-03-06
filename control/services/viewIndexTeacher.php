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
            include 'view/layout/layoutIndexTeacher.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewCreateCourse($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutCreateCourse.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewUploadModul($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutUploadModul.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewCreateExam($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutCreateExam.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewTeacherCourse($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutTeacherCourse.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
        public static function createViewTeacherModul($view, $param, $sumberModul, $selectedModulName){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $selectedModulName = $selectedModulName;
            $sumberModul = $sumberModul;

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutTeacherModulExam.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
        public static function createViewTeacherExam($view, $param, $namaCourse, $idCourse){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutTeacherModulExam.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewTeacherProfile($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutTeacherProfile.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
    }
?>