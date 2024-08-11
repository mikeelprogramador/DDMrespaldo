<?php
include_once("class/class_sessiones.php");

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
  <title>DDM_Recuperar cuenta</title>
  <link rel="stylesheet" href="css/contraseña.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    if(isset($_GET['datause'])){
    ?>
        <form action="view/controller/controller_login.php?cambioPasswprd&datause=<?php echo $_GET['datause']?>" method="post">
        <label for="">Contraseña actual</label>
        <input type="password" name="passwordActual" id="passwordActual" placeholder="Ingresa la contraseña actual">
        <label for="">Nueva contraseña</label>
        <input type="password" name="passwordNueva" id="passwordnuevo" placeholder="Ingresa la nueva contraseña">
        <label for="">Escribe nuevamente la contraseña</label>
        <input type="password" id="repetPassword" placeholder="Ingresa la nueva contraseña">
        <input type="submit">
        </form>
    <?php
        }
    ?>
    <?php
    if(isset($_GET['recuperarContraseña'])){
    ?>
    <div class="save-passwrd">
    <img src="img/Imagen3.png" alt="Logo">
    <hr>
        <p><h4>A continuacion enviaremos un correo para recuperar su contraseñe</h4></p>
        
        <p class="dato" id="dato"></p>
        <form action="../controller/controller_login.php?saveDato" method="post" onsubmit="enviarCorreo(event,2)">
        <label for="">Por favor digite su Correo</label>
        <input type="text" id="correo" name="correo" placeholder="email@gmail.com" required> 
        <input type="submit">
        </form>
        <a href="login.php">Regresar</a>
    </div>
    <?php
        }
    ?>
    


</body>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Conexión del script. -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script src="js/user.js"></script>
<script src="js/correo.js"></script>
<script src="js/texto.js"></script>
</body>
</html>