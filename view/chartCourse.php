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

<div class="chartReport" style="background-color: white;">
    <canvas id="myChart"></canvas>
</div>
<a href="reportCourse" id="back">Back</a>
<div style="height:50px;"></div>

<script defer>
    let ch = document.getElementById('myChart').getContext('2d');
    let arrCourse = [];
    let arrMember = [];

    <?php
        foreach ($result as $key => $value) {
            ?>
            arrCourse.push(<?php echo $value[0]?>);
            arrMember.push(<?php echo $value[1]?>);
            <?php
        }
    ?>

    let myChart = new Chart(ch, {
    type: 'bar',
    data: {
        labels: arrCourse,
        datasets: [{
            label: 'Courses Member Report',
            data: arrMember,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
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