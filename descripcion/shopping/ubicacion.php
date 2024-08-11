<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $seccion ?></title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="direcciones">
        <form action="<?php echo $action ?>" method="post">
            <div class="departamentos">
                <label for="departamentos">Departamentos</label>
                <select name="departamentos" id="departamentos">
                    <option selected disabled>Departamentos</option>
                    <?php echo Vista::regiones(1); ?>
                </select>
            </div>
            <div class="municipios">
                <label for="municipios">Municipios</label>
                <select name="municipios" id="municipios">
                    <option selected disabled>Municipios</option>
                    <?php echo Vista::regiones(2); ?>
                </select>
            </div>
            <div class="tel">
                <label for="telefono">Teléfono</label>
                <input type="number" name="telefono" id="telefono" required>
            </div>
            <div class="email">
                <label for="email">Correo</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="barrio">
                <label for="barrio">Barrio</label>
                <input type="text" name="barrio" id="barrio" placeholder="Barrio .." required>
            </div>
            <div class="direccion">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" placeholder="Apartamento/Edificio/Calle .." required>
            </div>
            <input type="submit" value="Enviar">
        </form>
        <a href="<?php echo $_SESSION['url'] ?>" class="btn-regresar">Regresar</a>
    </div>
</body>
</html>
