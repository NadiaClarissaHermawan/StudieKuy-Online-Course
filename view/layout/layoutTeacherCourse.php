<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="view/layout/style/globalNeeds.css"/>
        <link rel="stylesheet" type="text/css" href="view/layout/style/header.css"/>
        <link rel="stylesheet" type="text/css" href="view/layout/style/teacherCourse.css"/>
    </head>
    <body>
    	<div class="header">
            <img src="view/images/logoStudieKuy.png" id="logo" style="display: inline-block;"/>
    		<h1 id="judul" style="display: inline-block;"> Teacher Studie Kuy !</h1>
            <a href="teacherLogout"><button type="submit" name="loginButton" class="tulisanCoklat" id="header-loginButton">TEACHER LOG OUT</button></a> 
        </div>
        
        <div class="nav">
            <a href="indexTeacher" class="menuNav">Home /</a>
            <a href="#" class="menuNavNow">Teacher's Course</a>
            <?php 
                //jgn lupa ini status udah login, di add di header controller bersangkutan
                if(isset($_SESSION['status'])){
                    echo ' <a href="teacherProfile" class="menuNavNow">My Profile</a>';
                }
            ?>
            <div class="menuNavKanan">
                <a href="indexTeacher" class="material-icons md-36">home</a>
            </div>
        </div>
        
        <!-- ini mesti ada buat keluarin konten yg uda dibikin sblmnya di php, kalo gaada, meski di echo di view jg gakan keluar -->
        <?php echo $content; ?>
    </body>
</html>