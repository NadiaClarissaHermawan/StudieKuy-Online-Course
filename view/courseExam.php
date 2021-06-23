<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    // kalo belom login gabisa kesini
    if(!isset($_SESSION['status'])){
        header("Location: userLogin");
        session_destroy();
        exit;
    }
?>

<div class="content1">
    <div class="tulisanPutih hurufBesar"><?php echo $namaCourse?> Exam</div>
</div>
<hr>

<form action="" class="white-box">
    <ol>
        <?php 
            if(isset($result) && $result != null){
                foreach($result as $key => $row){
                    echo '<li class="pertanyaan">'.$row->getSoal().'</li>';
                    echo '<input type="radio" name="opt" value="1"><label class="radio">'.$row->getOpsi1().'</label><br>';
                    echo '<input type="radio" name="opt" value="2"><label class="radio">'.$row->getOpsi2().'</label><br>';
                    echo '<input type="radio" name="opt" value="3"><label class="radio">'.$row->getOpsi3().'</label><br>';
                    echo '<hr class="bts">';
                }
            }
        ?> 
    </ol>
    <button id="myBtn">Submit Answer</button>
</form>

