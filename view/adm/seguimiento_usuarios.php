
<link rel="stylesheet" href="../../css/custom.css"> <!-- Nuevo archivo CSS para estilos adicionales -->
<div class="content">
    <center>
    <div class="container mt-4">
        <div class="content">
            <!-- Aquí se inserta el contenido generado por PHP -->
            <?php echo Vista::verUsuarios(); ?>
        </div>
    </div>
    </center>
    <div class="button-container">
        <button onclick="recargar()">Recargar Estado Del Usuario</button>
        <button><a href="admin.php?seccion=admin_home">Volver</a></button>
    </div>
</div>

