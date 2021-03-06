<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //kalo belom login gabisa kesini
    if(!isset($_SESSION['statusAdmin'])){
        header("Location: adminLogin");
        session_destroy();
        exit;
    }
?>
<table>
    <tr>
        <th>No.</th>
        <th>Id Transaksi</th>
        <th>Tanggal Transaksi</th>
        <th>Nama</th>
        <th>Nominal Top-Up</th>
        <th>Saldo Awal</th>
        <th>Saldo Akhir</th>
        <th>Bukti Transfer</th>
        <th>Verifikasi</th>
    </tr>
    
    <?php
        $nomor = 1;
        if($result != null){
            foreach($result as $key => $row){
                echo '<tr>';
                echo '<td>'.$nomor.'</td>';
                echo '<td>'.$row->getID().'</td>';
                echo '<td>'.$row->getTanggal().'</td>';
                echo '<td>'.$row->getRealName().'</td>';
                echo '<td>'.$row->getNominal().'</td>';
                echo '<td>'.$row->getSaldoAwal().'</td>';
                echo '<td>'.$row->getSaldoAkhir().'</td>';
                
                //keluarin image bukti trf yg bisa di zoom in
                echo '<td style="width:120px; height:100px;">';
                echo '<div class="row">';
                echo '<div class="column">';
                echo '<img style="width:300%" src="view/images/buktitransfer/'.$row->getBuktiTrf().'" style="width:100%" onclick="openModal();currentSlide(1)" class="hover-shadow cursor">';
                echo '</div>';

                echo '<div id="myModal" class="modal">';
                echo '<span class="close cursor" onclick="closeModal()">&times;</span>';
                echo '<div class="modal-content">';

                echo '<div class="mySlides">';
                echo '<img src="view/images/buktitransfer/'.$row->getBuktiTrf().'" style="width:100%">';
                echo '</div>';

                echo '<div class="caption-container">';
                echo '<p id="caption"></p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</td>';

                //button verifikasi
                echo '<td class="button">';

                //kalau belum diverifikasi
                if($row->getStatus() == 0){
                    //acc button
                    echo "<form method='GET' action='acceptTopUp'>";
                    echo '<input type="hidden" name="id" value="'.$row->getIDMember().'"/>';
                    echo '<input type="hidden" name="idTrans" value="'.$row->getID().'"/>';
                    echo '<input type="hidden" name="topup" value="'.$row->getNominal().'"/>';
                    echo '<button type="submit" value="accept" name="verif" class="button-kiri">Accept</button>';
                    echo "</form>";

                    //reject button
                    echo "<form method='GET' action='rejectTopUp'>";
                    echo '<input type="hidden" name="idTrans" value="'.$row->getID().'"/>';
                    echo '<input type="hidden" name="id" value="'.$row->getIDMember().'"/>';
                    echo '<button type="submit" value="decline" name="verif2" class="button-kanan">Reject</button>';
                    echo "</form>";
                
                //kalau sudah di accept
                }else if($row->getStatus() == 1){
                    echo '<button class="button-verified">Verified</button>';
                
                //kalau di reject
                }else if($row->getStatus() == 2){
                    echo '<button class="button-rejected">Rejected</button>';
                }

                echo '</td>';
                echo '</tr>';
              
                $nomor = $nomor+1;
            }
        }
    ?>

</table>
