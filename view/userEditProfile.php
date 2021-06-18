
<!-- userProfile.php -->
<div id="contentMainPage">
    <!-- judul -->
    <div class="title">
        <div class="title-kiri tulisanPutih" style="font-family:  Calligraffitti;">My Profile </div>
        <div class="title-kanan">
            <a href="signOutUser" class="tulisanPutih hurufSedang" style="width: 10%;"></a>
            <a href="signOutUser" class="tulisanPutih hurufSedang">Sign Out</a>
        </div>
    </div>
    <hr>

    <div class="content1">
        <div class="content1-kiri">
            <?php
                $pic = 'view/images/profilepicture/'.$_SESSION['profpic'];
                echo '<img src="'.$pic.'" class="content1-image ">';  
            ?>
            <input type="file" id="gantiprofpic" class="tulisanPutih edit-input-box" enctype="multipart/form-data"/>
        </div>
        <div class="content1-kanan tulisanPutih hurufBesar">
            <form method="post" action="userProfileEdit"  enctype="multipart/form-data">
                <table class="profileTable">
                    <tr>
                        <td class="profile-title">Username</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" value="'.$_SESSION['uname'].'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Name</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" value="'.$_SESSION['realuname'].'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Email</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" value="'.$_SESSION['email'].'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Address</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" value="'.$_SESSION['alamat'].'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Phone Number</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" value="'.$_SESSION['phone'].'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Password</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="password" class="edit-input-box tulisanPutih" value="'.$_SESSION['pass'].'"/></td>';
                        ?>
                    </tr>
                </table>
                <button type="submit" class="tulisanCoklat" id="submit-edit-profile">Submit</button>
            </form>
        </div>
    </div>    
</div>

<form method="POST" action="userProfileEdit" enctype="multipart/form-data" style="margin-top: 150px;">
    <input type="file" name="foto"/>
    <button type="submit">Submit</button>
</form>