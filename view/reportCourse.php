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

<div class="content1">
    <div class="tulisanPutih hurufBesar">Courses Member Report</div>
</div>
<hr>
<form id="form" method="POST">
    <div class="content2 tulisanPutih">
            <!-- 1 -->
            <div class="content2-1">Member Name</div>
            <div style="font-size: 1.5vw; width:3%; display:flex; align-items:center; margin-left:0.3%">:</div>
            <?php
                //filter nama
                if(isset($nama)){
                    echo '<div class="content2-2"><input type="text" id="filterName" name="filterName" placeholder="Cari nama Member.." value="'.$nama.'" class="kotakInput tulisanCoklat" autofocus style="margin-right: -4%;" autocomplete="off"></div>';
                }else{
                    echo '<div class="content2-2"><input type="text" id="filterName" name="filterName" placeholder="Cari nama Member.." class="kotakInput tulisanCoklat" autofocus style="margin-right: -4%;" autocomplete="off"></div>';
                }
            ?>
            
            <!-- 2 -->
            <div class="content2-3">Completeness Status</div>
            <div style="font-size: 1.5vw; width:3%; display:flex; align-items:center">:</div>
            <div class="content2-4"><input type="text" id="filterCompleteStatus" placeholder="Cari Status Ketuntasan.." name="filterCompleteStatus" class="kotakInput tulisanCoklat"></div>
    </div>
    <div class="content2 tulisanPutih">
            <!-- 3 -->
            <div class="content2-1" style="width: 13.6%;">Final Score</div>
            <div style="font-size: 1.5vw; width:3%; display:flex; align-items:center">:</div>
            <div class="content2-2"><input type="text" id="filterFinalScore" placeholder="Cari nilai akhir.." name="filterFinalScore" class="kotakInput tulisanCoklat" style="width: 89%;"></div>

           </div>
</form>

<div class="table" id="container">
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
                $nomor = $indexStart;
                //loop page
                for($i = 0; $i<count($result); $i++){
                    echo '<tr>';
                    echo '<td>'.$nomor.'</td>';
                    echo '<td>'.$result[$i]->getRealName().'</td>';
    
                    $tempNilaiAkhir = $result[$i]->getNilaiAkhir();
                    if($tempNilaiAkhir == null){
                        $tempNilaiAkhir = "-";
                    }
                    echo '<td>'.$tempNilaiAkhir.'</td>';
    
                    echo '<td>'.$result[$i]->getStatusKetuntasan().'</td>';
    
                    $tempStatusVerifikasi = $result[$i]->getStatusVerifikasi();
                    if($tempStatusVerifikasi == null){
                        $tempStatusVerifikasi = "-";
                    }
                    echo '<td>'.$tempStatusVerifikasi.'</td>';
    
                    $tempTanggalTuntas = $result[$i]->getTanggalTuntas();
                    if($tempTanggalTuntas == null){
                        $tempTanggalTuntas = "-";
                    }
                    echo '<td>'.$tempTanggalTuntas.'</td>';
    
                    echo '<td>'.$result[$i]->getNamaCourse().'</td>';
                    echo '<td>'.$result[$i]->getBatasNilai().'</td>';
                    echo '<td>'.$result[$i]->getNamaBidang().'</td>';
                    echo '<tr>';
                    
                    $nomor = $nomor+1;
                }
            }
        ?>
    </table>
    
    <div style="display: flex;">
        <?php
            // pagination angka halamannya
            for($i = 1; $i<=$jmlhPage; $i++){
                echo '<a style="color:white; font-size:1vw; margin: 10px" href="reportCourse?start='.$i.'">'.$i.'</a>';
            }
        ?>
    </div>
</div>
<br>
<a href="indexAdmin" id="back">Back</a>
<a href="reportCoursePdf" class="material-icons md-36">cloud_download</a>

<script>
    //ambil elemen" yg diperlukan
    let filterName = document.getElementById('filterName');
    let filterCompleteStatus = document.getElementById('filterCompleteStatus');
    let filterNilai = document.getElementById('filterFinalScore');
    let container = document.getElementById('container');
    let form = document.getElementById('form');
    
    //event listener biar button submit ga ngesubmit
    form.addEventListener('submit', function(){
        event.preventDefault();
    })

    //event listener name
    filterName.addEventListener('keyup', function(){

        //buat objek ajax
        let xhr = new XMLHttpRequest();

        //cek status ajax
        xhr.onreadystatechange = function (){
            if(xhr.readyState == 4 && xhr.status == 200){
                //apapun isi dr sumber (checker ajax jalan ga)
                console.log(xhr.responseText);

                container.innerHTML = xhr.responseText;
            }
        }

        //eksekusi ajax (method, source, true for asyncronus)
        xhr.open('GET', 'reportCourseFilter?name='+filterName.value+'&complete='+filterCompleteStatus.value+'&nilai='+filterNilai.value, true);
        xhr.send();
    });

    //_________________________________________________________________________________________________________________________________________

    //event listener complete status
    filterCompleteStatus.addEventListener('keyup', function(){

        //buat objek ajax
        let xhr = new XMLHttpRequest();

        //cek status ajax
        xhr.onreadystatechange = function (){
            if(xhr.readyState == 4 && xhr.status == 200){
                //apapun isi dr sumber (checker ajax jalan ga)
                console.log(xhr.responseText);

                container.innerHTML = xhr.responseText;
            }
        }

        //eksekusi ajax (method, source, true for asyncronus)
        xhr.open('GET', 'reportCourseFilter?name='+filterName.value+'&complete='+filterCompleteStatus.value+'&nilai='+filterNilai.value, true);
        xhr.send();
    });

    //_________________________________________________________________________________________________________________________________________

    //event listener nilai
    filterNilai.addEventListener('keyup', function(){

        //buat objek ajax
        let xhr = new XMLHttpRequest();

        //cek status ajax
        xhr.onreadystatechange = function (){
            if(xhr.readyState == 4 && xhr.status == 200){
                //apapun isi dr sumber (checker ajax jalan ga)
                console.log(xhr.responseText);

                container.innerHTML = xhr.responseText;
            }
        }

        //eksekusi ajax (method, source, true for asyncronus)
        xhr.open('GET', 'reportCourseFilter?name='+filterName.value+'&complete='+filterCompleteStatus.value+'&nilai='+filterNilai.value, true);
        xhr.send();
    });

</script>