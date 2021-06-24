
<div class="content1">
    <div class="tulisanPutih hurufBesar"><?php echo $namaCourse?></div>
</div>

<hr>
<div class="course-detail-isi">
    <div class="course-detail-kiri">
        <img src="view/images/gambarcourses/<?php echo $result[0]->getGambarCourse()?>" class="course-img" style="margin-top: 12%;">
        <a class="course-detail-button" href="buyCourse">
            <h2 style="margin: 0; font-size:1.5vw" class="tulisanHitam">Enroll Now for only<br>Rp.<?php echo $result[0]->getTarif()?>,-</h2>
        </a>
    </div>
    <div class="course-detail-kanan">
        <p  style="text-align: justify;line-height:140%" class="tulisanPutihx hurufSedang"><?php echo $result[0]->getKeterangan()?></p> 
        <p class="tulisanPutihx hurufSedang" style="text-align: left;"><?php echo $namaCourse?> course includes :</p>
        <ol class="tulisanPutihx hurufKecil" style="font-size: 1.4vw; padding-left:0px">
            <?php
                if($namaModul != null){
                    foreach ($namaModul as $key => $row){
                        echo '<li class="list" style="text-align:left">'.$row['nama_modul'].'</li>';
                    }
                }
            ?>
            <li class="list">Soal Ujian akhir</li>
        </ol>
    </div>
</div>