
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
        <div class="content1-kiri-edit">
            <?php
                $pic = 'view/images/profilepicture/'.$result[0]->getProfpic();
                echo '<img src="'.$pic.'" class="content1-image ">';  
            ?>
            <input type="file" id="gantiprofpic" style="display:none" enctype="multipart/form-data"/>
            <input type="button" value="Upload Picture" class="tulisanPutih edit-input-box" style="margin-top: 5%;" onclick="document.getElementById('gantiprofpic').click();" />
        </div>
        <form method="post" action="userProfileEdit"  enctype="multipart/form-data" style="display: flex;">
            <div class="content1-tengah-edit tulisanPutih hurufBesar">
                <table class="profileTable">
                    <tr>
                        <td class="profile-title">Username</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getUsername().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Name</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getRealname().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Email</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getEmail().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Address</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getAddress().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Phone Number</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="text" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getPhone().'"/></td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="profile-title">Password</td>
                        <td>:</td>
                        <?php   
                            echo '<td><input type="password" class="edit-input-box tulisanPutih" style="text-align:left; width:150%" value="'.$result[0]->getPassword().'"/></td>';
                        ?>
                    </tr>
                </table>
            </div>
            <div class="content1-kanan-edit tulisanPutih hurufBesar">
                <button type="submit" class="tulisanCoklat" id="submit-edit-profile">Submit</button>
            </div>
        </form>
    </div>    
</div>

<form method="POST" action="userProfileEdit" enctype="multipart/form-data" style="margin-top: 150px;">
    <input type="file" name="foto"/>
    <button type="submit">Submit</button>
</form>