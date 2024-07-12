<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-nav-right.css">
</head>
<body>

<center>
<div class="cajon_user">
    <?php
        echo Vista::verUsuarios();
    ?>
</div>
</center>
<button onclick="recargar()">Recargar Estado Del Usuario</button>
<button> <a href="admin.php?seccion=admin_home">volver</a> </button>
    
</body>
</html>


