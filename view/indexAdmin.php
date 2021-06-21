<div id="contentMainPage">
    <!-- blok coklat paling atas  -->
    <div class="content1">
        <div class="content1-kiri">
            <p class="tulisanPutih welcome" >
                WELCOME, 
                <?php   
                    if(session_status() == PHP_SESSION_NONE){
                        session_start();
                    }
                    if(isset($_SESSION['statusAdmin']) && $_SESSION['statusAdmin'] == 2){
                        echo '<div class="tulisanPutih namaAdmin">'.$result[0]->getUsername().' !</div>';
                    }
                ?>
            </p>
            <a href="reportCourse" class="content1-button"><h1>Courses Report</h1></a>
            <a href="reportTopUp" class="content1-button" id="b2"><h1>Top-Up Report</h1></a>
            <a href="reportCourseTransaction" class="content1-button"><h1>Courses Transaction Report</h1></a>
        </div>
        <div class="content1-kanan">
            <img src="view/images/indexAdmin.jpg" class="content1-image"/>
        </div>
    </div>
</div>
