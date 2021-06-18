<!-- userProfile.php -->
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
                    <td>Username</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$result[0]->getUsername().'</td>';
                    ?>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$result[0]->getRealname().'</td>';
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
                    <td>Address</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$result[0]->getAddress().'</td>';
                    ?>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>:</td>
                    <?php   
                        echo '<td>'.$result[0]->getPhone().'</td>';
                    ?>
                </tr>
            </table>
        </div>
    </div>    
</div>



<!-- <div class="content1">
    <div class="abc">
        <p class="tulisanPutih hurufBesar" id="abc">My Profile</p>
    </div>
    <div class="menuProf">
        <a href="" class="tulisanPutih hurufKecil" id="edit">Edit</a>
        <a href="" class="tulisanPutih hurufKecil" id="signOut">Sign Out</a>
    </div>
    <hr>
</div>
<?php
        // session_destdoy();
?> -->