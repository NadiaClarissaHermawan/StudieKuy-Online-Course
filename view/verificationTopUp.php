<div class="content1">
    <div class="tulisanPutih hurufBesar">Top-Up Verification</div>
</div>

<div class="table">
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
            foreach($result as $key => $row){
                echo '<tr>';
                echo '<td>'.$nomor.'</td>';
                echo '<td>'.$row->getID().'</td>';
                echo '<td>'.$row->getTanggal().'</td>';
                echo '<td>'.$row->getRealName().'</td>';
                echo '<td>'.$row->getNominal().'</td>';
                echo '<td>'.$row->getSaldoAwal().'</td>';
                echo '<td>'.$row->getSaldoAkhir().'</td>';
                echo '<td>'.$row->getBuktiTrf().'</td>';

                echo '<td class="button">';

                //kalau belum diverifikasi
                if($row->getStatus() == null){
                    //acc button
                    echo "<form method='GET' action='acceptSertif'>";
                    echo '<input type="hidden" name="id" value="'.$row->getIDMember().'"/>';
                    echo '<button type="submit" value="accept" name="verif" class="button-kiri">Accept</button>';
                    echo "</form>";

                    //reject button
                    echo "<form method='GET' action='rejectSertif'>";
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
        ?>

    </table>
</div>
<a class="button" id="back" href="verificationAdmin">Back</a>