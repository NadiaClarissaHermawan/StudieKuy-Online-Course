<!-- buyCourse.css, layoutUserTopup.php, indexController.php, viewIndex -->
<?php 
    //saldo cukup
     if($indikator == 1){
        echo '<div class="joinSuccess tulisanPutih hurufBesar">';
        echo '<div class="status tulisanPutih hurufBesar">Transaction Success!</div>';
        echo '<img src="view/images/success.png" class="gbr">';
        echo '<div class="welcome">'.$namaCourse.' has been purchased!</div>';
        echo '<a href="coursesList"><button class="buyButton">Go to My Course</button></a>';
        echo '<?php //echo $namaCourse?></div>';
        echo '</div>';

    //saldo tdk cukup
     }else{
        echo '<div class="joinFailed tulisanPutih hurufBesar">';
        echo '<div class="status tulisanPutih hurufBesar">Transaction Failed!</div>';
        echo '<img src="view/images/failed.png" class="gbr" style="padding-top: 100px; border-radius: 340%;">';
        echo '<div class="welcome">Sorry, your balance is not enough.</div>';
        echo '<a href="userTopup"><button class="buyButton">Top Up Now</button></a>';
        echo '<?php //echo $namaCourse?></div>';
        echo '</div>';
     }
?>
