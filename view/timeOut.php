<!-- nyambung ke layoutCourseExam.php, courseExam.css -->
<?php
    // if(session_status() == PHP_SESSION_NONE){
    //     session_start();
    // }

    // // kalo belom login gabisa kesini
    // if(!isset($_SESSION['status'])){
    //     header("Location: userLogin");
    //     session_destroy();
    //     exit;
    // }
?>

<div class="info">
    <img src="view/images/timeOut.png" class="image">
    <div class="kanan">
        <p class="tulisanPutih">Sorry, your time is up!</p>
        <a href="userCourseExam"><button class="buttonM tulisanCoklat hurufSedang">Retake Exam</button></a>
        <a href="coursesDetail"><button class="buttonM tulisanCoklat hurufSedang">Back to Course</button></a>    
    </div>
    
</div>
