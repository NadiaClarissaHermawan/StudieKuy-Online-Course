<!-- userEditProfile.php -->

<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    //kalo belom login gabisa kesini
    if(!isset($_SESSION['statusTeacher'])){
        header("Location: teacherLogin");
        session_destroy();
        exit;
    }
?>
<div id="contentMainPage">
    <!-- judul -->
    <div class="title">
        <div class="title-kiri tulisanPutih" style="font-family:  Calligraffitti;">My Profile </div>
        <div class="title-kanan" style="justify-content: flex-end;">
            <span class="material-icons md-36" id="del"  onclick="deleteAccount()">delete</span>
        </div>
    </div>
    <hr>

    <div class="content1">
        <!-- update prof pic -->
        <div id="input-gbr" class="content1-kiri-edit">
            <img class="content1-image" src="/TugasBesar/view/images/profilepicture/<?php echo $result->getProfpic()?>" id="gambar"/>
            <form id="formUpload" enctype="multipart/form-data" style="margin-top: 3%">
                <input class="submit-edit-profile" type="file" name="file"  id="baten" style="width:40%;">
            </form>
        </div>
        
        <!-- update data diri -->
        <form method="post" action="teacherProfileTextEdit" style="display: flex;" >
            <div class="content1-tengah-edit tulisanPutih hurufBesar" >
                <table class="profileTable2">
                    <tr>
                        <td class="td-edit profile-title">Name</td>
                        <td class="td-edit" style="padding-right:20px">:</td>
                        <?php   
                            echo 
                            '<td class="td-edit">
                                <input type="text" class="edit-input-box tulisanPutih" style="text-align:left;  width:150%" name="urealname" id="urealname" oninput="checkURealName()" value="'.$result->getRealname().'"/>
                            </td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="td-edit" style="line-height: 20px;"></td>
                        <td class="td-edit" style="line-height: 20px;"></td>
                        <td class="td-edit" style="line-height: 7px;">
                            <span id="nameError" class="td-edit errorMessage" style="line-height:10px; font-size:1vw; width:150%">Nama harus lebih dari 3 karakter</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-edit profile-title">Username</td>
                        <td class="td-edit" style="padding-right:20px">:</td>
                        <?php   
                            echo 
                            '<td class="td-edit">
                                <input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" name="uname" id="uname" oninput="checkUName()" value="'.$result->getUsername().'"/>
                            </td>';
                        ?> 
                    </tr>
                    <tr>
                        <td class="td-edit" style="line-height: 20px;"></td>
                        <td class="td-edit"  style="line-height: 20px;"></td>
                        <td class="td-edit"  style="line-height: 20px;">
                            <span class="td-edit errorMessage" style="line-height:10px; font-size:1vw" id="userError"style=" color:red">username</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-edit profile-title">Email</td>
                        <td class="td-edit" style="padding-right:20px">:</td>
                        <?php   
                            echo 
                            '<td class="td-edit">
                                <input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" name="uemail" id="uemail" oninput="checkEmail()" value="'.$result->getEmail().'"/>
                            </td>';
                        ?> 
                    </tr>
                    <tr>
                        <td class="td-edit" style="line-height: 20px;"></td>
                        <td class="td-edit"  style="line-height: 20px;"></td>
                        <td class="td-edit"  style="line-height: 20px;">
                            <span class="td-edit errorMessage" style="line-height:10px; font-size:1vw" id="emailError"style=" color:red">email</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="td-edit profile-title">Password</td>
                        <td class="td-edit" style="padding-right:20px">:</td>
                        <?php   
                            echo 
                            '<td class="td-edit">
                                <input type="password" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" name="upass" id="upass" oninput="checkPw()" value="'.$result->getPassword().'"/>
                            </td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="td-edit" style="line-height: 20px;"></td>
                        <td class="td-edit" style="line-height: 20px;"></td>
                        <td class="td-edit" style="line-height: 20px;">
                            <span id="pwError" class="td-edit errorMessage" style="line-height:10px; font-size:1vw">Password harus terdiri lebih dari 8 karakter</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="content1-kanan-edit">
                    <td class="td-edit">
                        <input type="submit" class="submit-edit-profile" id="sbt" onclick="checkValidation()"/>
                    </td>
            </div>
        </form>
    </div>
</div>

