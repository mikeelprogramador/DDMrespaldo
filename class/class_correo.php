<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    
class Correo{

    public static function correo($correo,$asunto,$body){
        include("../../PHPMailer/PHPMailer.php");
        include("../../PHPMailer/Exception.php");
        include("../../PHPMailer/SMTP.php");// Solo si estás usando SMTP

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings   
            $mail->isSMTP();                                                        //Send using SMTP
            $mail->SMTPDebug  =  0;                                                 //Enable verbose debug output                           
            $mail->Host       = 'smtp.mailersend.net';                              //Set the SMTP server to send through
            $mail->SMTPAuth   =  true;                                              //Enable SMTP authentication
            $mail->Username   = 'MS_mX3fQX@trial-v69oxl596yxg785k.mlsender.net';    //SMTP username
            $mail->Password   = 'FckVCuinkPnvDjAH';                                 //SMTP password
            $mail->SMTPSecure = 'tls';                                              //Enable implicit TLS encryption
            $mail->Port       =  587;                                               //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('MS_mX3fQX@trial-v69oxl596yxg785k.mlsender.net','DDM');
            $mail->addAddress($correo,'Cliente');     //Add a recipient;

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $asunto;
            $mail->Body    = $body;

            $mail->send();
            $salida =  0;
        } catch (Exception $e) {
            $salida =  1;
        }
        return $salida;
    }

    public static function enviarCorreo($des,$correo,$codigo){
        include_once("class_sessiones.php");
        include_once("class_user.php");
        include_once("class_funciones.php");
        include_once("../../conf/model.php");
        Session::iniciarSessiones();
        if($des == 1 )$id = Login::encontrarUsuario(2,$correo);
        if($des == 2 )$id = $_SESSION['id'];
        if($des === 3){
            $html = Funciones::htmlRegistro($correo,$codigo);
            $mensaje = "Registro DDM";
        }else{
            $nombre = Usuarios::verificarPerfil(2,$id);
            $passwordNueva = Encriptar::codificar(1,$codigo);
            Model::sqlCambiarPassword($passwordNueva,$id);
            $html = Funciones::htmlRecuperarContraseña($nombre,id::encriptar($id),$codigo);
            $mensaje = "Recuperacion de Clave";
        }
        return Correo::correo($correo,$mensaje,$html);
    }

}