<div id="contentMainPage">
    <!-- Slide Show -->
    <div class="slideshow-container">
        <div class="mySlides fade" style="display: flex; flex-direction: row;">
            <div class="numbertext">1 / 3</div>
            <a class="prev" onclick="plusSlides(-1)" style="width: 15%;">&#10094;</a>
            <img src="view/images/Slide1.png" class="img">
            <a class="next" onclick="plusSlides(1)" style="width: 15%;">&#10095;</a>
        </div>

        <div class="mySlides fade" style="display: flex; flex-direction: row;">
            <div class="numbertext">2 / 3</div>
            <a class="prev" onclick="plusSlides(-1)" style="width: 15%;">&#10094;</a>
            <img src="view/images/slide2.png" class="img">
            <a class="next" onclick="plusSlides(1)" style="width: 15%;">&#10095;</a>
        </div>

        <div class="mySlides fade" style="display: flex; flex-direction: row;">
            <div class="numbertext">3 / 3</div>
            <a class="prev" onclick="plusSlides(-1)" style="width: 15%;">&#10094;</a>
            <img src="view/images/Slide3.png" class="img">
            <a class="next" onclick="plusSlides(1)" style="width: 15%;">&#10095;</a>
        </div>
    </div>
    <hr class="pembatasDashed">
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span> 
        <span class="dot" onclick="currentSlide(2)"></span> 
        <span class="dot" onclick="currentSlide(3)"></span> 
    </div>
    <!-- blok coklat paling atas  -->
    <div class="content1">
        <div class="content1-kiri">
            <p class="tulisanPutih hurufBesar" >
                Learn new knowledge and skills in a variety of ways, 
                from engaging video lectures and dynamic graphics to data
                visualizations and interactive elements
            </p>
            <a href="courses" class="content1-button"><h1 style="font-size: 1.4vw;">Start Learning Now !</h1></a>
        </div>
        <div class="content1-kanan">
            <img src="view/images/index1.png" class="content1-image"/>
            <p class="tulisanPutih content1-quote">
                “The single most important key to success is to be a good listener.”
                <br>
                ― Kelly Wearstler
            </p>
        </div>
    </div>

    <!-- pink tengah -->
    <hr class="pembatasDashed">
    <div class="content2">
        <div class="content2-kiri">
            <p class="tulisanCoklat hurufSedang">
                Visi :
                <br>
                <br>
                Menjadi platform online course terbaik nasional, dengan metode yang modern,
                dan sistem yang terintegrasi.
            </p>
        </div>
        <div class="content2-tengah">
            <img src="view/images/index2.png" class="content2-image"/>
        </div>
        <div class="content2-kanan">
            <p class="tulisanCoklat hurufSedang">
                Misi:
                <br>
                <br>
                Menyelenggarakan program belajar online yang memenuhi harapan user dengan menerapkan
                metode modern, dan sistem yang terintegrasi.
                <br>
                Menjadi platform Online Course yang terus berinovasi dan menyesuaikan dengan kemajuan jaman.
                <br id="anchor-aboutUs">
            </p>
        </div>
    </div>
    
    <hr class="pembatasDashed" >

    <!-- coklat tengah -->
    <div class="content3" >
        <div class="content3-kiri">
            <img src="view/images/index3.png" class="content3-image"/>
        </div>
        <div class="content3-kanan">
            <hr class="pembatasSubJudulPutih"/>
            <hr class="pembatasSubJudulPink"/>
            <p class="tulisanPutih hurufBesar" style="font-family: Calligraffitti; font-size:50px; margin:5px; margin-top:25px">
                About Us
            </p>
            <hr class="pembatasSubJudulPutih"/>
            <hr class="pembatasSubJudulPink"/>
            <p class="tulisanPutih hurufSedang justify content3-aboutUs">
                Perkembangan teknologi yang cukup pesat saat ini telah banyak berperan dalam kehidupan masyarkat
                sehari-hari khususnya dalam bidang pendidikan. Generasi milenial saat ini tentunya sudah tidak asing 
                dengan sistem pembelajaran secara daring.
                <br>
                <br>
                Studie Kuy! merupakan salah satu platform kursus online yang didirikan sejak 2021 dengan tujuan untuk membantu 
                masyarakat untuk dapat memperoleh ilmu baru yang menarik yang disuguhkan oleh tenaga-tenaga pendidik yang profesional.
            </p>
        </div>
    </div>
    <hr class="pembatasDashed">

    <!-- pink bawah teams -->
    <div class="content4">
        <div class="subContent4" style="margin-bottom: 70px;">
            <hr class="pembatasSubJudulPutih"/>
            <hr class="pembatasSubJudulCoklat"/>
            <p class="tulisanCoklat hurufBesar" style="font-family: Calligraffitti; font-size:60px; margin:5px; margin-top:25px">
                Our Teams
            </p>
            <hr class="pembatasSubJudulCoklat"/>
            <hr class="pembatasSubJudulPutih"/>
        </div>
        <div class="subContent4">
            <div class="content4-kiri">
                <img class="pp" src="view/images/ppNadia.png"/>
                <br>
                <div class="tulisanCoklat hurufSedang">
                    Nadia Clarissa 
                    <br>
                    Hermawan
                    <br>
                    6181901013
                </div>
            </div>
            <div class="content4-tengah">
                <img class="pp" src="view/images/ppTasha.jpg"/>
                <br>
                <div class="tulisanCoklat hurufSedang">
                    Natasha Benedicta
                    <br>
                    Bunnardi
                    <br>
                    6181901003
                </div>
            </div>
            <div class="content4-kanan">
                <img class="pp" src="view/images/ppRio.png"/>
                <br>
                <div class="tulisanCoklat hurufSedang">
                    Stanislaus Dendrio
                    <br>
                    Evan
                    <br>
                    6181901034
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
