<div class="content1">
    <div class="tulisanPutih hurufBesar">Courses Transaction Report</div>
</div>
<hr>
<div class="content2 tulisanPutih">
        <div class="content2-1">Course</div>
        <div class="content2-2" style="font-size: 1.8vw">:<input type="text" name="filterCourse" id="filterCourse" placeholder="Cari Course.." class="kotakInput tulisanCoklat"></div>
        <div class="content2-3">Verification Status</div>
        <div class="content2-4" style="font-size: 1.8vw">:<input type="text" name="filterStatus" id="filterStatus" placeholder="Cari Status Verifikasi.." class="kotakInput tulisanCoklat"></div>
</div>
<div class="content2 tulisanPutih">
        <div class="content2-1">Transaction ID</div>
        <div class="content2-2"  style="font-size: 1.8vw">:<input type="text" id="filterId" name="filterId" placeholder="Cari Id Transaksi.." class="kotakInput tulisanCoklat"></div>
        <div class="content2-3">Course Rate</div>
        <div class="content2-4"  style="font-size: 1.8vw">:<input type="text" id="filterRate" name="filterRate" placeholder="Cari Harga Course.." class="kotakInput tulisanCoklat"></div>
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

<script>
    //ambil elemen" yg diperlukan
    let filterCourse = document.getElementById('filterCourse');
    let filterStatus = document.getElementById('filterStatus');
    let filterId = document.getElementById('filterId');
    let filterRate = document.getElementById('filterRate');
    let tombolCari = document.getElementById('search');
    let container = document.getElementById('container');

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

        //eksekusi ajax (method, source, true for asyncronus)
        xhr.open('GET', 'reportCourseTransactionFilter?course='+filterCourse.value+'&status='+filterStatus.value+'&Id='+filterId.value+'&rate='+filterRate.value, true);
        xhr.send();
    });

    //_________________________________________________________________________________________________________________________________________

    //event listener status verifikasi
    filterStatus.addEventListener('keyup', function(){

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
        xhr.open('GET', 'reportCourseTransactionFilter?course='+filterCourse.value+'&status='+filterStatus.value+'&Id='+filterId.value+'&rate='+filterRate.value, true);
        xhr.send();
    });

    //_________________________________________________________________________________________________________________________________________

    //event listener id transaksi
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
        xhr.open('GET', 'reportCourseTransactionFilter?course='+filterCourse.value+'&status='+filterStatus.value+'&Id='+filterId.value+'&rate='+filterRate.value, true);
        xhr.send();
    });

    //_________________________________________________________________________________________________________________________________________

    //event listener course rate
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
    xhr.open('GET', 'reportCourseTransactionFilter?course='+filterCourse.value+'&status='+filterStatus.value+'&Id='+filterId.value+'&rate='+filterRate.value, true);
    xhr.send();
    });

</script>