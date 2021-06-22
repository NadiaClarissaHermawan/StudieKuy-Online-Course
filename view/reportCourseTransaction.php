<div class="content1">
    <div class="tulisanPutih hurufBesar">Courses Transaction Report</div>
</div>
<hr>
<div class="content2 tulisanPutih">
        <div class="content2-1">Course</div>
        <div class="content2-2" style="font-size: 1.8vw">:<input type="text" name="" class="kotakInput tulisanCoklat"></div>
        <div class="content2-3">Verification Status</div>
        <div class="content2-4" style="font-size: 1.8vw">:<input type="text" name="" class="kotakInput tulisanCoklat"></div>
</div>
<div class="content2 tulisanPutih">
        <div class="content2-1">Transaction ID</div>
        <div class="content2-2"  style="font-size: 1.8vw">:<input type="text" name="" class="kotakInput tulisanCoklat"></div>
        <div class="content2-3">Course Rate</div>
        <div class="content2-4"  style="font-size: 1.8vw">:<input type="text" name="" class="kotakInput tulisanCoklat"></div>
</div>
<div class="content2 tulisanPutih">
        <div class="content2-1">Transaction Date</div>
        <div class="content2-2" style="font-size: 1.8vw">:
            <input type="date" name="" class="kotakDate tulisanCoklat" style="margin-left:3%">
            <div id="strip">-</div>
            <input type="date" name="" class="kotakDate tulisanCoklat">
        </div>
        <div class="content-kanan"><button class="button tulisanPutih" id="search">Search</button></div>
</div>
<div class="table">
    <table>
        <tr>
            <th>Id Transaksi</th>
            <th>Tanggal</th>
            <th>Harga Course</th>
            <th>Saldo Awal</th>
            <th>Saldo Akhir</th>
            <th>Nama Course</th>
            <th>Verifikasi</th>
        </tr>
        <?php 
            foreach($result as $key => $row){
                echo '<tr>';
                echo '<td>'.$row->getIdTransaksi().'</td>';
                echo '<td>'.$row->getTanggal().'</td>';
                echo '<td>'.$row->getHarga().'</td>';
                echo '<td>'.$row->getSaldoAwal().'</td>';
                echo '<td>'.$row->getSaldoAkhir().'</td>';
                echo '<td>'.$row->getNamaCourse().'</td>';
                $tempStatusVerifikasi = $row->getStatusVerifikasi();
                if($tempStatusVerifikasi == null){
                    $tempStatusVerifikasi = "-";
                }
                echo '<td>'.$tempStatusVerifikasi.'</td>';
                echo '<tr>';
            }
        ?>
    </table>
</div>
<a id="back" href="indexAdmin" >Back</a>
<div style="height:50px;"></div>