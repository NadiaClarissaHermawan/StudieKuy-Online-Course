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
<div id="ser" class="sertif">
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

<script>
	function printss(){
		let head1 = document.getElementById("head1");
		let head2 = document.getElementById("head2");
		let head3 = document.getElementById("head3");
		head1.style.visibility ="hidden";
		head2.style.visibility ="hidden";
		head3.style.visibility ="hidden";
		ser.style.marginTop = "20px";
		window.print();
		head1.style.visibility ="visible";
		head2.style.visibility ="visible";
		head3.style.visibility ="visible";
		ser.style.marginTop = "159px";
		return;
	}
</script>