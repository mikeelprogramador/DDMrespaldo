<link rel="stylesheet" href="../../css/stylo4.css">
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white" style="background-color: chocolate;">
                    Actualizar Producto
                </div>
                <div class="card-body">
                    <form action="../controller/controller_admin.php?producto=actualizar&data=<?php echo $_GET['data'];  ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre_pro" value="<?php echo (Productos::detallesDelProducto(1, id::desencriptar($_GET['data']))); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion_pro" value="<?php echo (Productos::detallesDelProducto(2, id::desencriptar($_GET['data']))); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="imagenes" class="form-label">Imágenes</label>
                            <br>
                            <img src="<?php echo Productos::detallesDelProducto(6, id::desencriptar($_GET['data'])); ?>" class="img-fluid mb-2" alt="No hay o no se cargó imagen">
                            <input type="file" class="form-control" id="imagenes" name="img_pro">
                        </div>
                        <div class="mb-3">
                            <label for="caracteristicas" class="form-label">Características</label>
                            <input type="text" class="form-control" id="caracteristicas" name="carac_pro" value="<?php echo (Productos::detallesDelProducto(3, id::desencriptar($_GET['data']))); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="colores" class="form-label">Colores</label>
                            <input type="text" class="form-control" id="colores" name="colores_por" value="<?php echo (Productos::detallesDelProducto(8, id::desencriptar($_GET['data']))); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cantidades" class="form-label">Cantidades</label>
                            <input type="number" class="form-control" id="cantidades" name="cantidad_pro" min=1 value="<?php echo (Productos::detallesDelProducto(4, id::desencriptar($_GET['data']))); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cantidades" class="form-label">Categorias</label>
                            <div class="categoria">
                                <?php
                                    echo Vista::mostrarCategorias(4,2,id::desencriptar($_GET['data']));
                                ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ofertas" class="form-label">Ofertas</label>
                            <select class="form-select" name="oferta">
                                <option disabled selected>Ofertas</option>
                            <?php echo Ofertas::verOfertas(2); ?>
                        </select>
                        </div>
                        <div class="mb-3">
                        <label for="cantidad-pro" class="form-label">Iva</label>
                        <select class="form-select" name="iva-pro" id="iva-pro">
                            <option value="" selected disabled>Selecciona el IVA</option>
                            <option value="0">0%</option>
                            <option value="5">5%</option>
                            <option value="15">15%</option>
                            <option value="19">19%</option>
                        </select>
                    </div>
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor del producto</label>
                            <input type="number" class="form-control" id="valor" name="precio_pro" value="<?php echo (Funciones::intDinero(Productos::detallesDelProducto(7, id::desencriptar($_GET['data'])))); ?>">
                        </div>
                        <button type="submit" name="actualizarProducto" value="#" class="btn btn-primary btn-block">Actualizar Producto</button>
                        <br> <a href="admin.php?seccion=seccion-ac-pro">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
