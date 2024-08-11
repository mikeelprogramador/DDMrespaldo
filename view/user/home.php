<link rel="stylesheet" href="../../css/card.css">
<br>
  <div class="subContainer" id="homeProductos">
    <?php
      $productos = Vista::mostrarProductos(1);
      if($productos === 0){
        echo "No hay productos";
      }else{
        echo $productos;
      }
    ?>
  </div>

