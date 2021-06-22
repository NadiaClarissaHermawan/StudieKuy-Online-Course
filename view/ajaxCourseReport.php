<table>
    <tr>
        <th>No.</th>
        <th>Nama</th>
        <th>Nilai Akhir</th>
        <th>Status Ketuntasan</th>
        <th>Status Verifikasi</th>
        <th>Tanggal Tuntas</th>
        <th>Nama Course</th>
        <th>Syarat Nilai Minimum</th>
        <th>Nama Bidang</th>
    </tr>

    <?php 
        if($result != null){
            $nomor = 1;
            foreach($result as $key => $row){
                echo '<tr>';
                echo '<td>'.$nomor.'</td>';
                echo '<td>'.$row->getRealName().'</td>';

                $tempNilaiAkhir = $row->getNilaiAkhir();
                if($tempNilaiAkhir == null){
                    $tempNilaiAkhir = "-";
                }
                echo '<td>'.$tempNilaiAkhir.'</td>';

                echo '<td>'.$row->getStatusKetuntasan().'</td>';

                $tempStatusVerifikasi = $row->getStatusVerifikasi();
                if($tempStatusVerifikasi == null){
                    $tempStatusVerifikasi = "-";
                }
                echo '<td>'.$tempStatusVerifikasi.'</td>';

                $tempTanggalTuntas = $row->getTanggalTuntas();
                if($tempTanggalTuntas == null){
                    $tempTanggalTuntas = "-";
                }
                echo '<td>'.$tempTanggalTuntas.'</td>';

                echo '<td>'.$row->getNamaCourse().'</td>';
                echo '<td>'.$row->getBatasNilai().'</td>';
                echo '<td>'.$row->getNamaBidang().'</td>';
                echo '<tr>';
                
                $nomor = $nomor+1;
            }
        }
    ?>
</table>