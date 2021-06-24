<!-- Layout gabung ke layout CourseExam -->

<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // kalo belom login gabisa kesini
    if(!isset($_SESSION['status'])){
        header("Location: userLogin");
        session_destroy();
        exit;
    }
?>
<div style="height: 100%; width:100%">
    <div class="content1 tulisanPutih hurufBesar">CONGRATULATION<br>you have submitted your answers</div>
    <img src="view/images/congrats.jpg" class="pic">
    <a href="progress" class="buttonEx">See My Progress</a>
</div>
