<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="view/layout/style/globalNeeds.css"/>
        <link rel="stylesheet" type="text/css" href="view/layout/style/header.css"/>
        <link rel="stylesheet" type="text/css" href="view/layout/style/teacherLoginRegister.css"/>
    </head>
    <body>
    	<div class="header">
            <img src="view/images/logoStudieKuy.png" id="logo" style="display: inline-block;"/>
    		<h1 id="judul" style="display: inline-block;">Teacher Studie Kuy !</h1>
    	</div>
        
        <div class="nav">
            <a href="" class="menuNav" id="login">Lecturer Login </a>
        </div>
        <!-- ini mesti ada buat keluarin konten yg uda dibikin sblmnya di php, kalo gaada, meski di echo di view jg gakan keluar -->
        <?php echo $content; ?>
    </body>
</html>