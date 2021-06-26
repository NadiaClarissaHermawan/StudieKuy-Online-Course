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
    <div class="tulisanPutih hurufBesar">Create Course Exam</div>
</div>
<hr>

<div>
    <form class="insert-form" name="form" id="container" method="POST" action="bikinCourse" enctype="multipart/form-data">
        <?php $nomor = 1?>
        <input type="hidden" name="id_courses" value="<?php echo $_GET['id_courses']?>"/>
            <div class="content2 tulisanPutih">
                <div class="content2-1">Question <?php echo $nomor?></div>
                <div class="content2-2">:</div>
                <div class="content2-3"><input autofocus autocomplete="off" type="text" name="q<?php echo $nomor?>" class="question"></div>
            </div>
            <div class="content3 tulisanPutih">
                <div class="content3-1" style="visibility: hidden;"></div>
                <div class="content3-2" style="visibility: hidden;"></div>
                <div class="content3-3">
                    <label class="choice">
                        <input type="radio" name="q<?php echo $nomor?>kunjaw" value="1">
                        <input type="text" name="q<?php echo $nomor?>opt1" class="space-input">
                    </label>
                    <label class="choice">
                        <input type="radio" name="q<?php echo $nomor?>kunjaw" value="2">
                        <input type="text"  name="q<?php echo $nomor?>opt2" class="space-input">
                    </label>
                    <label class="choice">
                        <input type="radio" name="q<?php echo $nomor?>kunjaw" value="3">
                        <input type="text"  name="q<?php echo $nomor?>opt3" class="space-input">
                    </label>
                </div>
            </div>
        <div hidden id="batasan"></div>

    </form>
</div>

<button class="button" id="button" onclick="addQuestion()" >Add New Question</button>
<a href="uploadModul"><button class="buttonL">Back</button></a>

<button class="buttonR" id="myBtn" onsubmit="kirim()">Submit</button>
<div id="myModal" class="modal">
    <div class="modal-content">
        <p class="tulisanHitam">Are you sure to submit course?</p>
        <!-- yes -->
        <button class="buttonM tulisanCoklat hurufSedang" style="margin-right: 50px;" onclick="submitForm()">Yes</button>
        <!-- no -->
        <a href="batalBikinCourse?id_courses=<?php echo $_GET['id_courses']?>"><button class="buttonM tulisanCoklat hurufSedang">No</button></a>
    </div>
</div>

<script>
    function addQuestion(){
        <?php $nomor ++?>
        let content2 = document.createElement("div");
        let content21 = document.createElement("div");
        let content22 = document.createElement("div");
        let content23 = document.createElement("div");

        let question = document.createElement("input");
        question.setAttribute("autofocus", "");
        question.setAttribute("autocomplete", "off");
        question.setAttribute("type", "text");
        question.setAttribute("name", "q<?php echo $nomor?>");
        question.className = "question";

        let content3 = document.createElement("div");
        let content31 = document.createElement("div");
        let content32 = document.createElement("div");
        let content33 = document.createElement("div");
        let label = document.createElement("label");
        let label2 = document.createElement("label");
        let label3 = document.createElement("label");

        let radio = document.createElement("input");
        radio.setAttribute("type", "radio");
        radio.setAttribute("name", "q<?php echo $nomor?>kunjaw");
        radio.value = "1";
        let radio2 = document.createElement("input");
        radio2.setAttribute("type", "radio");
        radio2.setAttribute("name", "q<?php echo $nomor?>kunjaw");
        radio2.value = "2";
        let radio3 = document.createElement("input");
        radio3.setAttribute("type", "radio");
        radio3.setAttribute("name", "q<?php echo $nomor?>kunjaw");
        radio3.value = "3";

        let text = document.createElement("input");
        text.setAttribute("name", "q<?php echo $nomor?>opt1");
        text.className ="space-input";
        let text2 = document.createElement("input");
        text2.setAttribute("name", "q<?php echo $nomor?>opt2");
        text2.className ="space-input";
        let text3 = document.createElement("input");
        text3.setAttribute("name", "q<?php echo $nomor?>opt3");
        text3.className ="space-input";
        
        content2.className = "content2 tulisanPutih";
        content21.className = "content2-1";
        content22.className = "content2-2";
        content23.className = "content2-3";

        content3.className = "content3 tulisanPutih";
        content31.className = "content3-1";
        content32.className = "content3-2";
        content33.className = "content3-3";
        label.className = "choice";
        label2.className = "choice";
        label3.className = "choice";

        let node21 = document.createTextNode("Question <?php echo $nomor?>");
        let node22 = document.createTextNode(":");

        content21.appendChild(node21);
        content22.appendChild(node22);
        content23.appendChild(question);

        content2.appendChild(content21);
        content2.appendChild(content22);
        content2.appendChild(content23);

        label.appendChild(radio);
        label2.appendChild(radio2);
        label3.appendChild(radio3);
        label.appendChild(text);
        label2.appendChild(text2);
        label3.appendChild(text3);

        content33.appendChild(label);
        content33.appendChild(label2);
        content33.appendChild(label3);

        content3.appendChild(content31);
        content3.appendChild(content32);
        content3.appendChild(content33);

        document.body.appendChild(content2);
        document.body.appendChild(content3);



        let button = document.getElementById("container");
        button.append(content2);
        button.append(content3);

        //checker if all dynamic form is included =)
        //console.log(document.getElementById("container"));
    }

    let modal = document.getElementById("myModal");
    let btn = document.getElementById("myBtn");

    btn.onclick = function() {
        modal.style.display = "block";
        modal.style.visibility = "visible";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function submitForm(){
        let form = document.getElementById("container");
        form.submit();
    }
</script>