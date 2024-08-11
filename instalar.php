<link rel="stylesheet" href="css/instalar.css">
<body>
    
    <form action="instalador.php" method="get">
    <center><img src="img/Imagen3.png" alt=""></center>
        <p>Ingresa los datos para la instalación correcta de la base de datos</p>
        <p>Si ya tienes la base de datos, elimina el archivo instalador.php</p>

        <label for="servidor">Servidor</label>
        <input type="text" name="servidor" id="servidor">

        <label for="usuario">Usuario</label>
        <input type="text" name="root" id="usuario">

        <label for="clave">Contraseña</label>
        <input type="text" name="clave" id="clave">

        <input type="submit" value="Instalar">
    </form>
</body>

