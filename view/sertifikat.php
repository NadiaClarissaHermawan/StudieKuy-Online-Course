<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //kalo belom login gabisa kesini
    if(!isset($_SESSION['status'])){
        header("Location: userLogin");
        session_destroy();
        exit;
    }
?>
<div class="sertif">
	<p class="judul tulisanCoklat">Studie Kuy !</p>
	<hr class="garis">
	<p class="subJudul">CERTIFICATE OF COMPLETION</p>
	<p class="txt"> This certificate is presented to :</p>
	<p class="nama"><?php echo $result[0]->getRealName()?></p>
	<p class="txt">for successfully completing <?php echo $result[0]->getSertif()?> Course</p>
	<p class="txt">Given on the <?php echo $result[0]->getTanggal()?></p>

	<div class="ttd">
		<div class="ttd1">
			<div class="sign">Sha</div>
			<hr class="hrttd">
			<p class="txt">Natasha Benedicta, B.Sc</p>
			<p class="txt">Co-Founder</p>
		</div>
		<div class="ttd2">
			<div class="sign">Nad</div>
			<hr class="hrttd">
			<p class="txt">Nadia Clarissa, Ph.D</p>
			<p class="txt">Founder</p>
		</div>
		<div class="ttd3">
			<div class="sign">Rio</div>
			<hr class="hrttd">
			<p class="txt">Prof. Stanislaus D. E., M.Sc</p>
			<p class="txt">Co-Founder</p>
		</div>
	</div>
</div>