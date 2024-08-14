<?php  
include_once("class_sessiones.php");
Session::iniciarSessiones();

class Funciones{

    public static function intDinero($dinero){
        $salida = str_replace(",","",$dinero);
        $salida = str_replace(".","",$salida);
        $salida = substr($salida,0,-2);
        $salida = intval($salida);
        return $salida;
    }
    public static function strDinero($dinero){
        $salida = number_format($dinero, 2, ',', '.');
        return $salida;
    }

    public static function iva($iva,$precio){
        $salida =floatval($iva)/100;
        $salida *= $precio ;
        $salida += $precio;
        return self::strDinero($salida);
    }


    public static function alertas($mensaje,$alerta){
      include_once("class_producto.php");
      if($alerta == 1)$function = "alertPro";
      if($alerta == 2)$function = "verificacion";
      if($alerta == 3)$function = "alertCarrito";
      $salida = "<script> ";
      $salida .= "window.onload = function() { ";
      $salida .= $function."('".$mensaje."'); ";
      $salida .= "}; ";
      $salida .= "</script>";
      return $salida;
  }

    public static function activarRecapchat(){
        $salida = "<script>";
        $salida .="window.onload = function() {";
        $salida .= "document.getElementById('clave').disabled = true;";
        $salida .= "document.getElementById('botonEnviar').style.display = 'none';";
        $salida .= "Recaptcha(1).then((salida) => {";
        $salida .= "if(salida === true){";
        $salida .= "document.getElementById('clave').disabled = false;";
        $salida .= "document.getElementById('botonEnviar').style.display = 'block';";
        $salida .= "window.location.href = 'login.php?reset=';";
        $salida .= "} });";
        $salida .= "};";
        $salida .= "</script>";
        return $salida;
    }

    public static function vacunaXxs($texto){
        $patron_xss = '/<\s*(script|img|iframe|frame|video|audio|embed|object|svg|javascript)\b[^>]*>.*?<\/\s*\1\s*>/i';
        //remplaza el script 
        $salida = preg_replace($patron_xss, '', $texto);
        //elimina el html
        $salida = strip_tags($salida);
        return $salida;
    }

    public static function htmlRecuperarContraseña($nombre,$id_user,$token){
        $url = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);
        $url = str_replace('\\', '/', $url);
        $url = str_replace('C:/xampp/htdocs/','http://localhost/',$url);
        $url = $url.' /../recuperacion.php?datause='.$id_user;
        $html = ' 
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Recuperacion de Clave</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #444;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin: 10px 0;
            line-height: 1.5;
        }
        .highlight {
            font-weight: bold;
            color: #c29349;
        }
        a {
            display: inline-block;
            font-size: 16px;
            padding: 12px 25px;
            margin-top: 20px;
            color: #ffffff;
            background-color: #c29349;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #a97732;
            color: #ffffff;
        }
        </style>
      </head>
      <body>
      <div class="container">
          <h1>Hola, '.$nombre.'</h1>
          <p>Has solicitado recuperar tu clave. Para completar el proceso, por favor haz clic en el enlace a continuacion para establecer una nueva clave.</p>
          <p class="highlight">Nueva clave: '.$token.'</p>
          <a href="'.$url.'">Establecer nueva clave</a>
          <p>Si no solicitaste la recuperacion de clave, por favor ignora este correo.</p>
      </div>

      </body>
      </html>
    ';

    return $html;
    }

    public static function htmlRegistro($nombre,$token){
        $html = ' 
        <!DOCTYPE html>
        <html lang="es">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Codigó registro</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #444;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            margin: 10px 0;
            line-height: 1.5;
        }
        .highlight {
            font-weight: bold;
            color: #c29349;
        }
        a {
            display: inline-block;
            font-size: 16px;
            padding: 12px 25px;
            margin-top: 20px;
            color: #ffffff;
            background-color: #c29349;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #a97732;
            color: #ffffff;
        }
        </style>
      </head>
      <body>
        <div class="container">
        <h1>Hola, Bienvenido </h1>
            <p>Has solicitado registrar una nueva cuenta. Para completar el proceso de autenticacion, por favor usa el siguiente codigo:</p>
            <p class="highlight">Codigo de autenticacion: '.$token.'</p>
            <p>Si no solicitaste el registro, por favor ignora este correo.</p>
        </div>

      </body>
      </html>
    ';

    return $html;
    }

}
