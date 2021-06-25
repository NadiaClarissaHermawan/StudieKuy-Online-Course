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
        <div class="content2-2">:<input type="text" name="courseName" class="kotakInput tulisanCoklat" id="courseName" placeholder="Enter course name" onchange="checkName()"></div>
    </div>
    <div class="content2">
        <span class="errorMessage" id="nameError" style="margin-left: 100px;">Nama Course harus diisi!</span>
    </div>

    <div class="content2 tulisanPutih">
        <label for="courseCat" class="content2-1">Course Category</label>
        <div class="content2-2">:<input type="text" name="courseCat" class="kotakInput tulisanCoklat" id="courseCat" placeholder="Enter course category" onchange="checkCat()"></div>
        <!-- <div class="kotakInput tulisanCoklat">
            <select id="sel" size = "1" name="ucategory" class="input-option kotakInput tulisanCoklat">
                <?php 
                    // foreach($result as $key => $row){
                    //     echo '<option value="'.$row->getIdKota().'">'.$row->getNamaKota().'</option>';
                    // }
                ?>
            </select>
        </div> -->
    </div>
    <div class="content2">
        <span class="errorMessage" id="catError" style="margin-left: 100px;">Category Course harus diisi!</span>
    </div>

    <div class="content2 tulisanPutih">
        <label for="courseDesc" class="content2-1">Course Description</label>
        <div class="content2-2">:<input type="text" name="courseDesc" class="kotakInput tulisanCoklat" id="courseDesc" placeholder="Enter course description" onchange="checkDesc()"></div>  
    </div>
    <div class="content2">
        <span class="errorMessage" id="descError" style="margin-left: 100px;">Description Course harus diisi!</span>
    </div>

    <div class="content2 tulisanPutih">
        <label for="courseCost" class="content2-1">Course Cost</label>
        <div class="content2-2">:<input type="number" name="courseCost" class="kotakInput tulisanCoklat" id="courseCost" placeholder="Enter course cost" onchange="checkCost()"></div>  
    </div>
    <div class="content2">
        <span class="errorMessage" id="costError" style="margin-left: 100px;">Tarif Course harus diisi!</span>
    </div>

    <div class="content2 tulisanPutih">
        <label for="courseKKM" class="content2-1">Completeness Criteria</label>
        <div class="content2-2">:<input type="number" name="courseKKM" class="kotakInput tulisanCoklat" id="courseKKM" placeholder="Enter completeness criteria" onchange="checkKKM()"></div>  
    </div>
    <div class="content2">
        <span class="errorMessage" id="kkmError" style="margin-left: 100px;">Nilai minimum Course harus diisi!</span>
    </div>

    <div class="content2 tulisanPutih">
        <label for="courseImg" class="content2-1">Course Image</label>
        <div class="content2-2">:<input type="file" name="courseImg" class="kotakInput tulisanCoklat" id="courseImg"></div>
    </div>

    <a href="uploadModul"><img src="view/images/createCourse.jpg" class="content-image" id="create" onclick="checkValidation()"></a>
</form>
    
<script>
    document.getElementById("create").addEventListener("click", checkValidation());
    const form = document.getElementById('main');
    const name = document.getElementById('courseName');
    const category = document.getElementById('courseCat');
    const desc = document.getElementById('courseDesc');
    const cost = document.getElementById('courseCost');
    const kkm = document.getElementById('courseKKM');
    const img = document.getElementById('courseImg');
    
    let idName = document.getElementById('nameError');
    let idCat = document.getElementById('catError');
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

        if(courseName === '' || courseName.length < 10){
            setError(name, idName);
            return false;
        }
        else {
            setSuccess(name, idName);
            alert('success');
            return true;
        }
    }

    function checkCat(){
        const cat = category.value;

        if(cat === ''){
            setError(category, idCat);
            return false;
        }
        else {
            setSuccess(category, idCat);
            return true;
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
    errorHandler();
</script>