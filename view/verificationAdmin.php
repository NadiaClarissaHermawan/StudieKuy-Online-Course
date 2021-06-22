<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //kalo belom login gabisa kesini
    if(!isset($_SESSION['statusAdmin'])){
        header("Location: adminLogin");
        session_destroy();
        exit;
    }
?>
<div id="contentMainPage">
    <div class="content2" style="justify-content: center;">
        <a class="content2-kiri" href="verificationSertif">Sertificate Verification</a>
        <a class="content2-kanan" href="verificationTopUp">Top-Up Transaction Verification</a>
    </div>
    <img src="view/images/verifAdmin.png" style="display:flex; width: 25%; height:25%"/>
    
</div>