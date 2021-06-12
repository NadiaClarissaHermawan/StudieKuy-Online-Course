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
            	require_once "control/indexController.php";
            	$idxCtrl = new indexController();
                echo $idxCtrl->view_userLoginpage();
                break;
            case $baseURL.'/register':
            	require_once "control/indexController.php";
            	$idxCtrl = new indexController();
                echo $idxCtrl->view_registerpage();
                break;
            case $baseURL.'/aboutUs':
            	require_once "control/indexController.php";
            	$idxCtrl = new indexController();
                echo $idxCtrl->view_aboutUs();
                break;
            default :
                echo '404 not found';
                break;
        }
    }

?>