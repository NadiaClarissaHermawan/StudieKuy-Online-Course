<div class="content1">
    <div class="tulisanPutih hurufBesar"><?php echo $nama_bidang?></div>
</div>

<hr>
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