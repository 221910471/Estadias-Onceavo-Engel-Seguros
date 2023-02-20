<?php
    $sessionUsuario = session('sessionUsuario');
    $sessionTipo = session('sessionTipo');
    $sessionId = session('sessionId');
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
            // echo $sessionTipo;
            // echo $sessionId;
        ?>
    </h2>
    <center>
        <div class="areaGraphics">
            <canvas id="myChart"></canvas>
        </div>
        <br><br>
    </center>
    
    <br>
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        //Primera Grafica
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
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
</body>
</html>