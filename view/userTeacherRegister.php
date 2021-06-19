<!DOCTYPE html>
<body>
	<!-- <div class="nav">
        <a href="courses" class="menuNav">Courses</a>
        <a href="index#anchor-aboutUs" class="menuNav">About Us</a>
        <a href="faq" class="menuNav">FAQ</a>
    </div> -->

	<form method="POST" action="userTeacherRegister">
		<?php
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}

			if(isset($_SESSION['duplicate']) && $_SESSION['duplicate'] === "0"){
				session_destroy();
				echo ' <div id="error" hidden >UsernameEmail</div>';
			}else if(isset($_SESSION['duplicate']) && $_SESSION['duplicate'] === "00"){
				session_destroy();
				echo ' <div id="error" hidden >Username</div>';
			}else if(isset($_SESSION['duplicate']) && $_SESSION['duplicate'] === "000"){
				session_destroy();
				echo ' <div id="error" hidden >Email</div>';
			}
		?>
		<div id="main" style="margin-top: 170px;">
			<img class="imgLogin"  src="view/images/loginTeacher.jpg">
			<div class="contentLogin">
				<div class="rowLogin tulisanCoklat">
					<h1><label for="uJudul" class="txt hurufSedang">Teacher's Register</label></hi>
				</div>
				<div class="rowLogin tulisanCoklat">
					<label for="uname" class="txt hurufSedang">Username</label>
					<span style="width: 7px;" class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username" oninput="checkUName()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="userError">Username harus terdiri lebih dari 8 karakter</span>
	            </div>

				<div class="rowLogin tulisanCoklat">
					<label for="upass" class="txt hurufSedang">Password</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="password" class="kotakInput" id="upass" name="upass" placeholder="Enter password" oninput="checkPw()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="pwError">Password harus terdiri lebih dari 8 karakter</span>
	            </div>

				<div class="rowLogin tulisanCoklat">
					<label for="uaddress" class="txt hurufSedang">Address</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uaddress" name="uaddress" placeholder="Enter home address" oninput="checkAddress()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="addrError">Address harus diisi!</span>
	            </div>

				<div class="rowLogin tulisanCoklat" style="width: 61%;">
					<label for="sel" class="txt hurufSedang">City</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<div class="">
						<select id="sel" size = "1" name="ucity" class="input-option">
							<?php 
								foreach($result as $key => $row){
									echo '<option value="'.$row->getIdKota().'">'.$row->getNamaKota().'</option>';
								}
							?>
						</select>
					</div>
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="cityError" style="margin-left: 0%;">Kota harus diisi!</span>
	            </div>

				<div class="rowLogin tulisanCoklat">
					<label for="uemail" class="txt hurufSedang">E-mail</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uemail" name="uemail" placeholder="Enter e-mail" oninput="checkEmail()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="emailError">Email tidak valid!</span>
	            </div>

				<div class="rowLogin tulisanCoklat">
					<label for="uphone" class="txt hurufSedang">Phone</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uphone" name="uphone" placeholder="Enter phone number" oninput="checkPhone()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="phoneError">Phone tidak valid!</span>
	            </div>

				<div class="rowLogin tulisanCoklat">
					<label for="udiploma" class="txt hurufSedang">Diploma</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="udiploma" name="udiploma" placeholder="Enter your diploma" oninput="checkDiploma()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="diplomaError">Gelar tidak valid!</span>
	            </div>

				<div class="rowLogin tulisanCoklat">
					<label for="upload" class="txt hurufSedang">Upload Image</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="file" name="upload" id="upload" class="kotakInput" oninput="checkUpload()" >
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="uploadError">Gambar belum tercantum</span>
	            </div>
				<div class="rowLogin tulisanCoklat" style="margin-bottom: 30px;">
					<button type="submit" class="register-button link tulisanCoklat" name="registerButton" onclick="checkValidation()">Register</button>
				</div>
			</div>
		</div>
	</form>
    <script>
		document.getElementById('sel').addEventListener('click', onClickHandler);
		document.getElementById('sel').addEventListener('mousedown', onMouseDownHandler);

		function onMouseDownHandler(e){
			var el = e.currentTarget;
			
			if(el.hasAttribute('size') && el.getAttribute('size') == '1'){
				e.preventDefault();    
			}
		}
		function onClickHandler(e) {
			var el = e.currentTarget; 

			if (el.getAttribute('size') == '1') {
				el.className += " selectOpen";
				el.setAttribute('size', '3');
			}
			else {
				el.className = '';
				el.className += " input-option";
				el.setAttribute('size', '1');
			}
		}

        const form = document.getElementById('main');
        const user = document.getElementById('uname');
        const pass = document.getElementById('upass');
        const addr = document.getElementById('uaddress');
        const city = document.getElementById('ucity');
        const email = document.getElementById('uemail');
        const phone = document.getElementById('uphone');
		const diploma = document.getElementById('udiploma');
		const upload = document.getElementById('upload');
        
        const idU = document.getElementById('userError');
        const idPw = document.getElementById('pwError');
        const idAddr = document.getElementById('addrError');
        const idCity = document.getElementById('cityError');
        const idEmail = document.getElementById('emailError');
        const idPhone = document.getElementById('phoneError');
		const idDiploma = document.getElementById('diplomaError');
		const idUpload = document.getElementById('uploadError');

        function checkValidation() {
        	if(checkUName() && checkPw() && checkAddress() && checkEmail() && checkPhone() && checkDiploma() && checkUpload()){
        		return true;
        	}
        	else{
        		event.preventDefault();
                if(!checkUName()){
                    setError(user, idU);
                }
                if(!checkPw()){
                    setError(pass, idPw);
                }
                if(!checkAddress()){
                    setError(addr, idAddr);
                }
                if(!checkCity()){
                    setError(city, idCity);
                }
                if(!checkEmail()){
                    setError(email, idEmail);
                }
                if(!checkPhone()){
                    setError(phone, idPhone);
                }
				if(!checkDiploma()){
                    setError(diploma,idDIploma);
                }
				if(!checkUpload()){
                    setError(upload,idUpload);
                }
                return false;
        	}
        }

		function errorHandler(){
			console.log(dupli.textContent);
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
                setError(user, idU);
                return false;
            }
            else {
                setSuccess(user, idU);
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

        function checkAddress() {
        	const address = addr.value;
        	
        	if(address === ''){
        		setError(addr, idAddr);
        		return false;
        	}
        	else {
        		setSuccess(addr, idAddr);
        		return true;
        	}
        }


        function checkEmail() {
        	const emailUser = email.value;
        	const emailFormat = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$";

        	if(!emailUser.match(emailFormat)){ 
        		setError(email, idEmail);
        		return false;
        	}
        	else {
        		setSuccess(email, idEmail);
        		return true;
        	}
        }

        function checkPhone() {
        	const phoneUser = phone.value;
         	if(phoneUser.length >= 10 && phoneUser.length <= 13){ 
         		setSuccess(phone, idPhone);
        		return true;
        	}
        	else {
        		setError(phone, idPhone);
        		return false;
        	}
        }

		function checkDiploma() {
        	const dipval = diploma.value;
        	
        	if(dipval == ''){
        		setError(diploma,idDIploma);
        		return false;
        	}
        	else {
        		setSuccess(diploma,idDIploma);
        		return true;
        	}
        }
		
		function checkUpload(){
			if($_FILES['upfile']['name'] != ""){
				setSuccess(upload,idUpload);
        		return true;
			}
			else{
				setError(upload,idUpload);
        		return false;
			}
		}

        function setError(input, idInput){
            input.className = 'kotakInput error';
            idInput.className = 'errorMessage show';
        }

        function setSuccess(input, idInput){
            input.className = 'kotakInput';
            idInput.className = 'errorMessage';
        }

		errorHandler();
    </script>
</body>