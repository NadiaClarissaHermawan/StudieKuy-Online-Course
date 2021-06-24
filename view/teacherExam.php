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
<div class="contentExam">
    <div class="tulisanPutih hurufBesar"><?php //echo $namaCourse?> Exam</div>
</div>
<hr>

<form action="editExam" class="white-box" method="POST" id="form">
    <ol>
        <li>Test1</li>
        <li>Test1</li>
        <li>Test1</li>
        <?php 
            // if(isset($result) && $result != null){
            //     foreach($result as $key => $row){
            //         echo '<li class="pertanyaan">'.$row->getSoal().'</li>';
            //         echo '<input type="radio" name="opt'.$key.'" value="1"><label class="radio">'.$row->getOpsi1().'</label><br>';
            //         echo '<input type="radio" name="opt'.$key.'" value="2"><label class="radio">'.$row->getOpsi2().'</label><br>';
            //         echo '<input type="radio" name="opt'.$key.'" value="3"><label class="radio">'.$row->getOpsi3().'</label><br>';
            //         echo '<hr class="bts">';
            //     }
            // }
        ?> 
    </ol>

    <input type="hidden" name="idCourse" value="<?php echo $result[0]->getIdCourses()?>"/>
</form>

<button id="editExam">Edit Exam</button>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p class="tulisanHitam">Exam has been edited.</p>
    </div>
</div>

<script>
    let modal = document.getElementById("myModal");
    let btn = document.getElementById("editExam");
    let span = document.getElementById("close");

    btn.onclick = function() {
        modal.style.display = "block";
        modal.style.visibility = "visible";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>