<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //kalo belom login gabisa kesini
    if(!isset($_SESSION['status'])){
        header("Location: userLogin");
        session_destroy();
        exit;
    }
?>
<div id="content1-process">
    <div>
        <hr>
        <div class="tulisanPutih" style="font-size: 3vw;">Transaction in Progress</div>
        <hr>
    </div>
    <div class="tulisanPutih" style="font-size: 2vw;">We will inform you once the transaction succeed !</div>
    <img src="view/images/topupProcess.png" class="process-img">

    <a href="index"  class="tulisanCoklat" id="return-to-main">Return to Main Page</a>
</div>