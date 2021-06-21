<div class="content1">
    <div class="tulisanPutih hurufBesar">Courses Member Report</div>
</div>
<hr>
<form id="form">
    <div class="content2 tulisanPutih">
            <!-- 1 -->
            <div class="content2-1">Member Name</div>
            <div style="font-size: 1.5vw; width:3%; display:flex; align-items:center; margin-left:0.3%">:</div>
            <div class="content2-2"><input type="text" id="filterName" name="filterName" class="kotakInput tulisanCoklat" style="margin-right: -4%;"></div>
            
            <!-- 2 -->
            <div class="content2-3">Completeness Status</div>
            <div style="font-size: 1.5vw; width:3%; display:flex; align-items:center">:</div>
            <div class="content2-4"><input type="text" id="filterCompleteStatus" name="filterCompleteStatus" class="kotakInput tulisanCoklat"></div>
    </div>
    <div class="content2 tulisanPutih">
            <!-- 3 -->
            <div class="content2-1" style="width: 13.6%;">Final Score</div>
            <div style="font-size: 1.5vw; width:3%; display:flex; align-items:center">:</div>
            <div class="content2-2"><input type="text" id="filterFinalScore" name="filterFinalScore" class="kotakInput tulisanCoklat" style="width: 89%;"></div>
            <button type="submit" class="content-kanan tulisanPutih" id="search">Search</button>
    </div>
</form>
<!-- 
<script type="text/javascript">
    let form = document.getElementById("form");
    form.addEventListener("submit", onSubmit);

    function onSubmit(event){
        event.preventDefault();
        let formElements = event.currentTarget.elements;
        let input = new URLSearchParams(new FormData(form)).toString();

        //ajax fetchAPI
        const promise = fetch('filterReportCourse?'+input);
        promise.then(function(response){
            console.log(response.status);
            if(response.status == 200){
                console.log(response);
                // console.log(JSON.parse(response));
                // response.text().then(function(text){
                //     console.log(JSON.stringify(text));
                // });
            }
        });
    }
</script> -->

<div class="table">
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
        ?>
    </table>
</div>
<br>
<a href="indexAdmin" id="back">Back</a>