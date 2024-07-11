<?php
  include_once("../../metodos/clas-verific.php");
  include_once("../../cajon/bootstrap/bootstrap.php");
  include_once("../../metodos/clas-view.php");
  include_once("../../metodos/clas-carrito.php");

  if(! isset($_SESSION)) session_start();
  if(! isset($_SESSION['id'])){
    header("location: ../../index.php");
  }else{
    if($_SESSION['id'] == ""){
      header("location: ../../index.php");
    }
  }
if( Carrito::verificarCarrito($_SESSION['id']) == 0 ){
  Carrito::crearCarrito($_SESSION['id']);
}

  $seccion = "home"; 
  

if( isset( $_GET[ 'seccion' ] ) ){
  $seccion = $_GET[ 'seccion' ];
}

if($seccion == "categorias"){
  if(isset($_GET['cate']))$categorias = $_GET['cate'];
}

if($seccion == "out"){
  Verificaciones::actualizarEstadoUser(2, $_SESSION['id']);
  session_destroy();
  setcookie(session_name(), "", time() - 3600, "/");
  header("location: ../../index.php");
}else{
  include( "navbar-user.php" );
}