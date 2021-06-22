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
    <div class="tulisanPutih hurufBesar">Top-Up Verification</div>
</div>
<form id="form">
    <h5 class="tulisanPutih" style="font-size: 1.3vw; margin-right:1%">Status Verifikasi :</h5>
    <select id="statusVerif" class="status tulisanCoklat">
        <option value="-1" selected>All</option>
        <option value="0">Not Verified Yet</option>
        <option value="1">Verified</option>
        <option value="2">Rejected</option>
    </select>
</form>

<div class="table" id="container">
    <table>
        <tr>
            <th>No.</th>
            <th>Id Transaksi</th>
            <th>Tanggal Transaksi</th>
            <th>Nama</th>
            <th>Nominal Top-Up</th>
            <th>Saldo Awal</th>
            <th>Saldo Akhir</th>
            <th>Bukti Transfer</th>
            <th>Verifikasi</th>
        </tr>
        
        <?php
            $nomor = 1;
            foreach($result as $key => $row){
                echo '<tr>';
                echo '<td>'.$nomor.'</td>';
                echo '<td>'.$row->getID().'</td>';
                echo '<td>'.$row->getTanggal().'</td>';
                echo '<td>'.$row->getRealName().'</td>';
                echo '<td>'.$row->getNominal().'</td>';
                echo '<td>'.$row->getSaldoAwal().'</td>';
                echo '<td>'.$row->getSaldoAkhir().'</td>';
                echo '<td>'.$row->getBuktiTrf().'</td>';

                echo '<td class="button">';

                //kalau belum diverifikasi
                if($row->getStatus() == 0){
                    //acc button
                    echo "<form method='GET' action='acceptTopUp'>";
                    echo '<input type="hidden" name="id" value="'.$row->getIDMember().'"/>';
                    echo '<input type="hidden" name="idTrans" value="'.$row->getID().'"/>';
                    echo '<input type="hidden" name="topup" value="'.$row->getNominal().'"/>';
                    echo '<button type="submit" value="accept" name="verif" class="button-kiri">Accept</button>';
                    echo "</form>";

                    //reject button
                    echo "<form method='GET' action='rejectTopUp'>";
                    echo '<input type="hidden" name="idTrans" value="'.$row->getID().'"/>';
                    echo '<input type="hidden" name="id" value="'.$row->getIDMember().'"/>';
                    echo '<button type="submit" value="decline" name="verif2" class="button-kanan">Reject</button>';
                    echo "</form>";
                
                //kalau sudah di accept
                }else if($row->getStatus() == 1){
                    echo '<button class="button-verified">Verified</button>';
                
                //kalau di reject
                }else if($row->getStatus() == 2){
                    echo '<button class="button-rejected">Rejected</button>';
                }

                echo '</td>';
                echo '</tr>';
              
                $nomor = $nomor+1;
            }
        ?>

    </table>
</div>
<a class="button" id="back" href="verificationAdmin">Back</a>


<script>
    let filterStatus = document.getElementById('statusVerif');
    let container = document.getElementById('container');

    filterStatus.addEventListener('change', function(){
         //buat objek ajax
         let xhr = new XMLHttpRequest();

        //cek status ajax
        xhr.onreadystatechange = function (){
            if(xhr.readyState == 4 && xhr.status == 200){
                //apapun isi dr sumber (checker ajax jalan ga)
                console.log(filterStatus.value);
                container.innerHTML = xhr.responseText;
            }
        }

        //eksekusi ajax (method, source, true for asyncronus/tidak refresh)
        xhr.open('GET', 'verifTopupFilter?status='+filterStatus.value, true);
        xhr.send();
    });

</script>