<?php
session_start();
include_once("../class/class_vista.php");
include_once("../class/class_factura.php");
include_once("../class/class_encript.php");
$id = id::desencriptar($_GET['code']);
$can = Vista::factura(9,$_SESSION['id'],$id,'total');
$total =Vista::factura(12,$_SESSION['id'],$id,'total');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="../css/styleFactura.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="body">

<!-- Contenedor para ingresar correo -->
<div class="container">
    <br>
    <!-- Subcontendor  -->
    <div class="subcontainer">
        <!-- Texto centrado -->
        <center>
            <br><br>
            <!-- Contenedor para Factura -->
            <div class="factura">
                <!-- Fila #1 -->
                <div class="row">
                    <!-- Columna #1 -->
                    <!-- <div class="col-md"><img src="../img/imagen3.png" alt="" height="120px"></div> -->
                    <div class="col-md"><img src="http.//localhost/DDM/img/imagen3.png" alt="" height="120px"></div>
                    <!-- Columna #2 -->
                    <div class="col-md">
                        <ul>
                            <li><h5>DDM</h5></li>
                            <li><b>Venta de productos</b></li>
                            <li>San José del Guaviare</li>
                        </ul>
                    </div>
                    <!-- Columa #3 -->
                    <div id="colorAmarillo" class="col-md">
                        <center>
                            <ul>
                                <li>R.U.T.85.898.88</li>
                                <li>Factura Electónica</li>
                                <li>N°<?php  echo Vista::factura(1,$_SESSION['id'],$id); ?></li>
                            </ul>
                        </center>
                    </div>
                </div>
                <br>
                <!-- Fila #2 primera Fila -->
                <div id="Filas" class="row">
                    <div class="col-md"><b>Fecha: </b><?php echo Vista::factura(2,$_SESSION['id'],$id); ?></div>
                    <div class="col-md"><b>Código Compra:  </b> <?php  echo Vista::factura(1,$_SESSION['id'],$id); ?></div>
                    <!-- Fila #2 segunda Fila -->
                    <div class="row">
                        <div class="col-md"><b>Comprador: </b><?php echo Vista::factura(3,$_SESSION['id'],$id); ?> <?php echo Vista::factura(4,$_SESSION['id'],$id); ?></div>
                        <div class="col-md">R.U.T 58.898.88</div>
                    </div>
                    <!-- Fila #2 tercera Fila -->
                    <div class="row">
                        <div class="col-md"><b>Giro: </b>Importadora</div>
                        <div class="col-md"><b>Comuna: </b>RM (Metropolitana)</div>
                    </div>
                    <!-- Fila #2 cuerta Fila -->
                    <div class="row">
                        <div class="col-md"><b>Dirección: <?php echo Vista::factura(7,$_SESSION['id'],$id) ?> Barrio <?php echo Vista::factura(8,$_SESSION['id'],$id) ?> </b></div>
                        <div class="col-md"><b>Condicion de la compra:</b></div>
                    </div>
                    <!-- Fila #2 quinta Fila -->
                    <div class="row">
                        <div class="col-md"><b>Ciudad: <?php echo Vista::factura(5,$_SESSION['id'],$id); ?> </b></div>
                        <div class="col-md"><b>Correo: <?php echo Vista::factura(6,$_SESSION['id'],$id); ?></b></div>
                    </div>
                </div>
                <p class="p">Por lo siguiente:</p>
                <!-- Fila #3 -->
                <div id="Filas" class="row">
                    <!-- Columna #1 -->
                    <div id="columna" class="col-md">
                        <b>CANTIDAD</b>
                        <!-- Fila de la columna #1 -->
                        <div id="columna1" class="row"><center><?php  echo Vista::factura(9,$_SESSION['id'],$id); ?></center></div>
                    </div>
                    <!-- Columna #2 -->
                    <div id="columna" class="col-md">
                        <b>ARTICULO</b>
                        <!-- Fila de la columna #1 -->
                        <div id="columna1" class="row"><center><?php  echo Vista::factura(10,$_SESSION['id'],$id); ?></center></div>
                    </div>
                    <!-- Columna #3 -->
                    <div id="columna" class="col-md">
                        <b>PRECIO UNITARIO</b>
                        <!-- Fila de la columna #1 -->
                        <div id="columna1" class="row"><center><?php  echo Facturas::valorUnitario($can,$total);   ?></center></div>
                    </div>
                    <!-- Columna #4 -->
                    <div id="columna" class="col-md">
                        <b>SUB-TOTAL</b>
                        <!-- Fila de la columna #1 -->
                        <div id="columna1" class="row"><center><?php echo Vista::factura(12,$_SESSION['id'],$id)  ?></center></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <b>TOTAL FACTURA : <?php echo Facturas::totalFactura( Vista::factura(12,$_SESSION['id'],$id,'total')); ?></b>
                        </div>
                    </div>
                </div>
                <div class="firma-md">
                    <div class="row"><b>Nombres: <?php echo Vista::factura(3,$_SESSION['id'],$id); ?> <?php echo Vista::factura(4,$_SESSION['id'],$id); ?> </b></div><br>
                    <div class="row"><b>R.U.T: 58.898.88</b></div>
                    <div class="row"><b>Fecha: <?php echo Vista::factura(2,$_SESSION['id'],$id); ?></b></div>
                    <div class="row"><b>Recinto: San José del Guaviare</b></div>
                    <hr>
                    <br>
                </div>
                <br><br>
                <?php if(isset($_GET['ContinuarCompra'])) :?>
                    <button><a href="#">siguiente</a></button>
                <?php endif;
                if(isset($_GET['verfactura'])) :?>
                    <button><a href="../view/user/ddm.php?seccion=compras">Regresar</a></button>
                <?php endif; ?>

            </div>         
        </center>
        <br>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php
