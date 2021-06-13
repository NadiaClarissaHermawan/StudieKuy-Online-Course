<!DOCTYPE html>
<body>
	<div class="nav">
        <a href="courses" class="menuNav">Courses</a>
        <a href="index#anchor-aboutUs" class="menuNav">About Us</a>
        <a href="faq" class="menuNav">FAQ</a>
    </div>

    <form id="main" method="POST" action="userLogin">
        <img class="imgLogin" src="view/images/loginpotongan.png">
        <div class="contentLogin">
            <div class="rowLogin tulisanCoklat">
				<label for="uname" class="txt hurufSedang">Username</label>
				<span style="width: 5px;" class="hurufSedang">:</span>
                <input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username" oninput="checkUName()" />
            </div>
            <div class="rowLogin" style="margin-bottom: 20px;">
                <span class="errorMessage" id="userError">Username harus terdiri lebih dari 8 karakter</span>
            </div>
            <div class="rowLogin tulisanCoklat">
				<label for="upass" class="txt hurufSedang">Password</label>
				<span style="width: 5px;"  class="hurufSedang">:</span>
                <input type="password" class="kotakInput" id="upass" name="upass" placeholder="Enter password" oninput="checkPw()" />
            </div>
            <div class="rowLogin" style="margin-bottom: 15px;">
                <span class="errorMessage" id="pwError">Password harus terdiri lebih dari 8 karakter</span>
            </div>
            <div class="rowLogin tulisanCoklat" style="margin-bottom: 15px;">
				<button type="submit" class="login-button link tulisanCoklat" onclick="checkValidation()">Log in</button>
            </div>
            <div class="rowLogin tulisanCoklat">
                <span class="hurufKecil">doesn't have an account? </span>
                <a class="link hurufKecil" href="userRegister"> Register now!</a>
            </div>
        </div>
    </form>
    <script>
        const form = document.getElementById('main');
        const user = document.getElementById('uname');
        const pass = document.getElementById('upass');

        user.addEventListener('keyup', (e) => {
            e.preventDefault();
            checkValidation();
        });

        function checkValidation() {
            if(checkUName() && checkPw()){
                return true;
            }
            else {
                // alert('Form belum lengkap!');
                return false;
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
            const password = pass.value.trim();
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