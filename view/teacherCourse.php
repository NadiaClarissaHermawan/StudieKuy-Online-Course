<?php
    // if(session_status() == PHP_SESSION_NONE){
    //     session_start();
    // }

    // //kalo belom login gabisa kesini
    // if(!isset($_SESSION['statusTeacher'])){
    //     header("Location: teacherLogin");
    //     session_destroy();
    //     exit;
    // }
?>
<div class="white-box">
    <?php
        if(isset($result) && $result != null){
            foreach($result as $key => $row){
                echo '<a class="card" href="userCourseInfo?bidang='.$nama_bidang.'&course='.$row->getNamaCourse().'">';
                echo '<img src="view/images/gambarcourses/'.$row->getGambarCourse().'" class="card-img">';
                echo '<div class="text">'.$row->getNamaCourse().'</div>';
                echo '</a>';
            }
        }
    ?>
</div>