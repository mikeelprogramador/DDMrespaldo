<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <link rel="stylesheet" href="../../css/comentarios.css">
</head>
<body>

    <main>
        <button><a href="ddm.php?seccion=perfil">Regresar</a></button>
        <br><br>
        
        <?php
        $comentarios = Comentarios::verComentariosUsuario(1, $_SESSION['id']);
        $respuestas = Comentarios::verComentariosUsuario(2, $_SESSION['id']);
        if ($comentarios === 0 && $respuestas === 0) {
            echo "<p>No has realizado ningún comentario</p>";
        } else {
            echo "<div class='comentarios-section'>";
            if ($comentarios !== 0) {
                echo $comentarios;
            }
            if ($respuestas !== 0) {
                echo $respuestas;
            }
            echo "</div>";
        }
        ?>
    </main>

    
</body>
</html>
