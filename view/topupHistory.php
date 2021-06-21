<div id="content-history">
    <div class="tulisanPutih" id="judul-history">
        Top Up History
        <hr style="width: 80%; height:10%">
    </div>
</div>

<div id="history">
    <table>
        <tr>
            <th>Nominal Top up</th>
            <th>Saldo Awal</th>
            <th>Saldo Akhir</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>

        <?php
            foreach($result as $key => $row){
                echo "<tr>";
                echo "<td>".$row->getNominal()."</td>";
                echo "<td>".$row->getSaldoAwal()."</td>";
                echo "<td>".$row->getSaldoAkhir()."</td>";
                echo "<td>".$row->getTanggal()."</td>";

                $status = $row->getStatusVerifikasi();
                //belum di verifikasi
                if($status == 0){
                    echo "<td>Pending</td>";
                //sudah di verif
                }else{
                    echo "<td>Succeed</td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
</div>