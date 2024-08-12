<link rel="stylesheet" href="../../css/historial_u.css">
<?php $historial = Historial::verHistorial($_SESSION['id']); ?>
<br>
<div class="btn-container">
    <a href="admin.php?seccion=perfil"><button>Regresar</button></a>
<?php if($historial !=0):?>
    <button onclick="vaciarHistorial()">Vaciar historial</button>
<?php endif;?>
</div>
    <br><br>
<p id="texto-historial"></p>
<div class="historial" id="historial-contenedor">
    <?php if($historial == 0):?>
        <div class="col-12">
            <center><p>Ve productos para ampliar tu historial</p></center>
        </div> 
        <?php else:
            echo $historial;
        endif;?>
</div>


