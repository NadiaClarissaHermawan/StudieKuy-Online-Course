<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="view/layout/style/globalNeeds.css"/>
        <link rel="stylesheet" type="text/css" href="view/layout/style/header.css"/>
        <link rel="stylesheet" type="text/css" href="view/layout/style/report.css"/>
    </head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <body>
        <div class="header">
            <img src="view/images/logoStudieKuy.png" id="logo" style="display: inline-block;"/>
            <h1 id="judul" style="display: inline-block;"> Admin Studie Kuy !</h1>
            <a href="adminLogout"><button type="submit" name="loginButton" class="tulisanCoklat" id="header-loginButton">ADMIN LOG OUT</button></a>     
        </div>
        
        <div class="nav">
            <a href="" class="menuNav">Report Chart</a>
            <div class="menuNavKanan">
                <a href="" id="link" class="material-icons md-36">cloud_download</a>
                <a href="indexAdmin" class="material-icons md-36">home</a>
            </div>
        </div>
        <!-- ini mesti ada buat keluarin konten yg uda dibikin sblmnya di php, kalo gaada, meski di echo di view jg gakan keluar -->
        <?php echo $content; ?>
    </body>
</html>