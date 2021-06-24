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
?>

<div class="progress tulisanPutih hurufBesar">
    <div class="kotakMerah" id="myExam">
        My Exam
        <hr class="garis">
        <div class="isiKotak">Not Taken Yet</div>
    </div>
    <div class="kotakMerah" id="certificate">
        Certificate
        <hr class="garis">
        <button class="isiKotak tulisanPutih hurufBesar" id="unReqButton">Request</button>
    </div>
</div>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span id="tutup">&times;</span>
        <p class="tulisanHitam">Take the Exam First!</p>
    </div>
</div>
<!-- Template utk status lainnya -->
<!-- Lulus -->
<div class="progress tulisanPutih hurufBesar">
    <div class="kotakMerah" id="myExam">
        My Exam
        <hr class="garis">
        <div class="isiKotak">100/100</div>
    </div>
    <div class="kotakMerah" id="certificate">
        Certificate
        <hr class="garis">
        <button class="isiKotak tulisanPutih hurufBesar" id="ReqButton">Request</button>
    </div>
</div>
<!-- belom lulus -->
<div class="progress tulisanPutih hurufBesar">
    <div class="kotakMerah" id="myExam">
        My Exam
        <hr class="garis">
        <div class="isiKotak2">40/100
            <p class="ket hurufKecil">Sorry you didn't pass the exam.</p>
            <a href="coursesDetail"><button id="retake" class="tulisanCoklat hurufKecil">Retake Exam</button></a>
        </div>
    </div>
    <div class="kotakMerah" id="certificate">
        Certificate
        <hr class="garis">
        <button class="isiKotak tulisanPutih hurufBesar" id="unReqButton">Request</button>
    </div>
</div>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span id="tutup">&times;</span>
        <p class="tulisanHitam">You should retake the Exam.</p>
    </div>
</div>

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