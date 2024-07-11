<?php
if( isset($_GET['men'])){
  if( $_GET['men'] == "-1error" || $_GET['men'] == "0error" ){
    ?><script> 
    window.onload = function() {
    verificacion('<?php echo $_GET['men']; ?>');
    };
    </script><?php
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
      <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-05CZXNWMZE"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-05CZXNWMZE');
    </script> 

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" href="css/stylo3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="body">
    
  <div class="container">
        <h2 style="color: #9e7a40;">Registro</h2>
        <form action="verificacion.php?log=0" method="post" onsubmit="return validateForm()">
            <input type="text" name="nom" placeholder="Ingrese tu nombre" required>
            <input type="text" name="apellido" placeholder="Apellido" required>
            <input type="text" name="email" placeholder="Correo" required>
            <div class="clave">
                <input type="password" id="clave" name="clave" placeholder="Contraseña" required>
                <img id="toggle-password" class="toggle-password" src="img/ojo1.png" alt="Mostrar contraseña">
            </div>
            <div class="clave">
                <input type="password" id="confirm_clave" name="confirm_clave" placeholder="Confirmar Contraseña" required>
                <img id="toggle-confirm-password" class="toggle-password" src="img/ojo1.png" alt="Mostrar contraseña">
            </div>
            <div id="error" class="error"></div>
            <input type="submit" name="enviar" value="Finalizar Registro">
        </form>
        <center><p>¿Ya te has registrado?
          Inicia sesión por favor
        </p></center>
        <a href="login.php" style="color: #9e7a40; text-decoration: none;">Iniciar sesión</a>
    </div>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Conexión del script. -->
<script src="js/contra_registro.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/contra.js"></script>
</body>
</html>