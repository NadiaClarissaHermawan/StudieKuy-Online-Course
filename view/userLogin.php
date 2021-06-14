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
            <div class="rowLogin">
                <span class="errorMessage" id="userError">Username harus terdiri lebih dari 8 karakter</span>
            </div>

            <div class="rowLogin tulisanCoklat">
				<label for="upass" class="txt hurufSedang">Password</label>
				<span style="width: 5px;"  class="hurufSedang">:</span>
                <input type="password" class="kotakInput" id="upass" name="upass" placeholder="Enter password" oninput="checkPw()" />
            </div>
            <div class="rowLogin">
                <span class="errorMessage" id="pwError">Password harus terdiri lebih dari 8 karakter</span>
            </div>

            <div class="rowLogin tulisanCoklat" style="margin-bottom: 15px;">
				<button type="submit" class="login-button link tulisanCoklat" onclick="checkValidation()">Log in</button>
            </div>
            <div class="rowLogin tulisanCoklat" style="margin-bottom: 20px;">
                <span class="hurufKecil">doesn't have an account? </span>
                <a class="link hurufKecil" href="userRegister"> Register now!</a>
            </div>
        </div>
    </form>
    <script>
        const form = document.getElementById('main');
        const user = document.getElementById('uname');
        const pass = document.getElementById('upass');
        const idU = document.getElementById('userError');
        const idPw = document.getElementById('pwError');

        function checkValidation() {
            if(checkUName() && checkPw()){
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

        function checkPw() {
            const password = pass.value.trim();

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