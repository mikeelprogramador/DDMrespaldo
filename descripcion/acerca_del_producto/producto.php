
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
            $id = id::desencriptar($_GET['data']);
            echo Vista::ContenidoProducto($id, $_SESSION['token']);
        ?>
        <hr>
    </div>
    <div class="comentarios">
        <a href="<?php echo (Verificaciones::verificarPerfil(1, $_SESSION['id']) == 2 ? '../../view/user/ddm.php' : '../../view/adm/admin.php'); ?>">
            <button class="btn-regresar">Regresar</button>
        </a>
        <br><br>
        <form onsubmit="apareceComentario(event, '<?php echo $_GET['data']; ?>')" class="comentario-form">
            <input type="text" id="comentario" placeholder="Escribe tu comentario..." required>
            <input type="submit" value="Enviar">
        </form>
        <label for="coment">Cajas de comentarios</label>
        <br><br>
        <div id="coment">
            <?php
                echo Vista::viewComentarios($id, $_SESSION['id']);
            ?>
        </div>
    </div>

</div>
</body>

<script src="../../js/coment.js"></script>
<script src="../../js/alert.js"></script>
<script src="../../js/contra.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  