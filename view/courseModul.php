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
    <div class="tulisanPutih hurufBesar"><?php echo $result[0]->getNamaCourse()?> Modules</div>
</div>  
<hr>

<div class="white-box">
    <?php
        if(isset($result) && $result!=null){
            foreach($result as $key => $row){
                echo '<a class="modul">';
                echo '<i class="material-icons md-36" id="down">cloud_download</i>';
                echo '<div class="text">Modul'.$row->getNamaModul().'</div>';
                echo '</a>';
            }
        }
    ?>

</div>