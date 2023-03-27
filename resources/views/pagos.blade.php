<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/crud.css">
</head>
<body>
    @include('layouts.navbar')
    <br>

    <h2>Pagos</h2>
    <div class="cardsNotification" id="vista">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($pagos as $pago)
                @foreach($usuarios as $usuario)
                    
                    @if($usuario->id == $pago->usuarioId)
                        @if($pago->frecuenciaDePago = "Mensual")
                            <?php
                                $fecha=date('Y-m-d');
                                $nueva_fecha = date('Y-m-d', strtotime('+2 month', strtotime($fecha))); // fecha con un mes agregado
                                // echo $nueva_fecha."mensual";
                            ?>
                            @else
                                @if($pago->frecuenciaDePago = "Bimestral")
                                <?php
                                    $fecha=date('Y-m-d');
                                    $nueva_fecha = date('Y-m-d', strtotime('+4 month', strtotime($fecha))); // fecha con un mes agregado
                                    // echo $nueva_fecha."Bimestral";
                                ?>
                                @else
                                    @if($pago->frecuenciaDePago = "Semestral")
                                    <?php
                                        $fecha=date('Y-m-d');
                                        $nueva_fecha = date('Y-m-d', strtotime('+1 year', strtotime($fecha))); // fecha con un mes agregado
                                        // echo $nueva_fecha."Semestral";
                                    ?>
                                    @else
                                        <?php
                                            $fecha=date('Y-m-d');
                                            $nueva_fecha = date('Y-m-d', strtotime('+2 year', strtotime($fecha))); // fecha con un mes agregado
                                            // echo $nueva_fecha."Anual";
                                        ?>
                                    @endif
                                @endif
                        @endif

                        @if($pago->fechaLimiteDePago < $nueva_fecha)
                            <div class="col">
                                <div class="card h-100">
                                    <img src="img/pago.jpg" class="card-img-top" alt="..." height="200px">

                                <div class="card-body">
                                    <h5 class="card-title">Estado: {{ $pago->estado }} </h5>
                                    <h6 class="card-title">Periodo del pago: {{ $pago->frecuenciaDePago}} </h6>
                                    <h6 class="card-title">Monto del pago $ {{ $pago->montoDePago }} MXN</h6>
                                    <p class="card-text">Le recordamos realizar el pago de su póliza registrada el {{ $pago->fechaDePago }} antes de la fecha límite.</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted"><em>Fecha límite de pago: {{ $pago->fechaLimiteDePago }}</em></small>
                                </div>
                                </div>
                            </div>
                        @endif
                            
                        
                        
                    @endif
                @endforeach
            @endforeach

        </div>
    </div>
    <div>{{ $pagos->links()}}</div>


    <br><br>

    @include('layouts.footer')

</body>
</html>