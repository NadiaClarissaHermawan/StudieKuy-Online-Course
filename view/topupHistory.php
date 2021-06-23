<?php
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    //kalo belom login gabisa kesini
    if(!isset($_SESSION['status'])){
        header("Location: userLogin");
        session_destroy();
        exit;
    }
?>
<div id="content-history">
    <div class="tulisanPutih" id="judul-history">
        Top up History
        <hr style="width: 80%; height:10%">
    </div>
</div>

<div id="history">
    
    <?php
        foreach($result as $key => $row){
        
            echo '<div class="bubble-history">';
            echo '<div class="bubble-kiri tulisanCoklat" style="text-align: left;">';
            echo 'Top up Saldo <br>';

            $saldoAwal = $row->getSaldoAwal();
            $saldoAkhir = $row->getSaldoAkhir();
            if($saldoAwal == '0.000'){
                $saldoAwal = 0;
            }
            if($saldoAkhir == '0.000'){
                $saldoAkhir = 0;
            }
            echo 'Saldo Awal  : Rp '.$saldoAwal.',-<br>';
            echo 'Saldo Akhir : Rp '.$saldoAkhir.',-';
            echo '</div>';
            echo '<div class="bubble-kanan tulisanCoklat" style="text-align: right;">';
            echo '+ Rp '.$row->getNominal().',-';
            echo '<div class="tgl">'.$row->getTanggal().'</div>';

            $status = $row->getStatusVerifikasi();
            //belum di verifikasi
            if($status == 0){
                echo '<div class="pending">Pending</div>';
            //accepted
            }else if($status == 1){
                echo '<div class="succeed">Succeed</div>';
            //rejected
            }else{
                echo '<div class="rejected">Rejected</div>';
            }
        
            echo '</div></div>';
        }
        
    ?>
</div>