<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet"> 
        <link rel="stylesheet" type="text/css" href="view/layout/style/userProfile.css"/>
        <link rel="stylesheet" type="text/css" href="view/layout/style/header.css"/>
        <link rel="stylesheet" type="text/css" href="view/layout/style/globalNeeds.css"/>
    </head>
    <body>
    	<div class="header">
            <img src="view/images/logoStudieKuy.png" id="logo" style="display: inline-block;"/>
    		<h1 id="judul" style="display: inline-block;"> Studie Kuy ! </h1>

            <?php 
                $saldoUser = $result[0]->getSaldo();
                if($saldoUser == 0.000){
                    $saldoUser = 0;
                }
                $statusLogin = $_SESSION['status'];
                echo '<a href="userTopup"><button type="submit" name="topupButton" class="tulisanCoklat" id="header-topupButton">'.$saldoUser.'</button></a>';
               
            ?>
    	</div>
        
        <div class="nav">
            <a href="courses" class="menuNav">Courses</a>
            <a href="index#anchor-aboutUs" class="menuNav">About Us</a>
            <a href="faq" class="menuNav">FAQ</a>
            <?php 
                //jgn lupa ini status udah login, di add di header controller bersangkutan
                if(isset($_SESSION['status'])){
                    echo ' <a href="userProfile" class="menuNavNow">My Profile</a>';
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