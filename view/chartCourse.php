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
<div class="content1 hurufBesar tulisanPutih">Average Courses Achievements</div>
<div class="chartReport" style="background-color: white;">
    <canvas id="myChart"></canvas>
</div>
<a href="reportCourse" id="back">Back</a>
<div style="height:50px;"></div>

<script defer>
    let ch = document.getElementById('myChart').getContext('2d');
    let arrCourse = [];
    let arrAvgNilai = [];
    let r,g,b;
    let arrBackround = [];
    let arrBorder = [];

    <?php
        foreach ($result as $key => $value) {
            ?>
            arrCourse.push('<?php echo $value['nama_course']?>');
            arrAvgNilai.push('<?php echo $value['rata2']?>');
            r = Math.round(Math.random()*255);
            g = Math.round(Math.random()*255);
            b = Math.round(Math.random()*255);
            arrBackround.push('rgba('+r+','+g+','+b+', 0.2)');
            arrBorder.push('rgba('+r+','+g+','+b+', 1)');
            <?php
        }
    ?>

    let myChart = new Chart(ch, {
        type: 'bar',
        data: {
            labels: arrCourse,
            datasets: [{
                label: 'Average Score',
                data: arrAvgNilai,
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