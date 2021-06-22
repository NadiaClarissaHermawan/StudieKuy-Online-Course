<table>
    <tr>
        <th>No.</th>
        <th>Id Transaksi</th>
        <th>Tanggal</th>
        <th>Harga Course</th>
        <th>Saldo Awal</th>
        <th>Saldo Akhir</th>
        <th>Nama Course</th>
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
                echo '</tr>';

                $nomor = $nomor +1;
            }
        }
    ?>
</table>