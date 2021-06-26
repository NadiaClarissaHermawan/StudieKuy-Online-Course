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
    <div class="tulisanPutih hurufBesar">Course Module</div>
</div>
<hr>
<div>
    <form class="insert-form" name="form" id="container" method="POST" action="uploadModul" enctype="multipart/form-data">
        <?php $nomor = 1?>
        <input type="hidden" name="id_courses" value="<?php echo $_GET['id_courses']?>"/>
        <div class="content2 tulisanPutih" id="mod">
            <div class="content2-1"><input type="text" required="" class="nama-modul" name="modul<?php echo $nomor?>" autofocus placeholder="Enter modul name.."></div>
            <div class="content2-2">:</div>
            <div class="content2-3">
                <i class="material-icons md-36">cloud_upload</i>
                <div class="upload">Upload a Module</div>
                <input type="file" style="margin-left: 15%; margin-top: 3%;" required="" id="video" name="video<?php echo $nomor?>" accept="mp4/*"/> 
            </div>
            <!-- <div>
                <input type="text" required="" >
            </div> -->
        </div>
        <div hidden id="batasan"></div>
    
    </form>
</div>

<button class="button" id="button" onclick="addModule()" >Add New Module</button>
<a href="createCourse"><button class="buttonL">Back</button></a>
<a href="createExam"><button class="buttonR" onclick="submitModul()">Next</button></a>

<script>
    function addModule(){
        event.preventDefault();
        <?php $nomor ++;?>

        let content2 = document.createElement("div");
        let content21 = document.createElement("div");
        let content22 = document.createElement("div");
        let content23 = document.createElement("div");
        let icon = document.createElement("i");
        let upload = document.createElement("div");
        
        //bikin input type buat nama modul --> format nama modul untuk di ambil : modul1, modul2, dst
        let namaModul = document.createElement("input");
        namaModul.setAttribute("name", "modul<?php echo $nomor?>");
        namaModul.className = "nama-modul";
        namaModul.setAttribute("type", "text");
        namaModul.setAttribute("placeholder", "Enter modul name..");

        //bikin input type buat video modul --> format nama video untuk di ambil : video1, video2, dst
        let videoModul = document.createElement("input");
        videoModul.setAttribute("type", "file");
        videoModul.setAttribute("name", "video<?php echo $nomor?>");
        videoModul.style.marginLeft = "15%";
        videoModul.style.marginTop = "3%";
        videoModul.setAttribute("id", "video");
        videoModul.setAttribute("accept", "mp4/*");

        content2.className = "content2 tulisanPutih";
        content21.className = "content2-1";
        content22.className = "content2-2";
        content23.className = "content2-3";
        icon.className = "material-icons md-36";
        upload.className = "upload";

        content21.appendChild(namaModul);

        let node22 = document.createTextNode(":");
        let nodeIcon = document.createTextNode("cloud_upload");
        let nodeUp = document.createTextNode("Upload a Module");

        content22.appendChild(node22);
        icon.appendChild(nodeIcon);
        upload.appendChild(nodeUp);

        content23.appendChild(icon);
        content23.appendChild(upload);
        content2.appendChild(content21);
        content2.appendChild(content22);
        content2.appendChild(content23);
        
        content23.appendChild(videoModul);

        let button = document.getElementById("container");
        button.append(content2);
    }

    function submitModul(){
        event.preventDefault();
        let form = document.getElementById("container");
        form.submit();
    }
</script>