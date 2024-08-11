<link rel="stylesheet" href="../../css/card.css">
<?php
  $productos = Vista::mostrarProductos(2,'',$_GET['cate']);
  if($productos == 0){
    ?>
      <p>No hay productos en esta categoria</p>
    <?php
  }else{
    ?><br>
    <!-- <div class="productos"> -->
      <!-- <p class="texto"> -->
      <br>
        <div class="subContainer" id="productosCategorias">
          <?php
            echo $productos;
          ?>
        </div>
      <!-- </p>  -->
    <!-- </div>--><?php
  }
?>

