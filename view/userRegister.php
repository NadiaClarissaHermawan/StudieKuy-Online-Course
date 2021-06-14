<!DOCTYPE html>
<body>
	<div class="nav">
        <a href="courses" class="menuNav">Courses</a>
        <a href="index#anchor-aboutUs" class="menuNav">About Us</a>
        <a href="faq" class="menuNav">FAQ</a>
    </div>

	<form method="POST" action="userRegister">
		<div id="main">
			<img class="imgLogin" src="view/images/loginpotongan.png">
			<div class="contentLogin">
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

				<div class="rowLogin tulisanCoklat">
					<label for="ucity" class="txt hurufSedang">City</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="ucity" name="ucity" placeholder="Enter city" oninput="checkCity()" />
				</div>
				<div class="rowLogin">
	                <span class="errorMessage" id="cityError">Kota harus diisi!</span>
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

				<div class="rowLogin tulisanCoklat" style="margin-bottom: 30px;">
					<label for="urole" class="txt hurufSedang">Role</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<select class="kotakInput" id="urole"  name="urole">
						<option value="1" class="pilihanRole">Student</option>
						<option value="2" class="pilihanRole">Teacher</option>
					</select>
				</div>

				<div class="rowLogin tulisanCoklat" style="margin-bottom: 30px;">
					<button type="submit" class="register-button link tulisanCoklat" name="registerButton" onclick="checkValidation()">Register</button>
				</div>
			</div>
		</div>
	</form>
    <script>
        const form = document.getElementById('main');
        const user = document.getElementById('uname');
        const pass = document.getElementById('upass');
        const addr = document.getElementById('uaddress');
        const city = document.getElementById('ucity');
        const email = document.getElementById('uemail');
        const phone = document.getElementById('uphone');

        user.addEventListener('keyup', (e) => {
            checkInput();
        });

        function checkValidation() {
        	if(checkUName() && checkPw() && checkAddress() && checkCity() && checkEmail() && checkPhone()){
        		return true;
        	}
        }
        function checkUName() {
            const username = user.value.trim();
            const idU = document.getElementById('userError');

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
            const idPw = document.getElementById('pwError');

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
        	const idAddr = document.getElementById('addrError');

        	if(address === ''){
        		setError(addr, idAddr);
        		return false;
        	}
        	else {
        		setSuccess(addr, idAddr);
        		return true;
        	}
        }

        function checkCity() {
        	const cityName = city.value;
        	const idCity = document.getElementById('cityError');

        	// cek city valid/ ga
        	if(cityName === ''){ 
        		setError(city, idCity);
        		return false;
        	}
        	else {
        		setSuccess(city, idCity);
        		return true;
        	}
        }

        function checkEmail() {
        	const emailUser = email.value;
        	const idEmail = document.getElementById('emailError');

        	const emailFormat = [a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$;

        	if(emailUser.match(emailFormat)){ 
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
        	const idPhone = document.getElementById('phoneError');

        	if(phoneUser.length >= 10 && phoneUser.length <= 13){ 
        		setError(phone, idPhone);
        		return false;
        	}
        	else {
        		setSuccess(phone, idPhone);
        		return true;
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