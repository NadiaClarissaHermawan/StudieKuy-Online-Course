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
<div id="contentMainPage">
    <!-- blok coklat paling atas  -->
    <div class="content1">
        <div class="content1-kiri">
            <img src="view/images/indexTeacher.png" class="content1-image"/>
        </div>
        <div class="content1-kanan">
            <p class="tulisanPutih welcome" >
                WELCOME, <?php echo $result[0]->getRealname()?>!
            </p>
            <a href="teacherCourse" class="menuCourse-button">
                <div class="menuCourse-kiri">
                    <img src="view/images/menuCourse.jpg" style="width:100%" class="menuCourse-image">
                </div>
                <div class="menuCourse-kanan hurufKecil">
                    <p class="tulisanCoklat"  style="height: 20px; font-size: 2vw;">Course</p>
                </div>
            </a>
            <a href="createCourse" class="menuCourse-button">
                <div class="menuCourse-kiri" style="height: 100px;">
                    <img src="view/images/createCourse.jpg" class="menuCourse-image">
                </div>
                <div class="menuCourse-kanan hurufKecil">
                    <p class="tulisanCoklat" style="font-size: 2vw;">Create Course</p>
                </div>
            </a>
            <a href="teacherProfile" class="menuCourse-button" style="height: 109px;">
                <div class="menuCourse-kiri"  style="height: 100px;">
                    <img src="view/images/myProfile.jpg" class="menuCourse-image">
                </div>
                <div class="menuCourse-kanan hurufKecil">
                    <p class="tulisanCoklat" style="font-size: 2vw;">My Profile</p>
                </div>
            </a>
        </div>
    </div>
</div>
