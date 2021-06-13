<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="View/layout/style/index.css"/>
        <link rel="stylesheet" type="text/css" href="View/layout/style/header.css"/>
        <link rel="stylesheet" type="text/css" href="View/layout/style/globalNeeds.css"/>
    </head>
    <body>
    	<div class="header">
            <img src="view/images/logoStudieKuy.png" id="logo" style="display: inline-block;"/>
    		<h1 id="judul" style="display: inline-block;"> Studie Kuy ! </h1>
            <!-- muncul ilangin tombol login  -->
            <?php 
                session_start();

                $status;
                if(isset($_SESSION['status']) == false){
                    echo '<a href="userLogin"><button type="submit" name="loginButton" class="tulisanCoklat" id="header-loginButton">Log in</button></a>';
                }else{
                    $_SESSION['status'] = $_GET['status'];
                }
            ?>
            </div>
        
        <!-- ini mesti ada buat keluarin konten yg uda dibikin sblmnya di php, kalo gaada, meski di echo di view jg gakan keluar -->
        <?php echo $content; ?>
    </body>
</html>