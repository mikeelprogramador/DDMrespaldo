<?php
  include_once("../../metodos/clas-functions.php");
  include_once("../../cajon/bootstrap/bootstrap.php");
  include_once("../../metodos/clas-view.php");
  include_once("../../metodos/clas-carrito.php");
  include_once("../../metodos/clas-sessiones.php");

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
  Session::destruirSessiones();
}else{
  include( "navbar-user.php" );
}