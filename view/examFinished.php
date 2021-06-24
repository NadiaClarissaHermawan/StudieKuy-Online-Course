<!-- Layout gabung ke layout CourseExam -->

<?php
    // if(session_status() == PHP_SESSION_NONE){
    //     session_start();
    // }

    // // kalo belom login gabisa kesini
    // if(!isset($_SESSION['status'])){
    //     header("Location: userLogin");
    //     session_destroy();
    //     exit;
    // }
?>
<div class="content1 tulisanPutih hurufBesar">CONGRATULATION</div>
<img src="view/images/congrats.jpg" class="pic">
<button class="buttonM">See My Progress</button>

<script>
    let modal = document.getElementById("myModal");
    let btn = document.getElementById("myBtn");
    let span = document.getElementsByClassName("close")[0];

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