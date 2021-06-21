<?php 
    class View{
        //global view for admin layout
        public static function createView($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutAdminLogin.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }

        //layout main page admin
        public static function createViewMainPageAdmin($view, $param){
            foreach($param as $key => $value){
                $$key = $value;
            }

            ob_start();
            include 'view/'.$view;
            $content = ob_get_contents();
            ob_end_clean();

            ob_start();
            include 'view/layout/layoutIndexAdmin.php';
            $include = ob_get_contents();
            ob_end_clean();
            return $include;
        }
    }
?>