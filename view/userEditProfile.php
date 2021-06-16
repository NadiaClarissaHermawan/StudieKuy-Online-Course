
<!-- userProfile.php -->
<div id="contentMainPage">
    <!-- judul -->
    <div class="title">
        <div class="title-kiri tulisanPutih" style="font-family:  Calligraffitti;">My Profile </div>
        <div class="title-kanan">
            <a href="signOutUser" class="tulisanPutih hurufSedang">Sign Out</a>
        </div>
    </div>
    <hr>

    <div class="content1">
        <?php
            $pic = 'view/images/profilepicture/'.$_SESSION['profpic'];
            echo '<img src="'.$pic.'" class="content1-image content1-kiri">';
        ?>
        <div class="content1-kanan tulisanPutih hurufBesar">
            <table class="profileTable">
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$_SESSION['uname'].'</td>';
                    ?>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$_SESSION['realuname'].'</td>';
                    ?>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$_SESSION['email'].'</td>';
                    ?>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$_SESSION['alamat'].'</td>';
                    ?>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$_SESSION['phone'].'</td>';
                    ?>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$_SESSION['pass'].'</td>';
                    ?>
                </tr>
            </table>
        </div>
    </div>    
</div>

<form method="POST" action="userProfileEdit" enctype="multipart/form-data" style="margin-top: 150px;">
    <input type="file" name="foto"/>
    <button type="submit">Submit</button>
</form>