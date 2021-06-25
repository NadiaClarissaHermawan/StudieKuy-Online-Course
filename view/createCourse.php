<?php
    // if(session_status() == PHP_SESSION_NONE){
    //     session_start();
    // }

    // //kalo belom login gabisa kesini
    // if(!isset($_SESSION['statusTeacher'])){
    //     header("Location: teacherLogin");
    //     session_destroy();
    //     exit;
    // }
?>
<div class="content1">
    <div class="tulisanPutih hurufBesar">New Course Detail</div>
</div>
<hr>
<div class="content2 tulisanPutih">
    <div class="content2-1">Course Name</div>
    <div class="content2-2">:<input type="text" name="courseName" class="kotakInput tulisanCoklat"></div>
</div>
<div class="content2 tulisanPutih">
    <div class="content2-1">Course Category</div>
    <div class="content2-2">:<!-- <input type="text" name="courseCategory" class="kotakInput tulisanCoklat"></div> -->
    <div class="kotakInput tulisanCoklat">
        <select id="sel" size = "1" name="ucategory" class="input-option kotakInput tulisanCoklat">
            <?php 
                // foreach($result as $key => $row){
                //     echo '<option value="'.$row->getIdKota().'">'.$row->getNamaKota().'</option>';
                // }
            ?>
        </select>
    </div>
</div>
<div class="content2 tulisanPutih">
    <div class="content2-1">Course Description</div>
    <div class="content2-2">:<input type="text" name="courseDesc" class="kotakInput tulisanCoklat"></div>  
</div>
<div class="content2 tulisanPutih">
    <div class="content2-1">Cost</div>
    <div class="content2-2">:<input type="number" name="courseCost" class="kotakInput tulisanCoklat"></div>  
</div>
<div class="content2 tulisanPutih">
    <div class="content2-1">Completeness Criteria</div>
    <div class="content2-2">:<input type="number" name="courseKKM" class="kotakInput tulisanCoklat"></div>  
</div>
<a href="uploadModul"><img src="view/images/createCourse.jpg" class="content-image"></a>

<script>
    //script untuk scroll select-option kota
        document.getElementById('sel').addEventListener('click', onClickHandler);
        document.getElementById('sel').addEventListener('mousedown', onMouseDownHandler);

        function onMouseDownHandler(e){
            var el = e.currentTarget;
            
            if(el.hasAttribute('size') && el.getAttribute('size') == '1'){
                e.preventDefault();    
            }
        }
        function onClickHandler(e) {
            var el = e.currentTarget; 

            if (el.getAttribute('size') == '1') {
                el.className += " selectOpen";
                el.setAttribute('size', '3');
            }
            else {
                el.className = '';
                el.className += " input-option";
                el.setAttribute('size', '1');
            }
        }
        // --------------------------------------------------------------------------------------------
        const form = document.getElementById('main');
        const user = document.getElementById('uname');
        const name = document.getElementById('urealname');
        const pass = document.getElementById('upass');
        const addr = document.getElementById('uaddress');
        const email = document.getElementById('uemail');
        const phone = document.getElementById('uphone');
        
        let idU = document.getElementById('userError');
        const idName = document.getElementById('nameError');
        const idPw = document.getElementById('pwError');
        const idAddr = document.getElementById('addrError');
        let idEmail = document.getElementById('emailError');
        const idPhone = document.getElementById('phoneError');
        const dupli = document.getElementById('error');

        function checkValidation() {
            if(checkUName() && checkPw() && checkAddress() && checkCity() && checkEmail() && checkPhone() && checkURealName()){
                return true;
            }
            else{
                event.preventDefault();
                if(!checkUName()){
                    idU.textContent = "Username harus terdiri lebih dari 8 karakter!";
                    setError(user, idU);
                }
                if(!checkURealName()){
                    setError(name, idName);
                }
                if(!checkPw()){
                    setError(pass, idPw);
                }
                if(!checkAddress()){
                    setError(addr, idAddr);
                }
                if(!checkEmail()){
                    idEmail.textContent = "Email tidak valid!";
                    idEmail.style.marginLeft = "0px";
                    setError(email, idEmail);
                }
                if(!checkPhone()){
                    setError(phone, idPhone);
                }
                return false;
            }
        }
        
        function errorHandler(){
            console.log(dupli.textContent);
            if(dupli.textContent === 'UsernameEmail'){
                idU.textContent = 'Username sudah terdaftar !';
                idU.style.marginLeft = "4.5%";
                idU.classList.remove('errorMessage');

                idEmail.textContent = 'Email sudah terdaftar !';
                idEmail.classList.remove('errorMessage');
                idEmail.style.marginLeft = "2.4%";

                dupli.textContent = "";

            }else if(dupli.textContent === 'Username'){
                idU.textContent = 'Username sudah terdaftar !';
                idU.classList.remove('errorMessage');
                idU.style.marginLeft = "4.5%";
                dupli.textContent = "";

            }else if(dupli.textContent = 'Email'){
                idEmail.textContent = 'Email sudah terdaftar !';
                idEmail.classList.remove('errorMessage');
                idEmail.style.marginLeft = "2.4%";
                dupli.textContent = "";

            }else{
                return;
            }
        }

        function checkUName() {
            const username = user.value.trim();

            if(username === '' || username.length < 8){
                idU.textContent = 'Username harus terdiri lebih dari 8 karakter';
                setError(user, idU);
                return false;
            }
            else {
                setSuccess(user, idU);
                return true;
            }
        }

        function checkURealName(){
            const namee = name.value.trim();

            if(namee === '' || namee.length < 3){
                setError(name, idName);
                return false;
            }
            else {
                setSuccess(name, idName);
                return true;
            }
        }

        function checkPw() {
            const password = pass.value;

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
            
            if(address === ''){
                setError(addr, idAddr);
                return false;
            }
            else {
                setSuccess(addr, idAddr);
                return true;
            }
        }

        function checkEmail() {
            const emailUser = email.value;
            const emailFormat = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$";

            if(!emailUser.match(emailFormat)){ 
                idEmail.textContent = "Email tidak valid !"
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
            if(phoneUser.length >= 10 && phoneUser.length <= 13){ 
                setSuccess(phone, idPhone);
                return true;
            }
            else {
                setError(phone, idPhone);
                return false;
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