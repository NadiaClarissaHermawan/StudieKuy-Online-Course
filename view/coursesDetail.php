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
    <div class="tulisanPutih hurufBesar">Java Basic Programming</div>
</div>
<hr>
<div class="content2">
    <a href="" class="content2-1 " style="width: 33%; height:70%"><img class="menu-in-course" src="view/images/module.png"></a>
	<a href="" class="content2-3" style="height:70%"><img class="menu-in-course" src="view/images/progress.png"></a>
    <a href="" class="content2-2 " style="width: 33%;height:70%"><img class="menu-in-course" src="view/images/exam.png"></a>
</div>