<script defer>
	let formData = new FormData();
	const fil = document.querySelector('input[type="file"]');
    let inputgbr = document.getElementById('input-gbr');

	fil.onchange = function(){
		//ambil disini & masukin ke formData
		formData.append('file', fil.files);
		//proses AJAX fetch
		fetch('uploadFileTeacher', {
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
        
        let poto = "<?php echo $result->getProfpic()?>";
        // console.log("HELLO " + poto);	
        gambar.src = "/TugasBesar/view/images/profilepicture/".concat(poto);
        // console.log("YESY  "+gambar.src);
            
        // inputgbr.appendChild(gambar);

        location.reload();
	}

    //script untuk validasi input edit text profile
    const user = document.getElementById('uname');
    const name = document.getElementById('urealname');
    const pass = document.getElementById('upass');
    const addr = document.getElementById('uaddress');
    const email = document.getElementById('uemail');
    const phone = document.getElementById('uphone');
    
    let idU = document.getElementById('userError');
    const idName = document.getElementById('nameError');
    const idPw = document.getElementById('pwError');
    const idAddr = document.getElementById('addrError');
    let idEmail = document.getElementById('emailError');
    const idPhone = document.getElementById('phoneError');
    const dupli = document.getElementById('error');

    function checkValidation() {
    	if(checkUName() && checkPw() && checkAddress() && checkCity() && checkEmail() && checkPhone() && checkURealName()){
    		return true;
    	}
    	else{
    		event.preventDefault();
            if(!checkUName()){
                idU.style.width = "150%";
				idU.textContent = "Username harus terdiri lebih dari 8 karakter!";
                setError(user, idU);
            }
			if(!checkURealName()){
                idName.style.width = "150%";
				setError(name, idName);
			}
            if(!checkPw()){
                idPw.style.width = "150%";
                setError(pass, idPw);
            }
            if(!checkEmail()){
                idEmail.style.width = "150%";
				idEmail.textContent = "Email tidak valid!";
				idEmail.style.marginLeft = "0px";
                setError(email, idEmail);
            }
            return false;
    	}
    }
	
	function errorHandler(){
		if(dupli.textContent === 'UsernameEmail'){
			idU.textContent = 'Username sudah terdaftar !';
			idU.style.marginLeft = "4.5%";
			idU.classList.remove('errorMessage');

			idEmail.textContent = 'Email sudah terdaftar !';
			idEmail.classList.remove('errorMessage');
			idEmail.style.marginLeft = "2.4%";

			dupli.textContent = "";

		}else if(dupli.textContent === 'Username'){
			idU.textContent = 'Username sudah terdaftar !';
			idU.classList.remove('errorMessage');
			idU.style.marginLeft = "4.5%";
			dupli.textContent = "";

		}else if(dupli.textContent = 'Email'){
			idEmail.textContent = 'Email sudah terdaftar !';
			idEmail.classList.remove('errorMessage');
			idEmail.style.marginLeft = "2.4%";
			dupli.textContent = "";

		}else{
			return;
		}
	}

    function checkUName() {
        const username = user.value.trim();

        if(username === '' || username.length < 8){
			idU.textContent = 'Username harus terdiri lebih dari 8 karakter';
            idU.style.width = "150%";
            setError(user, idU);
            return false;
        }
        else {
            setSuccess(user, idU);
            return true;
        }
    }

	function checkURealName(){
		const namee = name.value.trim();

        if(namee === '' || namee.length < 3){
            setError(name, idName);
            return false;
        }
        else {
            setSuccess(name, idName);
            return true;
        }
	}

    function checkPw() {
        const password = pass.value;

        if(password.length < 8 || password === ''){
            setError(pass, idPw);
            return false;
        }
        else {
            setSuccess(pass, idPw);
            return true;
        }
    }

    function checkEmail() {
    	const emailUser = email.value;
    	const emailFormat = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$";

    	if(!emailUser.match(emailFormat)){ 
			idEmail.textContent = "Email tidak valid !"
    		setError(email, idEmail);
    		return false;
    	}
    	else {
    		setSuccess(email, idEmail);
    		return true;
    	}
    }
    function setError(input, idInput){
        input.className = 'kotakInput2 error tulisanPutih';
        input.style.width = "100%";
        idInput.className = 'errorMessage show';
    }

    function setSuccess(input, idInput){
        input.className = 'edit-input-box tulisanPutih';
        idInput.className = 'errorMessage';
    }

	errorHandler();

    function deleteAccount(){
        let del = confirm("Are you sure you want to delete this account?");

        if(del){
            alert("Account has been deleted.");
            window.location.href = "delete";
        }
    }
</script>
