<?php
include_once("../../metodos/clas-verific.php");
include_once("../../metodos/clas-admin.php");
include_once("../../metodos/clas-view.php");
include_once("../../metodos/clas-estadisticas.php");
include_once("../../metodos/clas-producto.php");
include_once("../../cajon/bootstrap/bootstrap.php");
  if(! isset($_SESSION)) session_start();
  if(! isset($_SESSION['id'])){
    header("location: ../../index.php");
  }else{
    if($_SESSION['id'] == ""){
      header("location: ../../index.php");
    }
    if(Verificaciones::verificarPerfil(1,$_SESSION['id']) == "2"){
      header("location: ../user/ddm.php?");
    }
  }
  $seccion = "seccion1"; //Sección por defecto.
  if( isset( $_GET[ 'seccion' ] ) ){
    $seccion = $_GET[ 'seccion' ];
  }
  if($seccion == "out"){

  }else{
    include( "nav-adm.php" );
  }
