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

<form action="cekJawaban" class="white-box" method="POST" id="form">
    <ol>
        <?php 
            if(isset($result) && $result != null){
                foreach($result as $key => $row){
                    echo '<li class="pertanyaan">'.$row->getSoal().'</li>';
                    echo '<input type="radio" name="opt'.$key.'" value="1"><label class="radio">'.$row->getOpsi1().'</label><br>';
                    echo '<input type="radio" name="opt'.$key.'" value="2"><label class="radio">'.$row->getOpsi2().'</label><br>';
                    echo '<input type="radio" name="opt'.$key.'" value="3"><label class="radio">'.$row->getOpsi3().'</label><br>';
                    echo '<hr class="bts">';
                }
            }
        ?> 
    </ol>

    <input type="hidden" name="idCourse" value="<?php echo $result[0]->getIdCourses()?>"/>

    <!-- status time out, 0 tidak time out -->
    <input type="hidden" name="timeOutStatus" id="statusTimeOut" value="0"/>
    <!-- <button id="submit-answer">Submit Answer</button> -->
</form>

<button id="submit-answer">Submit Answer</button>
<div id="myModal" class="modal">
    <div class="modal-content">
        <p class="tulisanHitam">Are you sure that you want to submit the answers?</p>
        <a href="examFinished?idMemCourse=<?php echo $id_memCourse?>"><button class="buttonM tulisanCoklat hurufSedang">Yes</button></a>
        <button id="close" class="buttonM tulisanCoklat hurufSedang">No</button>
    </div>
</div>

<!-- count down waktu exam  -->
<script>
    // Set the date we're counting down to
    let countDownDate = new Date();
    //set berapa jam di plus disini
    countDownDate.setHours(countDownDate.getHours()+1);
    countDownDate.getTime();

    // Update the count down every 1 second
    let x = setInterval(function() {

      // Get today's date and time
      let now = new Date().getTime();
        
      // Find the distance between now and the count down date
      let distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML =  minutes + "m " + seconds + "s ";
        
      // If the count down is over
      if (distance < 0) {
        clearInterval(x);
        let status_timeout = document.getElementById('statusTimeOut');
        status_timeout.textContent = "1";

        let form = document.getElementById('form');
        form.submit();
      }
    }, 1000);

    //modal
    let modal = document.getElementById("myModal");
    let btn = document.getElementById("submit-answer");
    let span = document.getElementById("close");

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