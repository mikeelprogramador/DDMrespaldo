
<link rel="stylesheet" href="../../css/style-compras.css">

<button><a href="ddm.php?seccion=perfil">Regresar</a></button>
<div class="compras">
    <?php
    echo Compras::verCompras($_SESSION['id']);
    ?>
</div>

