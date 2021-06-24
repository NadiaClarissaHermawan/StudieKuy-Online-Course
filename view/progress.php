<!-- nyambung ke layoutCourseExam.php, progress.css -->
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

    //belum ikut ujian
    if($result[0]->getStatusKetuntasan() == 0){
        echo '<div class="progress tulisanPutih hurufBesar">';
        echo '<div class="kotakMerah" id="myExam">';
        echo 'My Exam';
        echo '<hr class="garis">';
        echo '<div class="isiKotak">Not Taken Yet</div>';
        echo '</div>';
        echo '<div class="kotakMerah" id="certificate">';
        echo 'Certificate';
        echo '<hr class="garis">';
        echo '<button class="isiKotak tulisanPutih hurufBesar" id="unReqButton">Request</button>';
        echo '</div>';
        echo '</div>';
        echo '<div id="myModal" class="modal">';
        echo '<div class="modal-content">';
        echo '<span id="tutup">&times;</span>';
        echo '<p class="tulisanHitam">Take the Exam First!</p>';
        echo '</div>';
        echo '</div>';

    //lulus
    }else if($result[0]->getStatusKetuntasan() == 1){
        echo '<div class="progress tulisanPutih hurufBesar">';
        echo '<div class="kotakMerah" id="myExam">';
        echo 'My Exam';
        echo '<hr class="garis">';
        echo '<div class="isiKotak">'.$result[0]->getNilaiAkhir().'/100</div>';
        echo '</div>';
        echo '<div class="kotakMerah" id="certificate">';
        echo 'Certificate';
        echo '<hr class="garis">';

        //kalau sdh diverifikasi
        if($result[0]->getStatusVerifikasi() == 1){
            echo '<a href="sertifikat" class="isiKotak tulisanPutih hurufBesar" id="ReqButton">Request</a>';

        //kalau blm diverifikasi
        }else{
            echo 'alert("Sertifikat belum di verifikasi, mohon coba beberapa saat lagi")';
            echo '<a href="requestSertifikat" class="isiKotak tulisanPutih hurufBesar" id="ReqButton">Request</a>';
        }
        
        echo '</div>';
        echo '</div>';

    //tdk lulus
    }else{
        echo '<div class="progress tulisanPutih hurufBesar">';
        echo '<div class="kotakMerah" id="myExam">';
        echo 'My Exam';
        echo '<hr class="garis">';
        echo '<div class="isiKotak2">'.$result[0]->getNilaiAkhir().'/100';
        echo '<p class="ket hurufKecil">Sorry you did not pass the exam.</p>';
        echo '<a href="userCourseExam"><button id="retake" class="tulisanCoklat hurufKecil">Retake Exam</button></a>';
        echo '</div>';
        echo '</div>';
        echo '<div class="kotakMerah" id="certificate">';
        echo 'Certificate';
        echo '<hr class="garis">';
        echo '<button class="isiKotak tulisanPutih hurufBesar" id="unReqButton">Request</button>';
        echo '</div>';
        echo '</div>';
        echo '<div id="myModal" class="modal">';
        echo '<div class="modal-content">';
        echo '<span id="tutup">&times;</span>';
        echo '<p class="tulisanHitam">You should retake the Exam.</p>';
        echo '</div>';
        echo '</div>';
    }
?>

<script>
    let modal = document.getElementById("myModal");
    let btn = document.getElementById("unReqButton");
    let span = document.getElementById("tutup");

    btn.onclick = function() {
        modal.style.display = "block";
        modal.style.visibility = "visible";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>