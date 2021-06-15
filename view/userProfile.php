<!-- userProfile.php -->
<div id="contentMainPage">
    <!-- judul -->
    <div class="title">
        <div class="title-kiri tulisanPutih">My Profile </div>
        <div class="title-tengah">
            <a href="" class="tulisanPutih hurufSedang">Edit</a>
        </div>
        <div class="title-kanan">
            <a href="signOutUser" class="tulisanPutih hurufSedang">Sign Out</a>
        </div>
    </div>
    <hr>

    <div class="content1">
        <img src="view/images/ppTasha.jpg" class="content1-image content1-kiri">
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