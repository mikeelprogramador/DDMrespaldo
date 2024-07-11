<?php
session_start();
include_once("../../cajon/bootstrap/bootstrap.php");
include_once("../../metodos/clas-producto.php");
include_once("../../metodos/clas-view.php");
include_once("../../metodos/clas-verific.php");
include_once("../../metodos/clas-carrito.php");
if(isset($_FILES['foto_perfil'])){
    $files =  $_FILES['foto_perfil'] ;
    $img = Producto::img(2,$files);
    Verificaciones::cargarImagen($img,$_SESSION['id']);
    echo $img;
}
if(isset($_GET['aumentar']) && $_GET['aumentar'] == true){
    $id = id::desencriptar($_GET['data']);
    $carrito = Carrito::buscarCarrito($_SESSION['id']);
    if($_GET['cantidad'] < $_GET['max']){
        if(Carrito::aumentarCantidad(1,$carrito,$id) == 1){
            echo Vista::mostrarCarrito(1,$_SESSION['id']);
        }
    }else{
        echo "limite";
    }
}
if(isset($_GET['restar']) && $_GET['restar'] == true){
    $id = id::desencriptar($_GET['data']);
    $carrito = Carrito::buscarCarrito($_SESSION['id']);
    if($_GET['cantidad'] > 1){
        if(Carrito::aumentarCantidad(2,$carrito,$id) == 1){
            echo Vista::mostrarCarrito(1,$_SESSION['id']);
        }
    }else{
        echo "limite";
    }
}
if(isset($_GET['dinero']) && $_GET['dinero']== 'actualizar'){
    echo number_format(Carrito::dinero(1,$_SESSION['id']), 2, ',', '.');
}