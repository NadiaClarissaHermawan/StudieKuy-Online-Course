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
<div class="content1 hurufBesar tulisanPutih">Total Incomes per Day</div>
<div class="chartReport" style="background-color: white;">
    <canvas id="myChart"></canvas>
</div>
<a href="reportTopUp" id="back">Back</a>
<div style="height:50px;"></div>

<script defer>
    let ch = document.getElementById('myChart').getContext('2d');
    let arrTanggal = [];
    let arrJmlhTopup = [];
    let r,g,b;
    let arrBackround = [];
    let arrBorder = [];

    <?php
        foreach ($result as $key => $value) {
            ?>
            arrTanggal.push('<?php echo $value['tanggal_transaksi_saldo']?>');
            arrJmlhTopup.push('<?php echo $value['total']?>');
            r = Math.round(Math.random()*255);
            g = Math.round(Math.random()*255);
            b = Math.round(Math.random()*255);
            arrBackround.push('rgba('+r+','+g+','+b+', 0.2)');
            arrBorder.push('rgba('+r+','+g+','+b+', 1)');
            <?php
        }
    ?>

    let myChart = new Chart(ch, {
        type: 'line',
        data: {
            labels: arrTanggal,
            datasets: [{
                label: 'Total Income',
                data: arrJmlhTopup,
                backgroundColor: arrBackround,
                borderColor: arrBorder,
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>