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
<div class="contentExam">
    <div class="tulisanPutih hurufBesar"><?php echo $namaCourse?> Exam</div>
</div>
<hr>

<div class="soal" id="form">
    <ol>
        <?php 
            if($result != null ){
                foreach($result as $key => $row){
                    echo '<li class="pertanyaan">'.$row->getSoal().'</li>';
                    if($row->getKunjaw() == 1){
                        echo '<input type="radio" checked name="opt'.$key.'" value="1"><label class="radio">'.$row->getOpsi1().'</label><br>';
                    }else{
                        echo '<input type="radio" name="opt'.$key.'" value="1"><label class="radio">'.$row->getOpsi1().'</label><br>';
                    }
                    if($row->getKunjaw() == 2){
                        echo '<input checked type="radio" name="opt'.$key.'" value="2"><label class="radio">'.$row->getOpsi2().'</label><br>';
                    }else{
                        echo '<input type="radio" name="opt'.$key.'" value="2"><label class="radio">'.$row->getOpsi2().'</label><br>';
                    }
                    if($row->getKunjaw() == 3){
                        echo '<input type="radio" checked name="opt'.$key.'" value="3"><label class="radio">'.$row->getOpsi3().'</label><br>';
                    }else{
                        echo '<input type="radio" name="opt'.$key.'" value="3"><label class="radio">'.$row->getOpsi3().'</label><br>';
                    }
                    echo '<hr class="bts">';
                }
            }
        ?>  
    </ol>
    <input type="hidden" name="idCourse" value="<?php echo $result[0]->getIdCourses()?>"/>
    <a href="teacherCourseModul?course=<?php echo $row->getIdCourses()?>"><button id="edit-exam">Back to Course Modul</button></a>
</div>
<?php 
    // echo '<a href="teacherCourseModul?course='.$row->getIdCourse().'"><button id="edit-exam">Back to Modul and Exam</button></a>';
?>

<script>
</script>