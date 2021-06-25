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
                require_once "control/adminController.php";
                $Ctrl = new adminController();
                echo $Ctrl->view_adminLoginpage();
                break;

            case $baseURL.'/profileEdit':
                require_once "control/userProfileController.php";
                $userProfileCtrl = new userProfileController();
                echo $userProfileCtrl->view_editProfile();
                break;
            
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
                require_once "control/verificationAdminController.php";
                $sertifCtrl = new verificationAdminController();
                echo $sertifCtrl->view_verifSertif();
                break;

            case $baseURL.'/verificationTopUp':
                require_once "control/verificationAdminController.php";
                $topUpCtrl = new verificationAdminController();
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

            case $baseURL.'/teacherCourse':
                require_once "control/indexTeacherController.php";
                $hisCtrl = new teacherCourseController();
                echo $hisCtrl->view_teacherCourse();
                break; 

            case $baseURL.'/acceptSertif':
                require_once "control/verificationAdminController.php";
                $acCtrl = new verificationAdminController();
                echo $acCtrl->acceptSertif();
                header ('Location: verificationSertif');
                break;

            case $baseURL.'/rejectSertif':
                require_once "control/verificationAdminController.php";
                $acCtrl = new verificationAdminController();
                echo $acCtrl->rejectSertif();
                header ('Location: verificationSertif');
                break;

            case $baseURL.'/acceptTopUp':
                require_once "control/verificationAdminController.php";
                $acCtrl = new verificationAdminController();
                echo $acCtrl->acceptTopUp();
                header ('Location: verificationTopUp');
                break;

            case $baseURL.'/rejectTopUp':
                require_once "control/verificationAdminController.php";
                $acCtrl = new verificationAdminController();
                echo $acCtrl->rejectTopUp();
                header ('Location: verificationTopUp');
                break;
            
            //ajax report
            case $baseURL.'/reportCourseFilter':
                require_once "control/reportController.php";
                $courseCtrl = new reportController();
                echo $courseCtrl->getCourseReport_filter();
                break;

            case $baseURL.'/topupReportFilter':
                require_once "control/reportController.php";
                $courseCtrl = new reportController();
                echo $courseCtrl->getTopupReport_filter();
                break;

            case $baseURL.'/courseTransactionFilter':
                require_once "control/reportController.php";
                $courseCtrl = new reportController();
                echo $courseCtrl->getTransactionReport_filter();
                break;
            //ajax report end

            //ajax verifikasi
            case $baseURL.'/verifStatusFilter':
                require_once "control/verificationAdminController.php";
                $verifCtrl = new verificationAdminController();
                echo $verifCtrl->verifStatusFilter();
                break;
            
            case $baseURL.'/verifTopupFilter':
                require_once "control/verificationAdminController.php";
                $verifCtrl = new verificationAdminController();
                echo $verifCtrl->verifTopupFilter();
                break;
            //ajax verifikasi end

            case $baseURL.'/teacherProfile':
                require_once "control/indexTeacherController.php";
                $teacherProfileCtrl = new teacherProfileController();
                echo $teacherProfileCtrl->view_teacherProfile();
                break;

            case $baseURL.'/signOutTeacher':
                require_once "control/indexTeacherController.php";
                $teacherProfileCtrl = new indexTeacherController();
                echo $teacherProfileCtrl->signOut();
                break;
            
            //course dlm 1 bidang
            case $baseURL.'/bidangCourse':
                require_once "control/indexController.php";
                $bidCtrl = new indexController();
                echo $bidCtrl->view_bidangCourse();
                break; 
            
            case $baseURL.'/adminLogout':
                require_once "control/adminController.php";
                $bidCtrl = new adminController();
                echo $bidCtrl->logout();
                break; 
            
            //member course
            case $baseURL.'/coursesList':
                require_once "control/indexController.php";
                $idxCtrl = new indexController();
                echo $idxCtrl->view_coursesList();
                break;

            case $baseURL.'/coursesDetail':
                require_once "control/indexController.php";
                $idxCtrl = new indexController();
                echo $idxCtrl->view_coursesDetail();
                break;

            case $baseURL.'/userCourseModul':
                require_once "control/indexController.php";
                $modCtrl = new indexController();
                echo $modCtrl->view_courseModul();
                break; 

            case $baseURL.'/userCourseExam':
                require_once "control/indexController.php";
                $modCtrl = new indexController();
                echo $modCtrl->view_courseExam();
                break; 

            case $baseURL.'/userCourseInfo':
                require_once "control/indexController.php";
                $modCtrl = new indexController();
                echo $modCtrl->view_courseInfo();
                break; 

            case $baseURL.'/buyCourse';
                require_once "control/indexController.php";
                $buyCtrl = new indexController();
                echo $buyCtrl->view_buyCourse();
                break;

            case $baseURL.'/examFinished':
                require_once "control/indexController.php";
                $finCtrl = new indexController();
                echo $finCtrl->view_examFinished();
                break; 

            case $baseURL.'/timeOut';
                require_once "control/indexController.php";
                $timeCtrl = new indexController();
                echo $timeCtrl->view_timeOut();
                break;

            case $baseURL.'/progress';
                require_once "control/indexController.php";
                $timeCtrl = new indexController();
                echo $timeCtrl->view_progress();
                break;

            case $baseURL.'/delete':
                require_once "control/userProfileController.php";
                $loginCtrl = new userProfileController();
                echo $loginCtrl->delete();
                break;
            //member course end

            case $baseURL.'/teacherCourseModul':
                require_once "control/indexTeacherController.php";
                $teacherModulCtrl = new teacherCourseController();
                echo $teacherModulCtrl->view_teacherCourseModul();
                break;

            //user sertif
            case $baseURL.'/sertifikat':
                require_once "control/indexController.php";
                $sertifCtrl = new indexController();
                echo $sertifCtrl->view_sertif();
                break;

            case $baseURL.'/requestSertifikat':
                header('Location: progress');
                break;
                
            //user sertif end

            case $baseURL.'/teacherCourseExam':
                require_once "control/indexTeacherController.php";
                $teacherExamCtrl = new teacherCourseController();
                echo $teacherExamCtrl->view_teacherCourseExam();
                break;
                
            //logout teacher
            case $baseURL.'/teacherLogout':
                require_once "control/teacherLoginController.php";
                $logoutCtrl = new teacherLoginController();
                echo $logoutCtrl->logout();
                break;
            
            case $baseURL.'/reportCoursePdf':
                require_once "control/reportController.php";
                $reportCtrl = new reportController();
                echo $reportCtrl->generateReportCourse();
                break;
            case $baseURL.'/reportTransactionCoursePdf':
                require_once "control/reportController.php";
                $reportCtrl = new reportController();
                echo $reportCtrl->generateReportTransactionCourse();
                break;
            case $baseURL.'/reportTopUpPdf':
                require_once "control/reportController.php";
                $reportCtrl = new reportController();
                echo $reportCtrl->generateTopUp();
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
            
            case $baseURL.'/userTeacherRegister':
                require_once "control/registerTeacherController.php";
                $registerCtrl = new registerTeacherController();
                echo $registerCtrl->klik_register();
                break;

            //upload profile text 
            case $baseURL.'/profileTextEdit':
                require_once "control/userProfileController.php";
                $editTextCtrl = new userProfileController();
                $editTextCtrl->profileTextEdit();
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

            //klik login di teacher
            case $baseURL.'/teacherLogin':
                require_once "control/teacherLoginController.php";
                $Ctrl = new teacherLoginController();
                echo $Ctrl->klik_login();
                break;
            
            case $baseURL.'/reportCourse':
                require_once "control/reportController.php";
                $courseCtrl = new reportController();
                echo $courseCtrl->view_courseReport();
                break;
            
            case $baseURL.'/cekJawaban':
                require_once "control/indexController.php";
                $examCtrl = new indexController();
                echo $examCtrl->cekJawaban();
                break;

            case $baseURL.'/uploadModul':
                require_once "control/indexTeacherController.php";
                $crsCtrl = new uploadModulController();
                echo $crsCtrl->addModul();
                header('Location: createExam');
                break;

            default :
                echo '404 not found';
                break;
        }
    }

?>