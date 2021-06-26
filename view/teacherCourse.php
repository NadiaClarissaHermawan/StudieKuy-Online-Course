<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //kalo belom login gabisa kesini
    if(!isset($_SESSION['statusTeacher'])){
        header("Location: teacherLogin");
        session_destroy();
        exit;
    }
?>
<div class="white-box" id="contaiter">
    <?php
        if(isset($result) && $result != null){
            foreach($result as $key => $row){
                //mengandung id course untuk penjurusan course yg dipilih
                echo '<a class="card" href="teacherCourseModul?course='.$row->getIdCourse().'">';
                echo '<img src="view/images/gambarcourses/'.$row->getGambarCourse().'" class="card-img">';
                echo '<div class="text">'.$row->getNamaCourse().' ( '.$row->getJmlh().' )</div>';
                echo '</a>';
            }
        }
    ?>
</div>