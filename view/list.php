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
<div class="content1">
    <div class="tulisanPutih hurufBesar">Attending Courses</div>
</div>
<?php
    foreach($result as $key=>$row){
        //lanjutin ke menu exam / course / progress 1 taken course
        echo '<form method="GET" action="coursesDetail">';
        echo '<div class="content2 tulisanPutih">';
        echo '<div class="content2-1 hurufSedang">'.$row->getNamaCourse().'</div>';
        echo '<input type="hidden" value="'.$row->getIdMemCourse().'" name="idMemCourse">';
        echo '<input type="hidden" value="'.$row->getIdCourse().'" name="idCourse">';
        echo '<button type="submit" class="kotak hurufKecil tulisanCoklat">Go to Course</button>';
        echo '</div>';
        echo '</form>';
    }
?>
