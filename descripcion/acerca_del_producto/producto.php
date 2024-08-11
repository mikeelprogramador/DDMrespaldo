<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Producto</title>
    <link rel="stylesheet" href="../../css/stylo6.css">  
</head>
<body>
    <br><br>
    <div class="producto-contenedor">
        <div class="producto-refe">
            <?php
                // Asegúrate de que las clases id y Vista estén incluidas correctamente
                $id = id::desencriptar($_GET['data']);
                echo Vista::ContenidoProducto($id, $_SESSION['token']);
            ?>
            <hr>
        </div>
        <div class="comentarios">
            <a href="<?php echo (Usuarios::verificarPerfil(1, $_SESSION['id']) == 2 ? '../../view/user/ddm.php' : '../../view/adm/admin.php'); ?>">
                <button class="btn-regresar">Regresar</button>
            </a>
            <br><br>
            <form onsubmit="apareceComentario(event, '<?php echo $_GET['data']; ?>')" class="comentario-form">
                <input type="text" id="comentario" placeholder="Escribe tu comentario..." required>
                <input type="submit" value="Enviar">
            </form>
            <label for="coment" id="caja">Cajas de comentarios</label>
            <br><br>
            <p id="respuesta-comet"></p>
            <div id="coment">
                <?php
                    // Asegúrate de que la clase Comentarios esté correctamente incluida y funcional
                    echo Comentarios::verComentarios($id, $_SESSION['id']);
                ?>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../../js/sweetalert.js"></script>
    <script src="../../js/coment.js"></script>
    <script src="../../js/alert.js"></script>
    <script src="../../js/captcha.js"></script>
    <script src="../../js/texto.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js" integrity="sha512-4F1cxYdMiAW98oomSLaygEwmCnIP38pb4Kx70yQYqRwLVCs3DbRumfBq82T08g/4LJ/smbFGFpmeFlQgoDccgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
