<!DOCTYPE html>
<body>
    <form id="main" method="POST" action="teacherLogin">
        <img class="imgLogin" src="view/images/loginTeacher.jpg">
        <div class="contentLogin">
            <div class="rowLogin tulisanCoklat">
				<label for="uname" class="txt hurufSedang">Username</label>
				<span style="width: 5px;" class="hurufSedang">:</span>
                <?php
                    if(isset($_SESSION['unameNotFound']) == false){       
                ?>
                    <input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username" oninput="checkUName()" />'
                <?php
                    }else if(isset($_SESSION['unameNotFound']) && $_SESSION['unameNotFound']  == 0){
                        session_destroy();
                ?>  
                    <input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username" oninput="checkUName()" />'
                    <div>Username tidak terdaftar</div>
                <?php
                    }else{
                        $tempUname = $_SESSION['unameNotFound'];
                        echo '<input type="text" class="kotakInput" id="uname" name="uname" value="'.
                        $tempUname.'" placeholder="Enter username" oninput="checkUName()" />';
                ?>
                    <div>Password salah</div>
                <?php
                    }
                ?>
            </div>

            <div class="rowLogin" style="height: 20px;">
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
            <div id="wrongPassword"></div>

            <div class="rowLogin tulisanCoklat" style="margin-bottom: 20px;">
				<button type="submit" class="login-button link tulisanCoklat" value="login"  onclick="checkValidation()">Log in</button>
            </div>
            <div class="rowLogin tulisanCoklat" style="margin-bottom: 20px;">
                <span class="hurufKecil">doesn't have an account? </span>
                <a class="link hurufKecil" href="userTeacherRegister"> Register now!</a>
            </div>
        </div>
    </form>
</body>

<script>
        const form = document.getElementById('main');
        const user = document.getElementById('uname');
        const pass = document.getElementById('upass');
        const err = document.getElementById('error');
        let isiError = document.getElementById('userError');
        let isiErrorPass = document.getElementById('pwError');

        function checkValidation() {
            if(checkUName() && checkPw()){
               return true;
                
            }else{
                event.preventDefault();
                if(!checkUName()){
                    isiError.innerHTML = "Username harus terdiri lebih dari 8 karakter";
                    setError(user, isiError);
                }
                if(!checkPw()){
                    isiErrorPass.innerHTML = "Password harus terdiri lebih dari 8 karakter";
                    setError(pass, isiErrorPass);
                }
                return false;
            }
        }

        function errorHandler(){
            if(err.textContent === 'Username not found'){
                isiError.textContent = 'Username not found !'; 
                isiError.classList.remove('errorMessage');
                err.textContent = "";
            }else if(err.textContent === 'Wrong password'){
                isiErrorPass.textContent = 'Wrong password !';
                isiErrorPass.classList.remove('errorMessage');
                err.textContent = "";
            }else{
                return;
            }
        }

        function checkUName() {
            const username = user.value.trim();

            if(username === '' || username.length < 8){
                setError(user,isiError);
                isiError.textContent = "Username harus terdiri lebih dari 8 karakter";
                return false;
            }
            else {
                setSuccess(user, isiError);
                return true;
            }
        }

        function checkPw() {
            const password = pass.value.trim();

            if(password.length < 8 || password === ''){
                isiErrorPass.textContent = "Password harus terdiri lebih dari 8 karakter";
                setError(pass, isiErrorPass);
                return false;
            }
            else {
                setSuccess(pass, isiErrorPass);
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

        errorHandler();
</script>