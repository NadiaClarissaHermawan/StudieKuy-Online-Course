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
            include 'view/layout/layoutUserTopUp.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        public static function createViewConfirm($view, $param, $nominal){
            foreach($param as $key => $value){
                $$key = $value;
            }
            $nominal = $nominal;
            
            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutUserTopUp.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
    }
?>