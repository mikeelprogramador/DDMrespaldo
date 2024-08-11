<link rel="stylesheet" href="../../css/card.css">
<div class="container mt-5">
    <h1 class="mb-4">Gestión de Ofertas</h1>

    <!-- Formulario para Crear una Oferta -->
    <div class="card mb-4">
        <div class="card-header">
            Crear Oferta
        </div>
        <div class="card-body">
        <p id="text-cretae-offer"></p>
            <form id="create-form" onsubmit="crearOfertas(event)">
                <div class="form-group">
                    <label for="offer-name">Nombre de la Oferta</label>
                    <input type="text" class="form-control" id="offer-name" multiple list="list-offer-name" size="64" placeholder="Ingrese el nombre de la oferta" required>
                    <datalist id="list-offer-name" >
                        <?php echo Ofertas::verOfertas(1); ?>
                    </datalist>
                </div><br>
                <button type="submit" class="btn btn-primary">Crear Oferta</button>
            </form>
        </div>
    </div>


    <!-- Formulario para Actualizar una Oferta -->
    <div class="card mb-4">
        <div class="card-header">
            Actualizar Oferta
        </div>
        <div class="card-body">
            <form id="update-form"  onsubmit="actualizarOferta(event)">
                <p id="text-update-offer"></p>
                <div class="form-group">
                    <label for="update-id">Oferta</label>
                    <input type="text" class="form-control" id="update-name" multiple list="list-update-name"  size="64" placeholder="Ingresa el nombre para buscar la oferta" required oninput="buscarCodigo(event)">
                    <datalist id="list-update-name">
                    <?php echo Ofertas::verOfertas(1); ?>
                    </datalist>
                </div><br>
                <div class="form-group">
                    <label for="update-name">Codigo oferta</label>
                    <input type="text" class="form-control" id="update-id" placeholder="Codigo de la oferta seleccionada" required disabled >
                </div><br>
                <div class="form-group">
                    <label for="update-name">Nuevo nombre para la Oferta</label>
                    <input type="text" class="form-control" id="update-name-new" placeholder="El nuevo nombre que se le asignara a la oferta" required>
                </div><br>
                <button type="submit" class="btn btn-primary">Actualizar Oferta</button>
            </form>
        </div>
    </div>

    <!-- Formulario para Eliminar una Oferta -->
    <div class="card mb-4">
        <div class="card-header">
            Eliminar Oferta
        </div>
        <div class="card-body">
            <form id="delete-form" onsubmit="eliminarOFerta(event)">
                <p id="text-delete-offer"></p>
                <div class="form-group">
                    <label for="delete-offer">Oferta</label>
                    <input type="text" class="form-control" id="delete-offer" multiple list="list-delete-offer" placeholder="Ingrese la oferta ha eliminar" required>
                    <datalist id="list-delete-offer">
                        <?php echo Ofertas::verOfertas(1); ?>
                    </datalist>
                </div><br>
                <button type="submit" class="btn btn-danger">Eliminar Oferta</button>
            </form>
        </div>
    </div>
</div>