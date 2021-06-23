<?php
    // if(session_status() == PHP_SESSION_NONE){
    //     session_start();
    // }

    // //kalo belom login gabisa kesini
    // if(!isset($_SESSION['status'])){
    //     header("Location: userLogin");
    //     session_destroy();
    //     exit;
    // }
?>
<div class="content1">
    <div class="tulisanPutih hurufBesar">Java Basic Programming</div>
</div>
<hr>
<div class="content2">
    <img class="menu-in-course content2-1" src="view/images/module.png">
    <!-- <a href="userCourseModul" class="menu-in-course content2-1"><img class="menu-in-course" src="view/images/module.png"></a> -->
	<!-- <a href="" class="content2-3" style="height:70%"><img class="menu-in-course" src="view/images/progress.png"></a> -->
    <img class="menu-in-course content2-3" src="view/images/progress.png">
    <!-- <a href="" class="content2-2" style="width: 33%;height:70%" id="myBtn" onsubmit=""><img class="menu-in-course" src="view/images/exam.png" id="myBtn"></a> -->

    <img class="menu-in-course content2-2" src="view/images/exam.png" id="myBtn">
    <!-- <button class="buttonR" id="myBtn" onsubmit="">Submit</button> -->
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