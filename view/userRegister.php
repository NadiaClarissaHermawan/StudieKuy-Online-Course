<div class="nav">
    <a href="index"><div class="menuNav">Home /</div></a>
    <div  class="menuNav">Register</div>
</div>
<div class="form">
	<img src="view/images/loginpotongan.png" class = "imageLogin">
	<form method="" action="">
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="userID"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="Password" name="userPass"></td>
			</tr>
            <tr>
				<td>Email</td>
				<td><input type="text" name="userEmail"></td>
			</tr>
            <tr>
				<td>Phone</td>
				<td><input type="text" name="userPhone"></td>
			</tr>
            <tr>
				<td>Role</td>
				<td>
                    <select name="roleSelector">
                        <option value="1">--Select Role--</option>
                        <option value="2">Student</option>
                        <option value="3">Teacher</option>
                    </select>
                </td>
			</tr>
		</table>
		<input type="submit" value="Register" class="button">
	</form>