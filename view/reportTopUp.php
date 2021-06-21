<div class="content1">
    <div class="tulisanPutih hurufBesar">Top Up Transaction Report</div>
</div>
<hr>
<div class="content2 tulisanPutih">
        <div class="content2-1">Transaction ID :</div>
        <div class="content2-2"><input type="text" name="" class="kotakInput tulisanCoklat"></div>
        <div class="content2-3" style="width: 16%;">Verification Status :</div>
        <div class="content2-4"><input type="text" name="" class="kotakInput tulisanCoklat"></div>
</div>
<div class="content2 tulisanPutih">
        <div class="content2-1">Transaction Date :</div>
        <div class="content2-2">
            <input type="date" name="" class="kotakDate tulisanCoklat">
            <div id="strip">-</div>
            <input type="date" name="" class="kotakDate tulisanCoklat">
        </div>
        <div class="content-kanan"><button class="button tulisanPutih" id="search">Search</button></div>
</div>
<div class="table">
    <table>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Top Up</th>
            <th>Saldo Awal</th>
            <th>Saldo Akhir</th>
            <th>Verifikasi</th>
        </tr>
        
        <?php
            $nomor = 1;
            foreach ($result as $key => $row) {
                echo '<tr>';
                echo '<td>'.$nomor.'</td>';
                echo '<td>'.$row->getTanggalTopUp().'</td>';
                echo '<td>'.$row->getNominal().'</td>';
                echo '<td>'.$row->getSaldoAwal().'</td>';
                echo '<td>'.$row->getSaldoAkhir().'</td>';
                echo '<td>'.$row->getStatusVerifikasi().'</td>';
                echo '<tr>';                
                $nomor = $nomor+1;
            }
        ?>
    </table>
</div>
<a id="back" href="indexAdmin" >Back</a>