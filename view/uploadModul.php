<div class="content1">
    <div class="tulisanPutih hurufBesar">Course Module</div>
</div>
<hr>
<div class="content2 tulisanPutih" id="mod">
    <div class="content2-1">Module 1</div>
    <div class="content2-2">:</div>
    <div class="content2-3">
        <i class="material-icons md-36">cloud_upload</i>
        <div class="upload">Upload a Module</div>
    </div>
</div>
<div class="content2 tulisanPutih" id="mod">
    <div class="content2-1">Module 2</div>
    <div class="content2-2">:</div>
    <!-- <form id="formUpload" enctype="multipart/form-data" style="margin-left: 3%">
        <input class="submit-edit-profile" type="file" name="file"  id="baten" style="width:35%;">
    </form> -->

    <div class="content2-3">
        <i class="material-icons md-36">cloud_upload</i>
        <div class="upload">Upload a Module</div>
    </div>
</div>
<button class="button" id="button" onclick="addModule()" >Add Module</button>
<a href="createCourse"><button class="buttonL">Back</button></a>
<a href=""><button class="buttonR">Next</button></a>

<script>
    function addModule(){
        let content2 = document.createElement("div");
        let content21 = document.createElement("div");
        let content22 = document.createElement("div");
        let content23 = document.createElement("div");
        let icon = document.createElement("i");
        let upload = document.createElement("div");
        
        content2.className = "content2 tulisanPutih";
        content21.className = "content2-1";
        content22.className = "content2-2";
        content23.className = "content2-3";
        icon.className = "material-icons md-36";
        upload.className = "upload";

        let node21 = document.createTextNode("Module");
        let node22 = document.createTextNode(":");
        let nodeIcon = document.createTextNode("cloud_upload");
        let nodeUp = document.createTextNode("Upload a Module");

        content21.appendChild(node21);
        content22.appendChild(node22);
        icon.appendChild(nodeIcon);
        upload.appendChild(nodeUp);

        content23.appendChild(icon);
        content23.appendChild(upload);
        content2.appendChild(content21);
        content2.appendChild(content22);
        content2.appendChild(content23);

        document.body.appendChild(content2);

        let button = document.getElementById("button");
        document.body.insertBefore(content2, button);
    }
</script>