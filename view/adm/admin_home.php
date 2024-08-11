<link rel="stylesheet" href="../../css/card.css">
  <div class="productos">
    <p class="texto">
    <br>
    <div class="subContainer" id="subContainer">
        <?php
          $productos = Vista::mostrarProductos(1);
          if($productos === 0){
            echo "No hay productos";
          }else{
            echo $productos;
          }
        ?>
    </div>
    </p> 
  </div>

