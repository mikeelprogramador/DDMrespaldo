<?php
include_once('../../class/class_sessiones.php');
include_once('../../class/class_login.php');
include_once('../../class/class_user.php');
include_once('../../class/class_funciones.php');
include_once('../../class/class_encript.php');
include_once('../../class/class_token.php');
include_once('../../class/class_correo.php');
include_once('../../conf/model.php');
Session::iniciarSessiones();
 //Inico de sesio de usuario
if( isset($_GET['log']) && $_GET['log'] == 1){
    $email = Funciones::vacunaXxs($_POST['email']);
    $password = Funciones::vacunaXxs($_POST['clave']);
    $login = Login::inicio($email,$password);
    $id = Login::encontrarUsuario(2,$email);

    if( $login == 1){
        $_SESSION['id'] = $id;
        Usuarios::actualizarEstadoUser(1, $id);
        header("location: ../user/ddm.php?");
        exit();
    }
    if( $login == 2 ){
        $_SESSION['id'] = $id;
        Usuarios::actualizarEstadoUser(1, $id);
        header("location: ../adm/admin.php?");
        exit();
    }
    if( $login == 0 ){
        header("location: ../../login.php?men=error".$login."");
        exit();
    }
    if(  $login == -1 ){
        header("location: ../../login.php?men=error".$login."");
        exit();
    }

}
//Registro de usuario
if( isset($_GET['log']) && $_GET['log'] == 0){

    // $email = Funciones::vacunaXxs($_POST['email']);
    // $password = Funciones::vacunaXxs($_POST['clave']);
    // $nombre = Funciones::vacunaXxs($_POST['nom']);
    // $apellido = Funciones::vacunaXxs( $_POST['apellido']);
    // $registro = Login::registrar($nombre,$apellido,$email,$password);
    // $id = Login::encontrarUsuario(2,$email);

    // if( $registro == 1 ){
    //     $_SESSION['id'] = $id;
    //     Usuarios::actualizarEstadoUser(1, $id);
    //     header("location: ../user/ddm.php?");
    //     exit();
    // }
    // if( $registro == 0){
    //     header("location: ../../check-in.php?men=".$registro."error");
    //     exit();
    // }
    // if( $registro == -1 ){
    //     header("location: ../../check-in.php?men=".$registro."error");
    //     exit();
    // }

}

if(isset($_GET['saveDato'])){
    $_SESSION['codigo'] = token::Obtener_token(10);
    if(Login::encontrarUsuario(1,$_POST['correo']) == 0){
         echo "not exist";
    }else{
        echo Correo::enviarCorreo(1,$_POST['correo'], $_SESSION['codigo']);
    }
}

if(isset($_GET['cambioPasswprd'])){
    $_SESSION['id'] = "";
    $id = id::desencriptar($_GET['datause']);
    $passwordActual = $_POST['passwordActual'];
    $passwordBd = Login::obtenerPassword(3,$id);
    if(Encriptar::codificar(2,$passwordActual,$passwordBd)){
        $passwordNueva = Encriptar::codificar(1,$_POST['passwordNueva']);
        Model::sqlCambiarPassword($passwordNueva,$id);
        header("location: ../../login.php");
    }else{
        header("location: ../../recuperarcion.php?datause=".$_GET['dataUse']."&error");
    }
}

if(isset($_GET['autenticacion'])){
    $_SESSION['autenticacion'] = token::Obtener_token(8);
    $email = Funciones::vacunaXxs($_POST['email']);
    if(Correo::enviarCorreo(3,$email, $_SESSION['autenticacion']) === 0){
        echo $_SESSION['autenticacion'];
    }else{
        echo 1;
    }
}
