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
<div class="tcourse-main">
    <div class="tcourse-judul">
        <h1>TEACHER COURSE LIST</h1>
    </div>
    <div class="tcourse-isi">
        yang ini ya yang di copy2
        <div class="tcourse-card">
            <img src="view/images/course3.png">
            <div class="tcourse-card-info">
                <h1>Java Basic Programming</h1>
            </div>
        </div>
    </div>
</div>