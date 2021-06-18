
<!-- userProfile.php -->
<div id="contentMainPage">
    <!-- judul -->
    <div class="title">
        <div class="title-kiri tulisanPutih" style="font-family:  Calligraffitti;">My Profile </div>
        <div class="title-kanan">
            <a href="signOutUser" class="tulisanPutih hurufSedang" style="width: 10%;"></a>
            <a href="signOutUser" class="tulisanPutih hurufSedang">Sign Out</a>
        </div>
    </div>
    <hr>

    <div class="content1">
        <div class="content1-kiri-edit">
            <?php
                if(session_status() == PHP_SESSION_NONE){
                    session_start();
                }
                $pic = 'view/images/profilepicture/'.$result[0]->getProfpic();
                echo '<img id="gambar" src="'.$pic.'" class="content1-image ">'; 
            ?>
            <form id="formUpload" enctype="multipart/form-data">
                Photo : <input type="file" name="file">
                <input type="submit" value="Upload">
            </form>
            <!-- <form id="formUpload" enctype="multipart/form-data"> -->
                <!-- <input type="file" id="gantiprofpic"  name="file"/> -->
                <!-- <input type="submit" id="profpic-button" value="Upload" class="tulisanPutih edit-input-box" style="margin-top: 5%;"/> -->
            <!-- </form>     -->
        </div>
        <!-- <form method="post" action="userProfileEdit" style="display: flex;">
            <div class="content1-tengah-edit tulisanPutih hurufBesar">
                <table class="profileTable">
                    <tr>
                        <td class="profile-title">Username</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getUsername().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Name</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getRealname().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Email</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getEmail().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Address</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getAddress().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Phone Number</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getPhone().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Password</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="password" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getPassword().'"/></td>';
                        ?>
                    </tr>
                </table>
            </div>
            <div class="content1-kanan-edit tulisanPutih hurufBesar">
                <button type="submit" class="tulisanCoklat" id="submit-edit-profile">Submit</button>
            </div>
        </form> -->
    </div>    
</div>

<script defer>
    <?php var_dump("anything"); die;?>
	let formData = new FormData();
	const fil = document.querySelector('input[type="file"]');

	fil.onchange = function(){
		//ambil disini & masukin ke formData
		formData.append('file', fil.files[0]);

		//proses AJAX fetch
		fetch('uploadFile', {
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
		gambar.src = "/TugasBesar/view/images/profilepicture/".<?php echo $_SESSION["id_pengguna"]?>.".jpg";
        console.log(gambar.src);
	}
</script>