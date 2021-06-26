<!DOCTYPE html>
<body>
	<form method="POST" action="userRegister">
		<!-- kalau  ada duplikasi-->
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
		<div id="main" style="margin-top: 180px;">
			<img class="imgLogin" src="view/images/loginpotongan.png">
			<div class="contentLogin" style="margin-bottom: 50px;">
				<div class="rowLogin tulisanCoklat">
					<label for="uname" class="txt hurufSedang">Username</label>
					<span style="width: 7px;" class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username" oninput="checkUName()" />
				</div>
				<div class="rowLogin errorMessage" id="userError"style="height: 20px; color:red"></div>

				<div class="rowLogin tulisanCoklat">
					<label for="urealname" class="txt hurufSedang">Name</label>
					<span style="width: 7px;" class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="urealname" name="urealname" placeholder="Enter your name" oninput="checkURealName()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="nameError" style="margin-left: 100px;">Nama harus lebih dari 3 karakter</span>
	            </div>

				<div class="rowLogin tulisanCoklat">
					<label for="upass" class="txt hurufSedang">Password</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="password" class="kotakInput" id="upass" name="upass" placeholder="Enter password" oninput="checkPw()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="pwError" style="margin-left: 160px;">Password harus terdiri lebih dari 8 karakter</span>
	            </div>

				<div class="rowLogin tulisanCoklat">
					<label for="uaddress" class="txt hurufSedang">Address</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uaddress" name="uaddress" placeholder="Enter home address" oninput="checkAddress()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="addrError" style="margin-left: 2%;">Address harus diisi!</span>
	            </div>

				<div class="rowLogin tulisanCoklat">
					<label for="sel" class="txt hurufSedang" style="margin-left: -19%;">City</label>
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
					<input type="email" class="kotakInput" id="uemail" name="uemail" placeholder="Enter e-mail" oninput="checkEmail()" />
				</div>
				<div class="rowLogin errorMessage" id="emailError"style="height: 20px; color:red; margin-left:0px"></div>

				<div class="rowLogin tulisanCoklat">
					<label for="uphone" class="txt hurufSedang">Phone</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uphone" name="uphone" placeholder="Enter phone number" oninput="checkPhone()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="phoneError" style="margin-left: 1%;">Phone tidak valid!</span>
	            </div>

				<div class="rowLogin tulisanCoklat" style="margin-bottom: 12px;">
					<button type="submit" class="register-button link tulisanCoklat" name="registerButton" onclick="checkValidation()">Register</button>
				</div>
			</div>
		</div>
	</form>
    <script>
		//script untuk scroll select-option kota
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
		// --------------------------------------------------------------------------------------------
        const form = document.getElementById('main');
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
					idU.textContent = "Username harus terdiri lebih dari 8 karakter!";
                    setError(user, idU);
                }
				if(!checkURealName()){
					setError(name, idName);
				}
                if(!checkPw()){
                    setError(pass, idPw);
                }
                if(!checkAddress()){
                    setError(addr, idAddr);
                }
                if(!checkEmail()){
					idEmail.textContent = "Email tidak valid!";
					idEmail.style.marginLeft = "0px";
                    setError(email, idEmail);
                }
                if(!checkPhone()){
                    setError(phone, idPhone);
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
				idU.textContent = 'Username harus terdiri lebih dari 8 karakter';
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
        	const emailFormat = "[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,3}$";

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