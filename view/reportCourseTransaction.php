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
    <div class="tulisanPutih hurufBesar">Courses Transaction Report</div>
</div>
<hr>
<form id="form">
    <div class="content2 tulisanPutih">
            <!-- 1 -->
            <div class="content2-1">Course</div>
            <div class="content2-2" style="font-size: 1.8vw">:<input type="text" name="filterCourse" id="filterCourse" placeholder="Cari Course.." class="kotakInput tulisanCoklat"></div>
            <!-- 3 -->
            <div class="content2-1">Transaction ID</div>
            <div class="content2-2"  style="font-size: 1.8vw">:<input type="text" id="filterId" name="filterId" placeholder="Cari Id Transaksi.." class="kotakInput tulisanCoklat"></div>
    </div>
    <div class="content2 tulisanPutih">
            <!-- 4 -->
            <div class="content2-3" style="width: 12.5%;">Course Price</div>
            <div class="content2-4"  style="font-size: 1.8vw; justify-content:flex-start; margin-left: 20px; width:41%">:<input style="width:81%;" type="text" id="filterRate" name="filterRate" placeholder="Cari Harga Course.." class="kotakInput tulisanCoklat"></div>
            <!-- 5 -->
            <div class="content2-1">Transaction Date</div>
            <div class="content2-2" style="font-size: 1.8vw">:
                <input type="date" name="filterTglAwal" id="filterTglAwal" class="kotakDate tulisanCoklat" style="margin-left:3%">
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
            <th>Harga Course</th>
            <th>Saldo Awal</th>
            <th>Saldo Akhir</th>
            <th>Nama Course</th>
        </tr>
        <?php 
            if($result != null){
                $nomor = $indexStart;
                for($i = 0; $i<count($result); $i++){
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
    
    <div style="display: flex;">
        <?php
            // pagination angka halamannya
            for($i = 1; $i<=$jmlhPage; $i++){
                echo '<a style="color:white; font-size:1vw; margin: 10px" href="reportCourse?start='.$i.'">'.$i.'</a>';
            }
        ?>
    </div>
</div>
<a id="back" href="indexAdmin" >Back</a>
<div style="height:50px;"></div>

<script>
    //add link ke pdf report
    let link = document.getElementById("link");
    link.href = "reportTransactionCoursePdf";

    let filterCourse = document.getElementById('filterCourse');
    let filterId = document.getElementById('filterId');
    let filterRate = document.getElementById('filterRate');
    let filterTglAwal = document.getElementById('filterTglAwal');
    let filterTglAkhir = document.getElementById('filterTglAkhir');
    let container = document.getElementById('container');
    let form = document.getElementById('form');

    form.addEventListener('submit', function(){
        event.preventDefault();
    });

    //event listener course
    filterCourse.addEventListener('keyup', function(){
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

        //eksekusi ajax (method, source, true for asyncronus/tidak refresh)
        xhr.open('GET', 'courseTransactionFilter?course='+filterCourse.value+'&id='+filterId.value+'&rate='+filterRate.value+'&tglAwal='+filterTglAwal.value+'&tglAkhir='+filterTglAkhir.value, true);
        xhr.send();
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
        xhr.open('GET', 'courseTransactionFilter?course='+filterCourse.value+'&id='+filterId.value+'&rate='+filterRate.value+'&tglAwal='+filterTglAwal.value+'&tglAkhir='+filterTglAkhir.value, true);
        xhr.send();
    });

    //event listener rate
    filterRate.addEventListener('keyup', function(){
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
        xhr.open('GET', 'courseTransactionFilter?course='+filterCourse.value+'&id='+filterId.value+'&rate='+filterRate.value+'&tglAwal='+filterTglAwal.value+'&tglAkhir='+filterTglAkhir.value, true);
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
        xhr.open('GET', 'courseTransactionFilter?course='+filterCourse.value+'&id='+filterId.value+'&rate='+filterRate.value+'&tglAwal='+filterTglAwal.value+'&tglAkhir='+filterTglAkhir.value, true);
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
                console.log(xhr.responseText);
                container.innerHTML = xhr.responseText;
            }
        }

        //eksekusi ajax (method, source, true for asyncronus)
        xhr.open('GET', 'courseTransactionFilter?course='+filterCourse.value+'&id='+filterId.value+'&rate='+filterRate.value+'&tglAwal='+filterTglAwal.value+'&tglAkhir='+filterTglAkhir.value, true);
        xhr.send();
    });
</script>
