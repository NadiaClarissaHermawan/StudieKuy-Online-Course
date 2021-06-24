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
<div class="content1 tulisanPutih hurufBesar">CONGRATULATION</div>
<img src="view/images/congrats.jpg" class="pic">
<button class="buttonEx">See My Progress</button>