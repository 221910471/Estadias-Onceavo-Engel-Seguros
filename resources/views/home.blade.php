<?php
    $sessionUsuario = session('sessionUsuario');
    $sessionTipo = session('sessionTipo');
    $sessionId = session('sessionId');

    require_once('../connection.php');
?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Administrador</title>
    <link rel="stylesheet" href="css/login.css">
    
</head>
<body>
    @include('layouts.navbar')
    <br><br>
    <h2>Bienvenido 
        <?php
            echo $sessionUsuario;
        ?>
    </h2>
    <center>
        <div class="areaGraphics">
            <canvas id="myChart"></canvas>
        </div>
        <br><br>
        <div class="areaGraphics">
            <canvas id="myChart2"></canvas>
        </div>
        <br><br>
    </center>
    
    <br>
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php
                    $sql = "SELECT * FROM usuarios";
                    $result = mysqli_query($connection,$sql);
                    while ($registros = mysqli_fetch_array($result))
                    {
                    ?>
                        '<?php echo $registros["created_at"] ?>',
                    <?php
                    }
                    ?>
                ],
                datasets: [{
                    label: 'USUARIOS',
                    data: [<?php
                            $sql2 = "SELECT * FROM usuarios";
                            $result2 = mysqli_query($connection,$sql2);
                            while ($registros2 = mysqli_fetch_array($result2))
                            {
                            ?>
                                '<?php echo $registros2["id"] ?>',
                            <?php
                            }
                            ?>],
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
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        // max: 1
                    }
                    
                }
            }
        });
        </script>

<script>
        const ctx2 = document.getElementById('myChart2').getContext('2d');
        const myChart2 = new Chart(ctx2, {
            type: 'bar',
            // type: 'line',
            // type: 'polarArea',
            data: {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                datasets: [{
                    label: 'Ventas por mes',
                    data: [<?php
                            $currentYear = date('Y');

                            $sqlJanuary = "SELECT * FROM ventas WHERE MONTH(fecha)=01 AND YEAR(fecha)=$currentYear";
                            $resultJanuary = mysqli_query($connection,$sqlJanuary);
                            $results1 = $resultJanuary->num_rows;

                            $sqlFebruary = "SELECT * FROM ventas WHERE MONTH(fecha)=02 AND YEAR(fecha)=$currentYear";
                            $resultFebruary = mysqli_query($connection,$sqlFebruary);
                            $results2 = $resultFebruary->num_rows;

                            $sqlMarch = "SELECT * FROM ventas WHERE MONTH(fecha)=03 AND YEAR(fecha)=$currentYear";
                            $resultMarch = mysqli_query($connection,$sqlMarch);
                            $results3 = $resultMarch->num_rows;

                            $sqlApril = "SELECT * FROM ventas WHERE MONTH(fecha)=04 AND YEAR(fecha)=$currentYear";
                            $resultApril = mysqli_query($connection,$sqlApril);
                            $results4 = $resultApril->num_rows;

                            $sqlMay = "SELECT * FROM ventas WHERE MONTH(fecha)=05 AND YEAR(fecha)=$currentYear";
                            $resultMay = mysqli_query($connection,$sqlMay);
                            $results5 = $resultMay->num_rows;

                            $sqlJune = "SELECT * FROM ventas WHERE MONTH(fecha)=06 AND YEAR(fecha)=$currentYear";
                            $resultJune = mysqli_query($connection,$sqlJune);
                            $results6 = $resultJune->num_rows;

                            $sqlJuly = "SELECT * FROM ventas WHERE MONTH(fecha)=07 AND YEAR(fecha)=$currentYear";
                            $resultJuly = mysqli_query($connection,$sqlJuly);
                            $results7 = $resultJuly->num_rows;

                            $sqlAugust = "SELECT * FROM ventas WHERE MONTH(fecha)=08 AND YEAR(fecha)=$currentYear";
                            $resultAugust = mysqli_query($connection,$sqlAugust);
                            $results8 = $resultAugust->num_rows;

                            $sqlSeptember = "SELECT * FROM ventas WHERE MONTH(fecha)=09 AND YEAR(fecha)=$currentYear";
                            $resultSeptember = mysqli_query($connection,$sqlSeptember);
                            $results9 = $resultSeptember->num_rows;

                            $sqlOctober = "SELECT * FROM ventas WHERE MONTH(fecha)=10 AND YEAR(fecha)=$currentYear";
                            $resultOctober = mysqli_query($connection,$sqlOctober);
                            $results10 = $resultOctober->num_rows;

                            $sqlNovember = "SELECT * FROM ventas WHERE MONTH(fecha)=11 AND YEAR(fecha)=$currentYear";
                            $resultNovember = mysqli_query($connection,$sqlNovember);
                            $results11 = $resultNovember->num_rows;

                            $sqlDecember = "SELECT * FROM ventas WHERE MONTH(fecha)=12 AND YEAR(fecha)=$currentYear";
                            $resultDecember = mysqli_query($connection,$sqlDecember);
                            $results12 = $resultDecember->num_rows;
                            
                            
                            ?>
                            '<?php echo $results1 ?>',
                            '<?php echo $results2 ?>',
                            '<?php echo $results3 ?>',
                            '<?php echo $results4 ?>',
                            '<?php echo $results5 ?>',
                            '<?php echo $results6 ?>',
                            '<?php echo $results7 ?>',
                            '<?php echo $results8 ?>',
                            '<?php echo $results9 ?>',
                            '<?php echo $results10 ?>',
                            '<?php echo $results11 ?>',
                            '<?php echo $results12 ?>',
                        ],
                    backgroundColor: [
                        // 'rgba(255, 99, 132, 0.2)',
                        // 'rgba(54, 162, 235, 0.2)',
                        // 'rgba(255, 206, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)'
                        'rgba(15, 12, 103, 0.2)',
                        'rgba(155, 189, 73, 0.2)',
                        'rgba(245, 194, 43, 0.2)',
                        'rgba(38, 101, 147, 0.2)',
                        'rgba(111, 106, 184, 0.2)',
                        'rgba(151, 58, 142, 0.2)'
                    ],
                    borderColor: [
                        // 'rgba(255, 99, 132, 1)',
                        // 'rgba(54, 162, 235, 1)',
                        // 'rgba(255, 206, 86, 1)',
                        // 'rgba(75, 192, 192, 1)',
                        // 'rgba(153, 102, 255, 1)',
                        // 'rgba(255, 159, 64, 1)'
                        'rgba(15, 12, 103, 1)',
                        'rgba(155, 189, 73, 1)',
                        'rgba(245, 194, 43, 01',
                        'rgba(38, 101, 147, 1)',
                        'rgba(111, 106, 184, 1)',
                        'rgba(151, 58, 142, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        // max: 1
                    }
                    
                }
            }
        });
        </script>


    


</body>
</html>