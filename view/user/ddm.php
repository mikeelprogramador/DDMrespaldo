<?php
include_once("../../class/class_vista.php");
include_once("../../class/class_carrito.php");
include_once("../../class/class_encript.php");
include_once("../../class/class_sessiones.php");
include_once("../../class/class_user.php");
include_once("../../class/class_funciones.php");
include_once("../../class/class_historial.php");
include_once("../../class/class_compra.php");
include_once("../../class/class_comentarios.php");

Session::iniciarSessiones();
if(Session::verificarSesssiones() == 0 ){
  header("location: ../../index.php");
  exit();
}

if( Carrito::verificarCarrito($_SESSION['id']) == 0 )Carrito::crearCarrito($_SESSION['id']);
Session::eliminarHistorial();

$seccion = "home"; 
  
if( isset( $_GET[ 'seccion' ] )) $seccion = $_GET[ 'seccion' ];

if($seccion == "categorias"){
  if(isset($_GET['cate']))$categorias = $_GET['cate'];
}

if(isset($_GET['error'])){
  if($_GET['error'] === "direccion")echo Funciones::alertas(6,3);
}

//decisiones para las barras de busqueda
if($seccion == "home")$lugar = 1;
if($seccion == "categorias")$lugar = 2;
if($seccion == "ofertas")$lugar = 3;

if($seccion == "out"){
  Session::destruirSessiones();
}else{
  include( "navbar-user.php" );
}