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

            //done
            case $baseURL.'/adminLogin':
                require_once "control/adminController.php";
                $Ctrl = new adminController();
                echo $Ctrl->view_adminLoginpage();
                break;

            case $baseURL.'/profileEdit':
                require_once "control/userProfileController.php";
                $userProfileCtrl = new userProfileController();
                echo $userProfileCtrl->view_editProfile();
                break;
            
            //edit
            case $baseURL.'/indexAdmin':
                require_once "control/adminController.php";
                $idxCtrl = new adminController();
                echo $idxCtrl->view_mainpageAdmin();
                break;

            case $baseURL.'/indexTeacher':
                require_once "control/indexTeacherController.php";
                $idxCtrl = new indexTeacherController();
                echo $idxCtrl->view_mainpageTeacher();
                break;

            case $baseURL.'/verificationAdmin':
                require_once "control/verificationAdminController.php";
                $verifCtrl = new verificationAdminController();
                echo $verifCtrl->view_verifpageAdmin();
                break;

            case $baseURL.'/verificationSertif':
                require_once "control/verificationTableController.php";
                $sertifCtrl = new verificationTableController();
                echo $sertifCtrl->view_verifSertif();
                break;

            case $baseURL.'/verificationCourse':
                require_once "control/verificationTableController.php";
                $courseCtrl = new verificationTableController();
                echo $courseCtrl->view_verifCourse();
                break;
            case $baseURL.'/verificationTopUp':
                require_once "control/verificationTableController.php";
                $topUpCtrl = new verificationTableController();
                echo $topUpCtrl->view_verifTopUp();
                break;

            case $baseURL.'/reportCourse':
                require_once "control/reportController.php";
                $courseCtrl = new reportController();
                echo $courseCtrl->view_courseReport();
                break;

            case $baseURL.'/reportTopUp':
                require_once "control/reportController.php";
                $courseCtrl = new reportController();
                echo $courseCtrl->view_topUpReport();
                break;

            case $baseURL.'/reportCourseTransaction':
                require_once "control/reportController.php";
                $courseCtrl = new reportController();
                echo $courseCtrl->view_courseTransactionReport();
                break;

            case $baseURL.'/coursesList':
                require_once "control/indexController.php";
                $idxCtrl = new indexController();
                echo $idxCtrl->view_coursesList();
                break;

            //Contoh halaman course tertentu misal nama course = Java Basic Programming
            case $baseURL.'/JavaBasicProgramming':
                require_once "control/indexController.php";
                $idxCtrl = new indexController();
                echo $idxCtrl->view_coursesDetail();
                break;

            case $baseURL.'/createCourse':
                require_once "control/indexTeacherController.php";
                $crsCtrl = new createCourseController();
                echo $crsCtrl->view_createCoursePage();
                break;

            case $baseURL.'/uploadModul':
                require_once "control/indexTeacherController.php";
                $crsCtrl = new uploadModulController();
                echo $crsCtrl->view_uploadModul();
                break;

            case $baseURL.'/createExam':
                require_once "control/indexTeacherController.php";
                $crsCtrl = new createExamController();
                echo $crsCtrl->view_createExam();
                break;

            case $baseURL.'/topupConfirmation':
                require_once "control/userTopupController.php";
                $confirmCtrl = new userTopupController();
                echo $confirmCtrl->view_topupConfirm();
                break;
            
            case $baseURL.'/transaction-progress':
                require_once "control/userTopupController.php";
                $processCtrl = new userTopupController();
                echo $processCtrl->view_process();
                break;

            case $baseURL.'/history':
                require_once "control/userTopupController.php";
                $hisCtrl = new userTopupController();
                echo $hisCtrl->view_topupHistory();
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

            //upload profile text 
            case $baseURL.'/profileTextEdit':
                require_once "control/userProfileController.php";
                $userTopupCtrl = new userProfileController();
                $userTopupCtrl->profileTextEdit();
                header('Location: userProfile');
                break;

            //upload foto profile (AJAX) --> masih ngaco
            case $baseURL.'/uploadFile':
                require_once "control/userProfileController.php";
				$uploadCtrl = new userProfileController();
				echo $uploadCtrl->upload();
				break;

            //upload bukti transfer
            case $baseURL.'/uploadBukti':
                require_once "control/userTopupController.php";
                $buktiCtrl = new userTopupController();
                echo $buktiCtrl->topup();
                break;

            //insert log transaksi ke database 
            case $baseURL.'/fix-topup':
                require_once "control/userTopupController.php";
                $buyCtrl = new userTopupController();
                echo $buyCtrl->insert_log();
                header('Location: transaction-progress');
                break;

            //klik login di admin
            case $baseURL.'/adminLogin':
                require_once "control/adminController.php";
                $Ctrl = new adminController();
                echo $Ctrl->klik_login();
                break;

            default :
                echo '404 not found';
                break;
        }
    }

?>