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

<div style="height: 450px;">
    <?php
        foreach($result as $key=>$row){
            //lanjutin ke menu exam / course / progress 1 taken course
            echo '<form method="GET" action="coursesDetail">';
            echo '<div class="content2 tulisanPutih">';
            echo '<div class="content2-1 hurufSedang">'.$row->getNamaCourse().'</div>';
            echo '<input type="hidden" value="'.$row->getIdMemCourse().'" name="idMemCourse">';
            echo '<button type="submit" class="kotak hurufKecil tulisanCoklat">Go to Course</button>';
            echo '</div>';
            echo '</form>';
        }
    ?>
</div>

<div style="display: flex; text-align:center; justify-content:center; align-items:center">
    <?php

        // pagination angka halamannya
        for($i =1; $i<=$jmlhPage; $i++){
            if(isset($start) && $i == $start){
                echo '<a class="pageNow" style=" font-size:1.5vw; margin: 10px; text-decoration:none" href="coursesList?start='.$i.'">'.$i.'</a>';
            }else if(isset($start) && $start == 0 && $i == 1){
                echo '<a class="pageNow" style=" font-size:1.5vw; margin: 10px; text-decoration:none" href="coursesList?start='.$i.'">'.$i.'</a>';
            }else{
                echo '<a style="color:white; font-size:1.5vw; margin: 10px; text-decoration:none" href="coursesList?start='.$i.'">'.$i.'</a>';
        
            }
        }
    ?>
</div>
