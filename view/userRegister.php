<!DOCTYPE html>
<body>
	<div class="nav">
        <a href="courses" class="menuNav">Courses</a>
        <a href="#aboutUs" class="menuNav">About Us</a>
        <a href="faq" class="menuNav">FAQ</a>
    </div>

	<form method="POST" action="userLogin">
		<div id="main">
			<img class="imgLogin" src="view/images/loginpotongan.png">
			<div class="contentLogin">
				<div class="rowLogin tulisanCoklat">
					<label for="uname" class="txt hurufSedang">Username</label>
					<span style="width: 7px;" class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uname" name="uname" placeholder="Enter username"/>
				</div>
				<div class="rowLogin tulisanCoklat">
					<label for="upass" class="txt hurufSedang">Password</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="password" class="kotakInput" id="upass" name="upass" placeholder="Enter password"/>
				</div>
				<div class="rowLogin tulisanCoklat">
					<label for="uaddress" class="txt hurufSedang">Address</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uaddress" name="uaddress" placeholder="Enter home address"/>
				</div>
				<div class="rowLogin tulisanCoklat">
					<label for="ucity" class="txt hurufSedang">City</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="ucity" name="ucity" placeholder="Enter city"/>
				</div>
				<div class="rowLogin tulisanCoklat">
					<label for="uemail" class="txt hurufSedang">E-mail</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uemail" name="uemail" placeholder="Enter home e-mail"/>
				</div>
				<div class="rowLogin tulisanCoklat" style="margin-bottom: 30px;">
					<label for="uphone" class="txt hurufSedang">Phone</label>
					<span style="width: 7px;"  class="hurufSedang">:</span>
					<input type="text" class="kotakInput" id="uphone" name="uphone" placeholder="Enter phone number"/>
				</div>
				<div class="rowLogin tulisanCoklat" style="margin-bottom: 30px;">
					<a href="index" style="text-decoration: none;"><button type="submit" class="button link tulisanCoklat" name="registerButton">Register</button></a>
				</div>
			</div>
		</div>
	</form>
    
</body>