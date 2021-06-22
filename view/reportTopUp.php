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
    <div class="tulisanPutih hurufBesar">Top Up Transaction Report</div>
</div>
<hr>
<form id="form">
    <div class="content2 tulisanPutih">
            <!-- 1 -->
            <div class="content2-1">Transaction ID</div>
            <div class="content2-2"  style="font-size: 1.8vw">:<input type="text" id="filterId" name="filterId" placeholder="Cari id transaksi.." autofocus autocomplete="off" class="kotakInput tulisanCoklat"></div>

            <!-- 2 -->
            <div class="content2-3" style="width: 16%;">Verification Status</div>
            <div class="content2-4"  style="font-size: 1.8vw">:<input type="text" id="filterVerifikasi" placeholder="Cari status verifikasi.." autocomplete="off" name="filterVerifikasi" class="kotakInput tulisanCoklat"></div>
    </div>
    <div class="content2 tulisanPutih">
            <!-- 3 -->
            <div class="content2-1" style="width: 14%;">Transaction Date</div>
            <div class="content2-2"  style="font-size: 1.8vw">:
                <input type="date" name="filterTglAwal" id="filterTglAwal" class="kotakDate tulisanCoklat" style="margin-left: 3%;">
                <div id="strip">-</div>
                <input type="date" name="filterTglAkhir" id="filterTglAkhir" class="kotakDate tulisanCoklat">
            </div>
    </div>
</form>

<div class="table" id="container">
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
                    $statusVerif = "Rejected";
                }else if($statusVerif == 1){
                    $statusVerif = "Verified";
                }else{
                    $statusVerif = "Not Verified Yet";
                }
                echo '<td>'.$statusVerif.'</td>';
                echo '<tr>';                
                $nomor = $nomor+1;
            }
        ?>
    </table>
</div>
<a id="back" href="indexAdmin" >Back</a>
<div style="height:50px;"></div>
  

<script>
    let filterId = document.getElementById('filterId');
    let filterStatus = document.getElementById('filterVerifikasi');
    let filterTglAwal = document.getElementById('filterTglAwal');
    let filterTglAkhir = document.getElementById('filterTglAkhir');
    let containter = document.getElementById('container');
    let form = document.getElementById('form');

    form.addEventListener('submit', function(){
        event.preventDefault();
    });

    //event listener id
    filterId.addEventListener('keyup', function(){
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
        xhr.open('GET', 'topupReportFilter?id='+filterId.value+'&status='+filterStatus.value+'&tglAwal='+filterTglAwal.value+'&tglAkhir='+filterTglAkhir.value, true);
        xhr.send();
    });

    //event listener status
    filterStatus.addEventListener('keyup', function(){
        //buat objek ajax
        let xhr = new XMLHttpRequest();

        //cek status ajax
        xhr.onreadystatechange = function (){
            if(xhr.readyState == 4 && xhr.status == 200){
                //apapun isi dr sumber (checker ajax jalan ga)
                console.log("berhasil");

                container.innerHTML = xhr.responseText;
            }
        }

        console.log(filterStatus.value);
        //eksekusi ajax (method, source, true for asyncronus)
        xhr.open('GET', 'topupReportFilter?id='+filterId.value+'&status='+filterStatus.value+'&tglAwal='+filterTglAwal.value+'&tglAkhir='+filterTglAkhir.value, true);
        xhr.send();
    });

    //event listener tgl awal
    filterTglAwal.addEventListener('change', function(){
        //buat objek ajax
        let xhr = new XMLHttpRequest();

        //cek status ajax
        xhr.onreadystatechange = function (){
            if(xhr.readyState == 4 && xhr.status == 200){
                //apapun isi dr sumber (checker ajax jalan ga)
                console.log(filterTglAwal.value);

                container.innerHTML = xhr.responseText;
            }
        }

        
        //eksekusi ajax (method, source, true for asyncronus)
        xhr.open('GET', 'topupReportFilter?id='+filterId.value+'&status='+filterStatus.value+'&tglAwal='+filterTglAwal.value+'&tglAkhir='+filterTglAkhir.value, true);
        xhr.send();
    });

    //event listener tgl akhir
    filterTglAkhir.addEventListener('change', function(){
        //buat objek ajax
        let xhr = new XMLHttpRequest();

        //cek status ajax
        xhr.onreadystatechange = function (){
            if(xhr.readyState == 4 && xhr.status == 200){
                //apapun isi dr sumber (checker ajax jalan ga)
                console.log(filterTglAwal.value);

                container.innerHTML = xhr.responseText;
            }
        }

        //eksekusi ajax (method, source, true for asyncronus)
        xhr.open('GET', 'topupReportFilter?id='+filterId.value+'&status='+filterStatus.value+'&tglAwal='+filterTglAwal.value+'&tglAkhir='+filterTglAkhir.value, true);
        xhr.send();
    });
</script>