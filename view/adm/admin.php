<?php
include_once("../../metodos/clas-functions.php");
include_once("../../metodos/clas-view.php");
include_once("../../metodos/clas-estadisticas.php");
include_once("../../metodos/clas-producto.php");
include_once("../../metodos/clas-sessiones.php");
include_once("../../cajon/bootstrap/bootstrap.php");
  if(! isset($_SESSION)) session_start();
  if(! isset($_SESSION['id'])){
    header("location: ../../index.php");
  }else{
    if($_SESSION['id'] == ""){
      header("location: ../../index.php");
    }
    if(Funciones::verificarPerfil(1,$_SESSION['id']) == "2"){
      header("location: ../user/ddm.php?");
    }
  }
  $seccion = "admin_home"; //Sección por defecto.
  if( isset( $_GET[ 'seccion' ] ) ){
    $seccion = $_GET[ 'seccion' ];
  }
  if($seccion == "out"){
    Session::destruirSessiones();
  }else{
    include( "nav-adm.php" );
  }
