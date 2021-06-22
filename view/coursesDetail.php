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
    <a href="" class="content2-1"><img src="view/images/module.png"></a>
    <a href="" class="content2-2"><img src="view/images/exam.png"></a>
</div>
<div class="content3">
	<a href=""><img src="view/images/progress.png"></a>
</div>