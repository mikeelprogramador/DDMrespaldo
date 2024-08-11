<link rel="stylesheet" href="../../css/card.css">
<div class="ofertas-contenedro" id="ofertas-contenedor">
    <?php $verOfertas =  Vista::mostrarProductos(3);
        if($verOfertas === 0){
           ?><p>No hay ofertas</p><?php 
        }else{
            echo $verOfertas;
        }
    ?>
</div>