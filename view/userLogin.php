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
                <input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username"/>
            </div>
            <div class="rowLogin tulisanCoklat" style="margin-bottom: 30px;">
				<label for="upass" class="txt hurufSedang">Password</label>
				<span style="width: 5px;"  class="hurufSedang">:</span>
                <input type="password" class="kotakInput" id="upass" name="upass" placeholder="Enter password"/>
            </div>
            <div class="rowLogin tulisanCoklat" style="margin-bottom: 10px;">
				<button type="submit" class="login-button link tulisanCoklat">Log in</button>
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
            checkInput();
        });

        function checkInput() {
            const username = user.value.trim();
            const password = pass.value.trim();

            if(username === ''){
                setError(user);
            }
            else {
                setSuccess(user);
            }

            if(password.length < 8 || password === ''){
                setError(pass);
            }
            else {
                setSuccess(pass);
            }
        }

        function setError(input){
            input.className = 'kotakInput error';
        }

        function setSuccess(input){
            input.className = 'kotakInput';
        }
    </script>
</body>