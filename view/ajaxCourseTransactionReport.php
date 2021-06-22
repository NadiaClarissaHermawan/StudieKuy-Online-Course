<table>
    <tr>
        <th>No.</th>
        <th>Id Transaksi</th>
        <th>Tanggal</th>
        <th>Harga Course</th>
        <th>Saldo Awal</th>
        <th>Saldo Akhir</th>
        <th>Nama Course</th>
        <th>Verifikasi</th>
    </tr>
    <?php 
        if($result != null){
            $nomor = 1;
            foreach($result as $key => $row){
                echo '<tr>';
                echo '<td>'.$nomor.'</td>';
                echo '<td>'.$row->getIdTransaksi().'</td>';
                echo '<td>'.$row->getTanggal().'</td>';
                echo '<td>'.$row->getHarga().'</td>';
    
                $saldoAwal = $row->getSaldoAwal();
                $saldoAkhir = $row->getSaldoAkhir();
                if($saldoAwal == "0.000"){
                    $saldoAwal = 0;
                }
                if($saldoAkhir == "0.000"){
                    $saldoAkhir = 0;
                }
                echo '<td>'.$saldoAwal.'</td>';
                echo '<td>'.$saldoAkhir.'</td>';
    
                echo '<td>'.$row->getNamaCourse().'</td>';
    
                $tempStatusVerifikasi = $row->getStatusVerifikasi();
                if($tempStatusVerifikasi == 0){
                    $tempStatusVerifikasi = "Not Verified Yet";
                }else if($tempStatusVerifikasi == 1){
                    $tempStatusVerifikasi = "Verified";
                }else if($tempStatusVerifikasi == 2){
                    $tempStatusVerifikasi = "Rejected";
                }
                echo '<td>'.$tempStatusVerifikasi.'</td>';
                echo '</tr>';

                $nomor = $nomor +1;
            }
        }
    ?>
</table>