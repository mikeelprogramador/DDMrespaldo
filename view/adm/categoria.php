<link rel="stylesheet" href="../../css/card.css">
<div class="container mt-5">
    <h1 class="mb-4">Gestión de Categorias</h1>

    <!-- Formulario para Crear una categoria -->
    <div class="card mb-4">
        <div class="card-header">
            Crear Categoria
        </div>
        <div class="card-body">
        <p id="mensaje"></p>
            <form id="create-form" onsubmit="guardarCategoria(1,event)">
                <div class="form-group">
                    <label for="cate-name">Nombre de la Categoria</label>
                    <input type="text" class="form-control" id="text-catego" multiple list="list-cate-name" size="64" placeholder="Ingrese el nombre de la Categoria" required>
                    <datalist id="list-cate-name" >
                        <?php echo Vista::mostrarCategorias(3,1); ?>
                    </datalist>
                </div><br>
                <button type="submit" class="btn btn-primary">Crear Categoria</button>
            </form>
        </div>
    </div>


    <!-- Formulario para Actualizar una categoria -->
    <div class="card mb-4">
        <div class="card-header">
            Actualizar Categoria
        </div>
        <div class="card-body">
            <form id="update-form"  onsubmit="actualizarCategoria(event)">
                <p id="text-update-cate"></p>
                <div class="form-group">
                    <label for="update-id">Categorias</label>
                    <input type="text" class="form-control" id="update-cate" multiple list="list-update-cate"  size="64" placeholder="Ingresa el nombre para buscar la categoria" required>
                    <datalist id="list-update-cate">
                        <?php echo Vista::mostrarCategorias(3,1); ?>
                    </datalist>
                </div><br>
                <div class="form-group">
                    <label for="update-name">Nuevo nombre para la Categoria</label>
                    <input type="text" class="form-control" id="update-cate-new" placeholder="El nuevo nombre que se le asignara a la categoria" required>
                </div><br>
                <button type="submit" class="btn btn-primary">Actualizar Categoria</button>
            </form>
        </div>
    </div>

    <!-- Formulario para Eliminar una categoria -->
    <div class="card mb-4">
        <div class="card-header">
            Eliminar Categoria
        </div>
        <div class="card-body">
            <form id="delete-form" onsubmit="eliminarCategoria(event)">
                <p id="text-delete-cate"></p>
                <div class="form-group">
                    <label for="delete-cate">Categorias</label>
                    <input type="text" class="form-control" id="delete-cate" multiple list="list-delete-cate" placeholder="Ingrese la categoria ha eliminar" required>
                    <datalist id="list-delete-cate">
                        <?php echo Vista::mostrarCategorias(3,1); ?>
                    </datalist>
                </div><br>
                <button type="submit" class="btn btn-danger">Eliminar Categoria</button>
            </form>
        </div>
    </div>
</div>