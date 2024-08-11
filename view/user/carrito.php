<link rel="stylesheet" href="../../css/style-carrito.css">
<div class="container" >
    <?php 
    $carrito = Vista::mostrarCarrito(1, $_SESSION['id']);
    if ($carrito == "0") :?>
        <div class="col-12">
            <p>No tienes productos en el carrito.</p>
        </div>
    <?php else : 
        ?>
        <div class="carrito" id="carrito">
            <?php echo $carrito; ?>
        </div>
        <div class="totales">
            <h3>Total:</h3>
            <div class="dinero" id="dinero">
                
                <?php echo Funciones::strDinero(Carrito::dinero(1, $_SESSION['id'])); ?>
               
            </div>
            
            <a class="btn-comprar" href="../../descripcion/shopping/compras.php?seccion=ubicacion&http=<?php echo $_SESSION['token']; ?>&estado=compraMax">Comprar todo</a>
        </div>
    <?php endif;?>   
</div>
