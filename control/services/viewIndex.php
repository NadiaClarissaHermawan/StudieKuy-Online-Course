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

        public static function createViewCourseDetail($view, $param, $namaCourse){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $namaCourse = $namaCourse;

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

        public static function createViewBidangCourse($view, $param, $saldoUser, $nama_bidang){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $saldoUser = $saldoUser;
            $nama_bidang = $nama_bidang;

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

        public static function createViewCourseModul($view, $param, $saldo, $sumberModul, $selectedModulName){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $saldoUser = $saldo;
            $selectedModulName = $selectedModulName;
            $sumberModul = $sumberModul;

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

        public static function createViewCourseExam($view, $param, $saldo, $namaCourse, $id_memCourse){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $saldoUser = $saldo;
            $namaCourse = $namaCourse;
            $id_memCourse = $id_memCourse;

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

        public static function createViewCourseInfo($view, $param, $namaModul, $saldoUser, $namaBidang, $namaCourse){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $saldoUser = $saldoUser;
            $namaCourse = $namaCourse;
            $namaBidang = $namaBidang;
            $namaModul = $namaModul;

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutCourseInfo.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewExamFinished($view, $param, $id_memCourse, $saldoUser){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $id_memCourse = $id_memCourse;
            $saldoUser = $saldoUser;

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutProgress.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
        public static function createViewTimeOut($view, $param, $saldoUser){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $saldoUser = $saldoUser;

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutProgress.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
        public static function createViewProgress($view, $param, $saldoUser){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $saldoUser = $saldoUser;

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutProgress.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
        public static function createViewBuyCourse($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutBuyCourse.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
    }
?>