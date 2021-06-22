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
        <th>Tanggal</th>
        <th>Top Up</th>
        <th>Saldo Awal</th>
        <th>Saldo Akhir</th>
        <th>Verifikasi</th>
    </tr>
    
    <?php
        if($result != null){
            $nomor = 1;
            foreach ($result as $key => $row) {
                echo '<tr>';
                echo '<td>'.$nomor.'</td>';
                echo '<td>'.$row->getIDTopUp().'</td>';
                echo '<td>'.$row->getTanggalTopUp().'</td>';

                $nominal = $row->getNominal();
                $saldoAwal = $row->getSaldoAwal();
                $saldoAkhir = $row->getSaldoAkhir();
                if($nominal == '0.000'){
                    $nominal = 0;
                }
                if($saldoAwal == '0.000'){
                    $saldoAwal = 0;
                }
                if($saldoAkhir == '0.000'){
                    $saldoAkhir = 0;
                }

                echo '<td>'.$nominal.'</td>';
                echo '<td>'.$saldoAwal.'</td>';
                echo '<td>'.$saldoAkhir.'</td>';
                
                $statusVerif = $row->getStatusVerifikasi();
                if($statusVerif == 0){
                    $statusVerif = "Not Verified Yet";
                }else if($statusVerif == 1){
                    $statusVerif = "Verified";
                }else if($statusVerif == 2){
                    $statusVerif = "Rejected";
                }
                echo '<td>'.$statusVerif.'</td>';
                echo '<tr>';                
                $nomor = $nomor+1;
            }
        }
    ?>
</table>