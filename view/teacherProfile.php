<!-- teacherProfile.php -->

<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //kalo belom login gabisa kesini
    if(!isset($_SESSION['statusTeacher'])){
        header("Location: teacherLogin");
        session_destroy();
        exit;
    }
?>
<div id="contentMainPage">
    <!-- judul -->
    <div class="title">
        <div class="title-kiri tulisanPutih" style="font-family:  Calligraffitti;">My Profile </div>
        <div class="title-tengah">
            <a href="profileEdit" class="tulisanPutih hurufSedang">Edit</a>
        </div>
        <div class="title-kanan">
            <a href="signOutUser" class="tulisanPutih hurufSedang">Sign Out</a>
        </div>
    </div>
    <hr>

    <div class="content1">
        <?php
            $pic = 'view/images/profilepicture/'.$result[0]->getProfpic();
            echo '<img src="'.$pic.'" class="content1-image content1-kiri">';
        ?>
        <div class="content1-kanan tulisanPutih hurufBesar">
            <table class="profileTable">
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$result[0]->getRealname().'</td>';
                    ?>
                </tr>
                <tr >
                    <td style="width: 40%;">Username</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$result[0]->getUsername().'</td>';
                    ?>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$result[0]->getEmail().'</td>';
                    ?>
                </tr>
                <tr>
                    <td>Pendidikan Terakhir</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$result[0]->getPendidikanTerakhir().'</td>';
                    ?>
                </tr>
            </table>
        </div>
    </div>    
</div>