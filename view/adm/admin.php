<?php
include_once("../../class/class_sessiones.php");
include_once("../../class/class_user.php");
include_once("../../class/class_vista.php");
include_once("../../class/class_estadisticas.php");
include_once("../../class/class_funciones.php");
include_once("../../class/class_encript.php");
include_once("../../class/class_producto.php");
include_once("../../class/class_historial.php");
include_once("../../class/class_comentarios.php");
include_once("../../class/class_ofertas.php");

Session::iniciarSessiones();
if(Session::verificarSesssiones() == 0 ){
  header("location: ../../index.php");
  exit();
}
if(Usuarios::verificarPerfil(1,$_SESSION['id']) == "2")header("location: ../user/ddm.php?");
Session::eliminarHistorial();

$seccion = "admin_home"; //Sección por defecto.
if( isset( $_GET[ 'seccion' ] ) )$seccion = $_GET[ 'seccion' ]; 

if($seccion == "out"){
  Session::destruirSessiones();
}else{
  include( "nav-adm.php" );
}

if( isset($_GET['menPro']) )echo Funciones::alertas($_GET['menPro'],1);

if(isset($_GET['actualizado'])){
  ?><script>window.alert(Mensajes.mensajesGlobales(152));</script><?php
}

if(isset($_GET['correct'])){
  ?><script>window.alert(Mensajes.mensajesGlobales(153));</script><?php
}

if(isset($_GET['error'])){
  ?><script>window.alert(Mensajes.mensajesGlobales(154));</script><?php
}



