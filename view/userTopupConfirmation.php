<div id="topup-content" style="overflow-x: hidden;">
    <div id="topup-content1">
        <h1 id="judulTopup" class="tulisanPutih hurufBesar">Transaction</h1>
    </div>
    <hr id="pembatasTopup">
    <div id="topup-content1">
        <h1 id="judulTopup" class="tulisanPutih hurufBesar" style="font-size: 2vw;">Top Up Confirmation</h1>
    </div>

    <form id="topup-content2" enctype="multipart/form-data" action="fix-topup" method="POST">
        <div id="topup-content2-kesamping" style="align-items:flex-start; margin-left:10%">
            <img src="view/images/topupConfirm.png" id="confirm-img"/>
            <div id="confirm-tab">
                <div id="confirm-price">
                    <div id="confirm-price-inside">
                        <div style="display: flex; align-items:flex-start; margin-right:50%" class="tulisanCoklat">Price:</div>
                        <div style="display: inline-block; align-items:flex-end" class="tulisanCoklat"><?php echo $nominal?>.000,-</div>
                    </div>
                    <hr style="width: 70%; border-top:3px solid black; border-bottom:none">
                </div>

                <div id="confirm-bukti-pembayaran">
                        <div class="tulisanPutih" style="font-size: 2vw;">Upload bukti transfer :</div>
                </div>
                
                <div id="confirm-upload-bukti" class="tulisanPutih">
                    <input  type="file" id="file" name="file"  accept="image/*" style="margin-left:20%">
                    <input type="hidden" name="nominal" value="<?php echo $nominal?>"/>
                    <div id="error" style="color: red; font-size:1vw"></div>
                    <div class="gambar-submit">
                        <img src="" id="gambar" style="visibility: hidden;"/>
                    </div>
                    <button style="margin-top: 5%;" id="sub-btn" class="confirm-button tulisanPutih" type="submit"  onclick="beli()">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div> 

<script defer>
    //AJAX untuk tampilin foto yg diupload
    let formData = new FormData();
	const fill = document.querySelector('input[type="file"]');

	fill.onchange = function(){
		//ambil disini & masukin ke formData
		formData.append('file', fill.files[0]);

		//proses AJAX fetch
		fetch('uploadBukti', {
			method: 'POST',
			body: formData
		})
		
		//notif aja
		.then(response => response.json())
		.then(response => console.log('Success:',JSON.stringify(response)))
		.then(result =>{
			console.log("success", result);
		})
		.catch(error =>{
			console.log("error", error);
		})
		let gambar = document.getElementById("gambar");
        gambar.style.visibility = "visible";
        gambar.src="";
		gambar.src = "/TugasBesar/view/images/buktitransfer/".concat(<?php echo $_SESSION['id_pengguna']?>).concat(".jpg");
	}


    //cek apakah sudah ada uploadan file
    const bukti = document.getElementById("gambar");
    let err = document.getElementById("error");

    function beli(){
        if(bukti.getAttribute('src') == ""){
            event.preventDefault();
            err.textContent = "Mohon upload bukti transaksi";
            err.style.visibility = "visible";
            return false;
        }else{
            err.textContent = "";
            err.style.visibility= "hidden";
            return true;
        }
    }
</script>