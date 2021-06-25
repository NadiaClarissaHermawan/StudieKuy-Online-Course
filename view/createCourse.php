<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //kalo belom login gabisa kesini
    if(!isset($_SESSION['statusTeacher'])){
        header("Location: teacherLogin");
        session_destroy();
        exit;
    }
?>
<div class="content1">
    <div class="tulisanPutih hurufBesar">New Course Detail</div>
</div>
<hr>
<form method="POST" action="" id="main">
    <div class="content2 tulisanPutih">
        <label for="courseName" class="content2-1">Course Name</label>
        <div class="content2-2">:<input type="text" name="courseName" class="kotakInput tulisanCoklat" id="courseName" placeholder="Enter course name" oninput="checkName()"></div>
    </div>
    <div class="content2">
        <span class="errorMessage" id="nameError">Nama Course harus diisi!</span>

    </div>

    <div class="content2 tulisanPutih">
        <label for="courseCat" class="content2-1">Course Category</label>
        <div class="content2-2">:
            <div class="kotakOpt">
                <input type="radio" name="opt" value="1" class="tulisanCoklat" id="courseCat">Computer
                <input type="radio" name="opt" value="2" class="tulisanCoklat" id="courseCat">Art
                <input type="radio" name="opt" value="3" class="tulisanCoklat" id="courseCat">Law
                <input type="radio" name="opt" value="4" class="tulisanCoklat" id="courseCat">Science
                <input type="radio" name="opt" value="5" class="tulisanCoklat" id="courseCat">Language
                <input type="radio" name="opt" value="6" class="tulisanCoklat" id="courseCat">Economy
            </div>
        </div>
    </div>
    <div class="content2">
        <span class="errorMessage" id="catError">Category Course harus dipilih!</span>
    </div>

    <div class="content2 tulisanPutih">
        <label for="courseDesc" class="content2-1">Course Description</label>
        <div class="content2-2">:<input type="text" name="courseDesc" class="kotakInput tulisanCoklat" id="courseDesc" placeholder="Enter course description" oninput="checkDesc()"></div>  
    </div>
    <div class="content2">
        <span class="errorMessage" id="descError">Description Course harus diisi!</span>
    </div>

    <div class="content2 tulisanPutih">
        <label for="courseCost" class="content2-1">Course Cost</label>
        <div class="content2-2">:<input type="number" name="courseCost" class="kotakInput tulisanCoklat" id="courseCost" placeholder="Enter course cost" oninput="checkCost()"></div>  
    </div>
    <div class="content2">
        <span class="errorMessage" id="costError">Tarif Course harus diisi!</span>
    </div>

    <div class="content2 tulisanPutih">
        <label for="courseKKM" class="content2-1">Completeness Criteria</label>
        <div class="content2-2">:<input type="number" name="courseKKM" class="kotakInput tulisanCoklat" id="courseKKM" placeholder="Enter completeness criteria" oninput="checkKKM()"></div>  
    </div>
    <div class="content2">
        <span class="errorMessage" id="kkmError">Nilai minimum Course harus diisi!</span>
    </div>

    <div class="content2 tulisanPutih">
        <label for="courseImg" class="content2-1">Course Image</label>
        <div class="content2-2">:<input type="file" name="courseImg" class="kotakInput tulisanCoklat" id="courseImg"></div>
    </div>

    <a href="uploadModul"><img src="view/images/createCourse.jpg" class="content-image" id="create" onclick="checkValidation()"></a>
</form>
    
<script>
    const form = document.getElementById('main');
    const name = document.getElementById('courseName');
    const category = document.getElementById('courseCat');
    const desc = document.getElementById('courseDesc');
    const cost = document.getElementById('courseCost');
    const kkm = document.getElementById('courseKKM');
    const img = document.getElementById('courseImg');
    
    let idName = document.getElementById('nameError');
    // let idCat = document.getElementById('catError');
    let idDesc = document.getElementById('descError');
    let idCost = document.getElementById('costError');
    let idKKM = document.getElementById('kkmError');

    function checkValidation() {
        if(checkName() && checkCat() && checkDesc() && checkCost() && checkKKM() && checkImg()){
            return true;
        }
        else{
            event.preventDefault();
            if(!checkName()){
                setError(name, idName);
            }
            if(!checkCat()){
                setError(category, idCat);
            }
            if(!checkDesc()){
                setError(desc, idDesc);
            }
            if(!checkCost()){
                setError(cost, idCost);
            }
            if(!checkKKM()){
                setError(kkm, idKKM);
            }
            return false;
        }
    }

    function checkName() {
        const courseName = name.value;

        if(courseName === ''){
            setError(name, idName);
            return false;
        }
        else {
            setSuccess(name, idName);
            return true;
        }
    }

    function checkCat() {
        let selectedValue = document.querySelector('input[name=opt]:checked');
        
        if(selectedValue != null){
            setSuccess(category, idCat);
        }
        else {
            setError(category, idCat);
        }
    }

    function checkDesc() {
        const description = desc.value;

        if(description === ''){
            setError(desc, idDesc);
            return false;
        }
        else {
            setSuccess(desc, idDesc);
            return true;
        }
    }

    function checkCost() {
        const tarif = cost.value;

        if(tarif == ''){ 
            setError(cost, idCost);
            return false;
        }
        else {
            setSuccess(cost, idCost);
            return true;
        }
    }

    function checkKKM() {
        const btsNilai = kkm.value;
        
        if(btsNilai == ''){
            setError(kkm, idKKM);
            return false;
        }
        else {
            setSuccess(kkm, idKKM);
            return true;
        }
    }

    function checkImg() {
        const images = img.value;
        if(images === ""){ 
            img.src = "empty.jpg";
        }
        return true;
    }

    function setError(input, idInput){
        input.className = 'kotakInput error';
        idInput.className = 'errorMessage show';
    }

    function setSuccess(input, idInput){
        input.className = 'kotakInput';
        idInput.className = 'errorMessage';
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
    errorHandler();
</script>