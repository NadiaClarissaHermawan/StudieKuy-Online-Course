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
<div>
    <ul class="navKiri" style="padding:0px">
        <?php
            if(isset($result) && $result != null){
                foreach($result as $key => $row){
                    echo '<a href="userCourseModul?namaModul='.$row->getNamaModul().'"><li class="menu">'.$row->getNamaModul().'</li></a>';
                    echo '<hr class="batas">';
                }
            }
        ?>
    </ul>
    <div class="vidShow tulisanCoklat hurufBesar">
        <?php 
            echo '<video controls autoplay class="videoModul">';
            echo '<source src="view/modul/'.$sumberModul.'" type="video/mp4">';
            echo '</video>';
        ?>
    </div>
</div>
