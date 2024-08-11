<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="stylesheet" href="../../css/historial_u.css">
</head>
<body>
    <div class="btn-container">
        <a href="ddm.php?seccion=perfil"><button>Regresar</button></a>
        <button onclick="vaciarHistorial()">Vaciar historial</button>
    </div>
    <br><br>
    <p id="texto-historial"></p>
    <div class="historial" id="historial-contenedor">
        <?php
            $historial = Historial::verHistorial($_SESSION['id']);
            if($historial == 0){
                echo '<div class="col-12"><p>Ve productos para ampliar tu historial</p></div>';
            } else {
                echo $historial;
            }
        ?>
    </div>
    <script>
        function vaciarHistorial() {
            // Lógica para vaciar el historial
        }

        function deleteHistorial(id) {
            // Lógica para eliminar un elemento del historial
        }
    </script>
</body>
</html>
