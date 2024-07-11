<style>


    </style>
<div class="container">
        <div class="carrito" id="carrito">
            <?php echo Vista::mostrarCarrito(1, $_SESSION['id']); ?>
        </div>
        <div class="dinero" id="dinero">
            <?php echo number_format(Carrito::dinero(1, $_SESSION['id']), 2, ',', '.'); ?>
        </div>
        <a href="../../descripcion/shopping/compras.php?seccion=ubicacion&http=<?php echo $_SESSION['token']; ?>&estado=compraMax">Comprar todo</a>
    </div>
    <script src="scripts.js"></script> <!-- Link to your JavaScript file -->
</body>