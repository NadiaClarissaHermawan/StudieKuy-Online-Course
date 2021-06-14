<?php 
    $url = $_SERVER['REDIRECT_URL'];
    $baseURL = '/TugasBesar';

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        switch($url){
            case $baseURL.'/index':
                require_once "control/indexController.php";
                $idxCtrl = new indexController();
                echo $idxCtrl->view_mainpage();
                break;
            case $baseURL.'/userLogin':
            	require_once "control/userLoginController.php";
            	$loginCtrl = new userLoginController();
                echo $loginCtrl->view_userLoginpage();
                break;
            case $baseURL.'/faq':
                require_once "control/faqController.php";
                $faqCtrl = new faqController();
                echo $faqCtrl->view_faq();
                break;
            case $baseURL.'/userRegister':
            	require_once "control/registerUserController.php";
            	$registerCtrl = new registerUserController();
                echo $registerCtrl->view_registerUserPage();
                break;
            case $baseURL.'/userTeacherRegister':
            	require_once "control/registerUserController.php";
            	$registerCtrl = new registerUserController();
                echo $registerCtrl->view_registerTeacherUserPage();
                break;
            case $baseURL.'/courses':
                require_once "control/coursesController.php";
                $coursesCtrl = new coursesController();
                echo $coursesCtrl->view_courses();
                break;
            case $baseURL.'/userTopup':
                require_once "control/userTopupController.php";
                $userTopupCtrl = new userTopupController();
                echo $userTopupCtrl->view_userTopup();
                break;
            case $baseURL.'/userProfile':
                require_once "control/userProfileController.php";
                $userProfileCtrl = new userProfileController();
                echo $userProfileCtrl->view_userProfile();
                break;
            default :
                echo '404 not found';
                break;
        }
    }else if($_SERVER["REQUEST_METHOD"] == "POST"){
        switch($url){
            case $baseURL.'/userLogin':
                require_once "control/userLoginController.php";
                $loginCtrl = new userLoginController();
                echo $loginCtrl->klik_login();
                break;
            case $baseURL.'/userRegister':
                require_once "control/registerUserController.php";
                $registerCtrl = new registerUserController();
                echo $registerCtrl->klik_register();
                break;
            default :
                echo '404 not found';
                break;
        }
    }

?>