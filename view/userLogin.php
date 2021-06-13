<!DOCTYPE html>
<body>
	<div class="nav">
        <a href="courses" class="menuNav">Courses</a>
        <a href="#aboutUs" class="menuNav">About Us</a>
        <a href="faq" class="menuNav">FAQ</a>
    </div>

    <div id="main">
        <img class="imgLogin" src="view/images/loginpotongan.png">
        <div class="contentLogin">
            <div class="rowLogin tulisanCoklat">
				<label for="uname" class="txt hurufSedang">Username</label>
				<span style="width: 20px;">:</span>
                <input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter Username"/>
            </div>
            <div class="rowLogin tulisanCoklat">
				<label for="upass" class="txt hurufSedang">Password</label>
				<span style="width: 20px;">:</span>
                <input type="password" class="kotakInput" id="upass" name="upass" placeholder="Enter Password"/>
            </div>
            <div class="rowLogin tulisanCoklat">
				<a href="index"><button type="submit" class="button link">LOG IN</button></a>
            </div>
            <div class="rowLogin tulisanCoklat">
                <span>doesn't have an account? </span>
                <a class="link" href="userRegister">Register now!</a>
            </div>
        </div>
    </div>
</body>