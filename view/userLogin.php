<!DOCTYPE html>
<body>
    <!-- action dihapus untuk ajax  -->
    <form id="main" method="POST" action="userLogin">
        <img class="imgLogin" src="view/images/loginpotongan.png">
        <div class="contentLogin">
            <div class="rowLogin tulisanCoklat">
				<label for="uname" class="txt hurufSedang">Username</label>
				<span style="width: 5px;" class="hurufSedang">:</span>
                <?php
                    if(isset($_SESSION['unameNotFound']) == false){       
                ?>
                    <input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username" oninput="checkUName()"/>  
                        
                <?php
                    }else if(isset($_SESSION['unameNotFound']) && $_SESSION['unameNotFound']  == 0){
                        session_destroy();
                ?>  
                    <input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username" oninput="checkUName()" />
                    <div id="error" hidden >Username not found</div>
                <?php
                    }else{
                        $tempUname = $_SESSION['unameNotFound'];
                        echo '<input type="text" class="kotakInput" id="uname" name="uname" value="'.
                        $tempUname.'" placeholder="Enter username" onload="wrongPassword()" oninput="checkUName()" />';

                        echo '<div id="error" hidden>Wrong password</div>';
                    }
                ?>
            </div>
            <div class="rowLogin errorMessage" id="userError"style="height: 20px; color:red; margin-left:21px"></div>

            <div class="rowLogin tulisanCoklat">
				<label for="upass" class="txt hurufSedang">Password</label>
				<span style="width: 5px;"  class="hurufSedang">:</span>
                <input type="password" class="kotakInput" id="upass" name="upass" placeholder="Enter password" oninput="checkPw()" />
            </div>
            <div class="rowLogin errorMessage" id="pwError" style="color:red; margin-left:5px"></div>

            <div class="rowLogin tulisanCoklat" style="margin-bottom: 20px;">
				<button type="submit" class="login-button link tulisanCoklat" value="login"  onclick="checkValidation()">Log in</button>
            </div>
            <div class="rowLogin tulisanCoklat" style="margin-bottom: 20px;">
                <span class="hurufKecil">doesn't have an account? </span>
                <a class="link hurufKecil" href="userRegister" id="register-link"> Register now!</a>
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
                    idU.innerHTML = "Username harus terdiri lebih dari 8 karakter";
                    setError(user, idU);
                }
                if(!checkPw()){
                    idPw.innerHTML = "Password harus terdiri lebih dari 8 karakter";
                    setError(pass, idPw);
                }
                return false;
            }
        }

        function wrongPassword(){
            setError(user,idPw);
            idPw.innerHTML = "Password salah";
            return false;
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
                setError(user,idU);
                idU.innerHTML = "Username harus terdiri lebih dari 8 karakter";
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
                idPw.innerHTML = "Password harus terdiri lebih dari 8 karakter";
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

        errorHandler();
</script>