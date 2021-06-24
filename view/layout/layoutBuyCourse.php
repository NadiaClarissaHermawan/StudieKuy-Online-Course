<!-- terhubung ke indexController.php, viewIndex.php -->
<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="View/layout/style/globalNeeds.css"/>
        <link rel="stylesheet" type="text/css" href="View/layout/style/header.css"/>
        <link rel="stylesheet" type="text/css" href="View/layout/style/courseExam.css"/>
        <link rel="stylesheet" type="text/css" href="View/layout/style/examFinished.css"/>
        <link rel="stylesheet" type="text/css" href="View/layout/style/timeOut.css"/>
        <link rel="stylesheet" type="text/css" href="View/layout/style/buyCourse.css"/>
    </head>
    <body>
    	<div class="header">
            <img src="view/images/logoStudieKuy.png" id="logo" style="display: inline-block;"/>
    		<h1 id="judul" style="display: inline-block;"> Studie Kuy ! </h1>

        </div>
        
        <div class="nav">
            <a href="courses" class="menuNav">Courses</a>
            <a href="#anchor-aboutUs" class="menuNav">About Us</a>
            <a href="faq" class="menuNav">FAQ</a>
            <?php 
                //jgn lupa ini status udah login, di add di header controller bersangkutan
                if(isset($_SESSION['status'])){
                    echo ' <a href="userProfile" class="menuNav">My Profile</a>';
                }
                $statusLogin = 0;

                if(isset($_SESSION['status']) == false){
                    echo '<a href="userLogin"><button type="submit" name="loginButton" class="tulisanCoklat" id="header-loginButton">Log in</button></a>';
                }else{
                    if($saldoUser == 0.000){
                        $saldoUser = 0;
                    }
                    $statusLogin = $_SESSION['status'];
                    echo '<a  href="userTopup"><button style="top:-64px" type="submit" name="topupButton" class="tulisanCoklat" id="header-topupButton">'.$saldoUser.'</button></a>';
                }
            ?>
            <div class="menuNavKanan">
                <a href="index" class="material-icons md-36">home</a>
                <?php 
                    //jgn lupa ini status udah login, di add di header controller bersangkutan
                    if(isset($_SESSION['status'])){
                        echo ' <a href="coursesList" class="material-icons md-36">reorder</a>';
                    }
                ?>
            </div>
        </div>
        
        <!-- ini mesti ada buat keluarin konten yg uda dibikin sblmnya di php, kalo gaada, meski di echo di view jg gakan keluar -->
        <?php echo $content; ?>
    </body>
</html>