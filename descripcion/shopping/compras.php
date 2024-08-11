<?php 
include_once("../../class/class_vista.php");
include_once("../../class/class_producto.php");
include_once("../../class/class_encript.php");
include_once("../../class/class_sessiones.php");
include_once("../../class/class_user.php");
Session::iniciarSessiones();
if(Session::verificarSesssiones() == 0 ){
    header("location: ../../index.php");
    exit();
}

if(isset($_GET['seccion']))$seccion = $_GET['seccion'];

if(Usuarios::verificarPerfil(1,$_SESSION['id']) !=2){
    header("location: ../../descripcion/acerca_del_producto/product.php?http=".$_SESSION['token']."&data=".$_GET['data']."&question=notcompra");
    exit();
}

if(isset($_GET['estado']) && $_GET['estado'] == "compraMax"){
    $_SESSION['url'] = "../../view/user/ddm.php?estado=cancelado&seccion=carrito";
    $url = "compras.php?seccion=ubicacion&http=".$_SESSION['token']."&estado=compraMax";
    $action = "../../view/controller/controller_compra.php?estado=compraMax";
}

if(isset($_GET['estado']) && $_GET['estado'] == "compraUni"){
    $_SESSION['url']  ="../../descripcion/acerca_del_producto/product.php?http=". $_SESSION['token']."&data=".$_GET['data']."";
    $url = "compras.php?seccion=ubicacion&http=". $_SESSION['token']."&data=".$_GET['data']."&estado=compraUni";
    $action = "../../view/controller/controller_compra.php?estado=compraUni&data=".$_GET['data']."";
}

if(isset($_GET['cantidad'])){
    $_SESSION['cantidad'] = $_GET['cantidad'];
    if(Productos::verCantidades(id::desencriptar($_GET['data']),1) == 0){
        header("location: ../acerca_del_producto/product.php?http=". $_SESSION['token']."&data=".$_GET['data']."&question=0");
        exit();
    }
}

include($seccion.".php");