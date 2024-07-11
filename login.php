<?php
if( !isset($_SESSION))session_start();
if( !isset($_SESSION['stop']))$_SESSION['stop'] = 0;
if(isset($_GET['men'])){
  if( $_GET['men'] == "error-1" || $_GET['men'] == "error-0" ){
    ?><script> 
    window.onload = function() {
    verificacion('<?php echo $_GET['men']; ?>');
    };</script><?php
    if($_SESSION['stop'] != 3)$_SESSION['stop'] += 1;
  }
}
if(isset($_GET['reset'])){
  $_SESSION['stop'] = 0;
  header("location: index.php");
}
 
if($_SESSION['stop'] > 2){
  ?><script> 
    window.onload = function() {
      document.getElementById('password').disabled = true;
      document.getElementById('botonEnviar').style.display = 'none';
      Recaptcha().then((salida) => {
        if(salida === true){
          document.getElementById('password').disabled = false;
          document.getElementById('botonEnviar').style.display = 'block';
          window.location.href = 'login.php?reset=';
        }
        
      });
    };</script><?php

}

?>

<!doctype html>
<html lang="es">
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
  <title>DDM inicio de sesion</title>
  <link rel="stylesheet" href="css/stylo2.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

  <body class="body">
  <div class="form-container">
        <h2>Inicio de Sesión</h2>
        <form action="verificacion.php?log=1" method="post">
          <input type="text" name="email" placeholder="Correo" required>
            <div style="position: relative;">
                <input type="password" id="password" name="clave" placeholder="Contraseña" required style="padding-right: 30px;">
                <img id="toggle-password" class="toggle-password" src="img/ojo1.png" alt="Mostrar contraseña" style="width: 10%;">
            </div>
            <br><br>
            <input type="submit" id="botonEnviar" name="enviar" value="Iniciar Sesión" >
        </form>
        <p>¿No te has registrado?</p>
        
      
        <a href="check-in.php">Registrar</a>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Conexión del script. -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/contra.js"></script>
</body>
</html>