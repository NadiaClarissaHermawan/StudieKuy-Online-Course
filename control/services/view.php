<?php 

    class View{
        public static function createView($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'View/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'View/layout/layout.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
    }
?>