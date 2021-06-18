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
            case $baseURL.'/teacherLogin':
                require_once "control/teacherLoginController.php";
                $loginCtrl = new teacherLoginController();
                echo $loginCtrl->view_teacherLoginPage();
                break;
            case $baseURL.'/userTeacherRegister':
            	require_once "control/registerTeacherController.php";
            	$registerCtrl = new registerTeacherController();
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
            case $baseURL.'/signOutUser':
                require_once "control/userProfileController.php";
                $userProfileCtrl = new userProfileController();
                echo $userProfileCtrl->signOut();
                break;
            case $baseURL.'/adminLogin':
                require_once "control/adminLoginController.php";
                $loginCtrl = new adminLoginController();
                echo $loginCtrl->view_adminLoginPage();
            case $baseURL.'/profileEdit':
                require_once "control/userProfileController.php";
                $userProfileCtrl = new userProfileController();
                echo $userProfileCtrl->view_editProfile();
                break;
            case $baseURL.'/indexAdmin':
                require_once "control/indexAdminController.php";
                $idxCtrl = new indexAdminController();
                echo $idxCtrl->view_mainpageAdmin();
                break;
            case $baseURL.'/indexTeacher':
                require_once "control/indexTeacherController.php";
                $idxCtrl = new indexTeacherController();
                echo $idxCtrl->view_mainpageTeacher();
                break;
            case $baseURL.'/verifikasiAdmin':
                require_once "control/verifikasiAdminController.php";
                $idxCtrl = new verifikasiAdminController();
                echo $idxCtrl->view_verifpageAdmin();
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
            case $baseURL.'/userTopup':
                require_once "control/userTopupController.php";
                $userTopupCtrl = new userTopupController();
                echo $userTopupCtrl->topupSaldo();
                break;
            case $baseURL.'/userProfileEdit':
                require_once "control/userProfileController.php";
                $userTopupCtrl = new userProfileController();
                $userTopupCtrl->editProfile();

                header('Location: userProfile');
                break;
            default :
                echo '404 not found';
                break;
        }
    }

?>