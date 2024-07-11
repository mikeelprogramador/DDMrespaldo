<?php
include("metodos/clas-verific.php");
include("metodos/clas-login.php");
if( ! isset($_SESSION)) session_start();
if( ! isset($_SESSION['id'])) $_SESSION['id'] = "";

if( isset($_GET['log'])){

    $email = $_POST['email'];
    $password = $_POST['clave'];
    

    if ( $_GET['log'] == 1){// Si log es 1 inicia session
        $login = Login::inicio($email,$password);
        $id = Verificaciones::buscarIdUsuario($email);
        if( $login == 1){
            $_SESSION['id'] = $id;
            Verificaciones::actualizarEstadoUser(1, $_SESSION['id']);
            header("location: view/user/ddm.php?");
        }
        if( $login == 0 ){
            header("location: login.php?men=error".$login."");
        }
        if(  $login == -1 ){
            header("location: login.php?men=error".$login."");
        }
        if( $login == 2 ){
            $_SESSION['id'] = $id;
            Verificaciones::actualizarEstadoUser(1, $_SESSION['id']);
            header("location: view/adm/admin.php?");
        }
    }
    else{

        $nombre = $_POST['nom'];
        $apellido = $_POST['apellido'];
        $registro = Login::registrar($nombre,$apellido,$email,$password);
        $id = Verificaciones::buscarIdUsuario($email);
        if( $registro == 1 ){
            $_SESSION['id'] = $id;
            Verificaciones::actualizarEstadoUser(1, $_SESSION['id']);
            header("location: view/user/ddm.php?");
        }
        if( $registro == 0){
            header("location: check-in.php?men=".$registro."error");
        }
        if( $registro == -1 ){
            header("location: check-in.php?men=".$registro."error");
        }
    }
}
