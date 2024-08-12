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
    <title>Terminos y condiciones</title>
    <link rel="stylesheet" href="css/terminos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="body">
  <div class="container">
    
    <h1>Términos y Condiciones de Uso</h1>
    <center><img src="img/Imagen3.png" alt="Logo"></center>
    <hr>

    <p>Última actualización: 8/07/2024</p>

    <h2>1. Introducción</h2>

    <p>Bienvenido a nuestro sitio web. Estos términos
         y condiciones rigen tu uso de este sitio web; al 
         usar este sitio web, aceptas estos términos y condiciones
          en su totalidad. Si no estás de acuerdo con estos términos 
          y condiciones o cualquier parte de estos términos y condiciones, 
          no debes usar este sitio web.</p>

    <h3>2. Uso del Sitio Web</h3>

    <p>El uso de este sitio web está sujeto a las siguientes condiciones:</p>

    <ul>
        <li>La información del sitio web es solo para orientación general y 
            no constituye asesoramiento profesional o específico.</li>
        <li>Estás de acuerdo en no usar este sitio web de manera que pueda causar 
            daño al sitio web o afectar la disponibilidad o accesibilidad del sitio web.</li>
        <li>Este sitio web utiliza cookies para monitorear las preferencias de navegación.</li>
        <li>La transmisión de datos en Internet puede estar sujeta a interrupciones; 
            no podemos garantizar la seguridad de los datos transmitidos a través de Internet.</li>
    </ul>

    <h3>3. Política de Privacidad</h3>

    <p>Nuestra política de privacidad detalla cómo manejamos los datos
         personales que recopilamos de los usuarios de este sitio web.
          Al utilizar este sitio web, aceptas el uso de tus datos personales
           de acuerdo con nuestra política de privacidad.</p>

    <h3>4. Propiedad Intelectual</h3>

    <p>Los derechos de propiedad intelectual en este sitio web y los
         materiales contenidos en este sitio web son propiedad de 
         nosotros o nuestros licenciatarios. Todos estos derechos están reservados.</p>

    <h3>5. Ley Aplicable y Jurisdicción</h3>

    <p>Estos términos y condiciones se regirán e interpretarán de
         acuerdo con las leyes de <b>Colombia.</b> Cualquier disputa relacionada 
         con estos términos y condiciones estará sujeta a la jurisdicción 
         exclusiva de los tribunales de <b>Colombia.</b></p>

    <p>Si tienes alguna pregunta sobre estos términos y condiciones, por favor .</p>
    <b>Contáctanos:<br>
    Correo: maicolsanchez211@gmail.com <br>
    Teléfono: +57 3185049904 <br>

    Contáctanos:<br> 
    Correo: judacas135@gmail.com <br>
    Teléfono: +57 3219612850</b> <br><br>

    <p>Fecha de la última actualización: 8/07/2024</p>
    <?php if(isset($_GET['verterminos'])):?>
      <a href="check-in.php">Regresar</a>
    <?php endif ?>
</div>
    
 
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- Conexión del script. -->
<script src="js/contra_registro.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/captcha.js"></script>
</body>
</html>

