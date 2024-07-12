<?php 
include_once("../../metodos/clas-view.php");
include_once("../../metodos/clas-functions.php");
include_once("../../cajon/bootstrap/bootstrap.php");
if(! isset($_SESSION)) session_start();
if(! isset($_SESSION['id'])){
    header("location: ../../index.php");
}else{
    if($_SESSION['id'] == ""){
        header("location: ../../index.php");
    }
}

if(isset($_GET['seccion'])){
    $seccion = $_GET['seccion'];
}

if(isset($_GET['estado'])){
    if($_GET['estado'] == "compraMax"){
        $_SESSION['url'] = "../../view/user/ddm.php?seccion=carrito";
        $url = "compras.php?seccion=ubicacion&http=".$_SESSION['token']."&estado=compraMax";
        $action = "secuencias.php?estado=compraMax";
    } 
    if($_GET['estado'] == "compraUni"){
        $_SESSION['url']  ="../acerca_del_producto/product.php?http=". $_SESSION['token']."&data=".$_GET['data']."";
        $url = "compras.php?seccion=ubicacion&http=". $_SESSION['token']."&data=".$_GET['data']."&estado=compraUni";
        $action = "secuencias.php?estado=compraUni&data=".$_GET['data']."";
    }
}

if(isset($_GET['cantidad'])){
    $_SESSION['cantidad'] = $_GET['cantidad'];
    if(Funciones::verCantidades(id::desencriptar($_GET['data']),1) == 0){
        header("location: ../acerca_del_producto/product.php?http=". $_SESSION['token']."&data=".$_GET['data']."&question=0");
    }
}

include($seccion.".php");