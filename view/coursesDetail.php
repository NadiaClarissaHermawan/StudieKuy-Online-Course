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
    <div class="tulisanPutih hurufBesar"><?php echo $namaCourse?></div>
</div>
<hr>
<div class="content2">
    <?php
        $_SESSION['idMemCourse'] = $_GET['idMemCourse'];
    ?>
    <a href="userCourseModul" class="menu-in-course content2-1"><img style="width:107%; height:100%" class="menu-in-course" src="view/images/module.png"></a>
	<a href="progress" class="content2-3" style="height:70%"><img style="width:95%; height:100%" class="menu-in-course" src="view/images/progress.png"></a>
    <img class="menu-in-course content2-2" src="view/images/exam.png" id="myBtn">
</div>
<!-- if exam belom di take -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p class="tulisanHitam">Begin exam?</p>
        <p class="hurufKecil">You've got 1 hour to finish the exam after clicking this button below.</p>
        <!-- Test button sementara mau arahin ke home dlu -->
        <a href="userCourseExam"><button class="buttonM tulisanCoklat hurufSedang">Yes</button></a>
    </div>
</div>
<script>
    let modal = document.getElementById("myModal");
    let btn = document.getElementById("myBtn");
    let span = document.getElementsByClassName("close")[0];

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