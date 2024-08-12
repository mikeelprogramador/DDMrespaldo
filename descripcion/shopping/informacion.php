<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $seccion ?></title>
    <link rel="stylesheet" href="../../css/styles2.css">
</head>
<body>
    <center>
    <div class="container">
        <div class="metodos-de-pago">
            <div class="metodo efectivo" onclick="typeMoney(0,'<?php if(isset($_GET['data']))echo $_GET['data'] ?>','<?php echo $_GET['estado'] ?>')">
                <img src="../../img/efectivo.png" alt="Efectivo" class="icono"> Efectivo
            </div>
            <div class="metodo credito" onclick="typeMoney(2,'<?php if(isset($_GET['data']))echo $_GET['data'] ?>','<?php echo $_GET['estado'] ?>')">
                <img src="../../img/credito.png" alt="Crédito" class="icono"> Crédito
            </div>
            <div class="metodo debito" onclick="typeMoney(1,'<?php if(isset($_GET['data']))echo $_GET['data'] ?>','<?php echo $_GET['estado'] ?>')">
                <img src="../../img/debito.png" alt="Débito" class="icono"> Débito
            </div>
        </div>
        <div class="acciones">
            <a href="../../view/controller/controller_compra.php?compra=eliminar" class="btn cancelar">Cancelar Compra</a>
            <a href="<?php echo $url ?>" class="btn cambiar">Cambiar Dirección</a>
        </div>
    </div></center>

    <script src="../../js/compra.js"></script>
    <script src="../../js/captcha.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
