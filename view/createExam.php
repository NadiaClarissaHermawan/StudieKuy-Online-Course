<div class="content1">
    <div class="tulisanPutih hurufBesar">Create Course Exam</div>
</div>
<hr>
<div class="content2 tulisanPutih">
    <div class="content2-1">Question 1</div>
    <div class="content2-2">:</div>
    <div class="content2-3"><input type="text" class="question"></div>
</div>
<div class="content3 tulisanPutih">
    <div class="content3-1" style="visibility: hidden;"></div>
    <div class="content3-2" style="visibility: hidden;"></div>
    <div class="content3-3">
        <label class="choice">
            <input type="radio" name="opt">
            <input type="text" class="space-input">
        </label>
        <label class="choice">
            <input type="radio" name="opt" >
            <input type="text" class="space-input">
        </label>
        <label class="choice">
            <input type="radio" name="opt" >
            <input type="text" class="space-input">
        </label>
    </div>
</div>
<div class="content2 tulisanPutih">
    <div class="content2-1">Question 2</div>
    <div class="content2-2">:</div>
    <div class="content2-3"><input type="text" class="question"></div>
</div>
<div class="content3 tulisanPutih">
    <div class="content3-1"></div>
    <div class="content3-2"></div>
    <div class="content3-3">
        <label class="choice">
            <input type="radio" name="opt">
            <input type="text" class="space-input">
        </label>
        <label class="choice">
            <input type="radio" name="opt" >
            <input type="text" class="space-input">
        </label>
        <label class="choice">
            <input type="radio" name="opt" >
            <input type="text" class="space-input">
        </label>
    </div>
</div>

<button class="button" id="button" onclick="addQuestion()" >Add New Question</button>
<a href="uploadModul"><button class="buttonL">Back</button></a>
<a href=""><button class="buttonR">Next</button></a>

<script>
    function addQuestion(){
        let content2 = document.createElement("div");
        let content21 = document.createElement("div");
        let content22 = document.createElement("div");
        let content23 = document.createElement("div");
        let question = document.createElement("input");
        let content3 = document.createElement("div");
        let content31 = document.createElement("div");
        let content32 = document.createElement("div");
        let content33 = document.createElement("div");
        let label = document.createElement("label");
        let label2 = document.createElement("label");
        let label3 = document.createElement("label");
        let radio = document.createElement("input");
        let radio2 = document.createElement("input");
        let radio3 = document.createElement("input");
        let text = document.createElement("input");
        let text2 = document.createElement("input");
        let text3 = document.createElement("input");
        
        radio.type = "radio";
        radio2.type = "radio";
        radio3.type = "radio";
        radio.name = "opt";
        radio2.name = "opt";
        radio3.name = "opt";
        content2.className = "content2 tulisanPutih";
        content21.className = "content2-1";
        content22.className = "content2-2";
        content23.className = "content2-3";
        question.className = "question";

        content3.className = "content3 tulisanPutih";
        content31.className = "content3-1";
        content32.className = "content3-2";
        content33.className = "content3-3";
        label.className = "choice";
        label2.className = "choice";
        label3.className = "choice";
        text.className = "space-input";
        text2.className = "space-input";
        text3.className = "space-input";

        let node21 = document.createTextNode("Question");
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

        let button = document.getElementById("button");
        document.body.insertBefore(content2, button);
        document.body.insertBefore(content3, button);
    }
</script>