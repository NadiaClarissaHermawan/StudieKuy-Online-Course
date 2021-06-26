<!-- nyambung ke layoutCourseExam.php, timeOut.css -->
<style>
    .created {
        background-color: lightsalmon;
        border-radius: 20px;
        text-decoration: none;
        font-size: 1.5vw;
        padding: 10px ;
        color: black;
        border: none;
    }

    .created:hover {
        transition: 0.5s;
        cursor: pointer;
        color: white;
        background-color: orange;
        box-shadow: 0 2.8px 2.2px rgba(0, 0, 0, 0.034), 0 6.7px 5.3px rgba(0, 0, 0, 0.048), 0 12.5px 10px rgba(0, 0, 0, 0.06), 0 22.3px 17.9px rgba(0, 0, 0, 0.072), 0 41.8px 33.4px rgba(0, 0, 0, 0.086), 0 100px 80px rgba(0, 0, 0, 0.12);
    }
</style>
<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // kalo belom login gabisa kesini
    if(!isset($_SESSION['statusTeacher'])){
        header("Location: teacherLogin");
        session_destroy();
        exit;
    }
?>
<div style="display: flex; align-items:center; justify-content:center; text-align:center; flex-direction:column; margin-top:200px">
    <div class="tulisanPutih" style="font-size: 3vw;">
        Course has been created !
    </div>
    <img src="view/images/courseCreated.png" class="image" style="width: 40%;">
    <a href="indexTeacher" class="created">Return to main page</a>
</div>
    
