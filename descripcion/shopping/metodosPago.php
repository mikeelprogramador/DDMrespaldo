<link rel="stylesheet" href="../../css/style-pago.css">
<?php 
if(!isset($_GET['pagoPor'])){
    header("location: ../../error.php");
}

if($_GET['pagoPor'] == "efectivo") :?>
    <div class="pago-contenedor">
        <p>Codigo de pago</p>
        <input type="text" value="1233444" disabled required>
        <a href="../../view/controller/controller_compra.php?estado=comprando&identific=<?php echo $_GET['estado']?><?php if(isset($_GET['data'])) echo "&data=".$_GET['data']?>" class="btn-comprar">Comprar</a><br>
        <a href="compras.php?seccion=informacion&http=<?php echo $_SESSION['token'] ?><?php if(isset($_GET['data'])) echo "&data=".$_GET['data']?>&estado=<?php echo $_GET['estado']?>" class="btn-regresar">Regresar</a>
    </div>
<?php endif;

if($_GET['pagoPor'] == "credito") :?>
    <div class="pago-contenedor">
        <p>Ingresa una targeta de 8 digitos valida para continuar</p>
        <input type="text" placeholder="Ingresa targeta de credito" oninput="targeta(event,'credito')" >
        <a href="../../view/controller/controller_compra.php?estado=comprando&identific=<?php echo $_GET['estado']?><?php if(isset($_GET['data'])) echo "&data=".$_GET['data']?>" class="btn-comprar" style = 'display:none;' id="credito">Comprar</a><br>
        <a href="compras.php?seccion=informacion&http=<?php echo $_SESSION['token'] ?><?php if(isset($_GET['data'])) echo "&data=".$_GET['data']?>&estado=<?php echo $_GET['estado']?>" class="btn-regresar" >Regresar</a>
    </div>
<?php endif;

if($_GET['pagoPor'] == "debito") :?>
    <div class="pago-contenedor">
        <p>Ingresa una targeta de 8 digitos valida para continuar</p>
        <select>
            <option value="" disabled selected>Cuotas</option>
            <option value="">3 meses</option>
            <option value="">6 meses</option>
            <option value="">9 meses</option>
            <option value="">12 meses</option>
        </select>
        <input type="text" placeholder="Ingresa targeta de débito" oninput="targeta(event,'debito')" >
        <a href="../../view/controller/controller_compra.php?estado=comprando&identific=<?php echo $_GET['estado']?><?php if(isset($_GET['data'])) echo "&data=".$_GET['data']?>" class="btn-comprar" style = 'display:none;' id="debito">Comprar</a><br>
        <a href="compras.php?seccion=informacion&http=<?php echo $_SESSION['token'] ?><?php if(isset($_GET['data'])) echo "&data=".$_GET['data']?>&estado=<?php echo $_GET['estado']?>" class="btn-regresar" >Regresar</a>
    </div>
<?php endif;?>

<script src="../../js/compra.js"></script>