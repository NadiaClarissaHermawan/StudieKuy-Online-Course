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
<div class="content1">
    <div class="tulisanPutih hurufBesar">New Course Detail</div>
</div>
<hr>
<div class="content2 tulisanPutih">
    <div class="content2-1">Course Name</div>
    <div class="content2-2">:<input type="text" name="courseName" class="kotakInput tulisanCoklat"></div>
</div>
<div class="content2 tulisanPutih">
    <div class="content2-1">Course Category</div>
    <div class="content2-2">:<input type="text" name="courseCategory" class="kotakInput tulisanCoklat"></div>  
</div>
<div class="content2 tulisanPutih">
    <div class="content2-1">Course Description</div>
    <div class="content2-2">:<input type="text" name="courseDesc" class="kotakInput tulisanCoklat"></div>  
</div>
<div class="content2 tulisanPutih">
    <div class="content2-1">Cost</div>
    <div class="content2-2">:<input type="number" name="courseCost" class="kotakInput tulisanCoklat"></div>  
</div>
<div class="content2 tulisanPutih">
    <div class="content2-1">Completeness Criteria</div>
    <div class="content2-2">:<input type="number" name="courseKKM" class="kotakInput tulisanCoklat"></div>  
</div>
<a href="uploadModul"><img src="view/images/createCourse.jpg" class="content-image"></a>