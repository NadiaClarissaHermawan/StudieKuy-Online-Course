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
<div>
    <ul class="navKiri" style="padding:0px">
        <!-- masih isi php dr modul teacher-->
        <?php
            if(isset($result) && $result != null){
                echo '<hr class="batas">';
                $nomor = 1;
                foreach($result as $key => $row){
                    if($row->getNamaModul() == $selectedModulName){
                        echo '<a href="userCourseModul?namaModul='.$row->getNamaModul().'"><li class="menu selected">'.$row->getNamaModul().'</li></a>';
                    }else if($selectedModulName == "" && $nomor == 1){
                        echo '<a href="userCourseModul?namaModul='.$row->getNamaModul().'"><li class="menu selected">'.$row->getNamaModul().'</li></a>';
                    }else{
                        echo '<a href="userCourseModul?namaModul='.$row->getNamaModul().'"><li class="menu">'.$row->getNamaModul().'</li></a>';
                    }
                    echo '<hr class="batas">';
                    $nomor ++;
                }
            }
        ?>
    </ul>
    <div class="vidShow tulisanCoklat hurufBesar">
        <?php 
            echo '<video controls class="videoModul">';

            //sumber modul berupa hasil concat $id_modul.'mp4'
            echo '<source src="view/modul/'.$sumberModul.'" type="video/mp4">';
            echo '</video>';
        ?>
    </div>
</div>
