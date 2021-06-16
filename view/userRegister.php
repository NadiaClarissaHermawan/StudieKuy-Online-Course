<!DOCTYPE html>
<body>
	<form method="POST" action="userRegister">
		<div id="main" style="margin-top: 180px;">
			<img class="imgLogin" src="view/images/loginpotongan.png">
			<div class="contentLogin" style="margin-bottom: 50px;">
				<div class="rowLogin tulisanCoklat">
					<label for="uname" class="txt hurufSedang">Username</label>
					<span style="width: 7px;" class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username" oninput="checkUName()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="userError">Username harus terdiri lebih dari 8 karakter</span>
	            </div>

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
	                <span class="errorMessage" id="emailError" style="margin-left: 1%;">Email tidak valid!</span>
	            </div>

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
        
        const idU = document.getElementById('userError');
		const idName = document.getElementById('nameError');
        const idPw = document.getElementById('pwError');
        const idAddr = document.getElementById('addrError');
        const idEmail = document.getElementById('emailError');
        const idPhone = document.getElementById('phoneError');

        function checkValidation() {
        	if(checkUName() && checkPw() && checkAddress() && checkCity() && checkEmail() && checkPhone() && checkURealName()){
        		return true;
        	}
        	else{
        		event.preventDefault();
                if(!checkUName()){
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
                    setError(email, idEmail);
                }
                if(!checkPhone()){
                    setError(phone, idPhone);
                }
                return false;
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

        function setError(input, idInput){
            input.className = 'kotakInput error';
            idInput.className = 'errorMessage show';
        }

        function setSuccess(input, idInput){
            input.className = 'kotakInput';
            idInput.className = 'errorMessage';
        }
    </script>
</body>