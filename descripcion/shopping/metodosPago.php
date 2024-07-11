<link rel="stylesheet" href="../../css/style-pago.css">
<?php 
if(!isset($_GET['pagoPor'])){
    header("location: ../../erro.php");
}

if($_GET['pagoPor'] == "efectivo"){
?>
    <div class="pago-contenedor">
        <input type="text" value="1233444" disabled required>
        <a href="#" class="btn-generar-factura">Generar factura</a>
        <a href="secuencias.php?estado=comprando&identific=<?php echo $_GET['estado']?><?php if(isset($_GET['data'])) echo "&data=".$_GET['data']?>" class="btn-comprar">Comprar</a><br>
        <a href="compras.php?seccion=informacion&http=<?php echo $_SESSION['token'] ?><?php if(isset($_GET['data'])) echo "&data=".$_GET['data']?>&estado=<?php echo $_GET['estado']?>" class="btn-regresar">Regresar</a>
    </div>
<?php
}