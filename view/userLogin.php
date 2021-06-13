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
				<span style="width: 5px;" class="hurufSedang">:</span>
                <input type="text" class="kotakInput hurufSedang" id="uname" name="uname" placeholder="Enter username"/>
            </div>
            <div class="rowLogin tulisanCoklat" style="margin-bottom: 30px;">
				<label for="upass" class="txt hurufSedang">Password</label>
				<span style="width: 5px;"  class="hurufSedang">:</span>
                <input type="password" class="kotakInput hurufSedang" id="upass" name="upass" placeholder="Enter password"/>
            </div>
            <div class="rowLogin tulisanCoklat" style="margin-bottom: 10px;">
				<a href="index" style="text-decoration: none;"><button type="submit" class="button link tulisanCoklat">Log in</button></a>
            </div>
            <div class="rowLogin tulisanCoklat">
                <span class="hurufKecil">doesn't have an account? </span>
                <a class="link hurufKecil" href="userRegister"> Register now!</a>
            </div>
        </div>
    </div>
</body>