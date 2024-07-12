<?php 
include_once("../../metodos/clas-view.php");
include_once("../../metodos/clas-producto.php");
include_once("../../metodos/clas-functions.php");
include_once("../../metodos/clas-functions.php");
//Vista administrador de los productos
if(isset($_GET['search'])){
    echo Vista::buscarProducto($_GET['search'],2);
}
//Vista general de los productos
if(isset($_GET['busquedaGeneral'])){
    echo Vista::mostrarProductos($_GET['busquedaGeneral'],2);
}
//Desicion para eliminar un producto
if( isset($_GET['id']) ){
    if(Producto::eliminarProducto($_GET['id']) == 1){
      echo Vista::buscarProducto('',1);
    }
}
//Formulario para cargar productos
if(isset($_POST ['enviar'])){
  
    $id = $_POST['id-pro'];
    $nombre = $_POST['name-pro'];
    $descrip = $_POST['descrip-pro'];
    $caracter = $_POST['caracter-pro'];
    $color = $_POST['color-pro'];
    $cantidad = $_POST['cantidad-pro'];
    $ofertas = $_POST['oferta-pro'];
    $precio = $_POST['precio-pro'];
    ($precio > 0?$precio = Funciones::strDinero($precio):$precio = 0 );

    /*Crea una array para las categorias*/
    $categorias = [];
    for($i = 1; $i <=Producto::contarCategorias(2); $i ++){
      if(isset($_POST['categoria'.$i])  != ''){
        $categorias[] = $_POST['categoria'.$i];
        
      }
    }

    if(isset($_FILES['card-img'])){
      $img  = Producto::img(1,$_FILES['card-img']);
      if( $img == "0" )header("location: admin.php?men=img".$img."&seccion=seccion-ag-pro");
      if( $img == "1" )header("location: admin.php?men=img".$img."&seccion=seccion-ag-pro");
    }

    if( $img != "0" || $img !="1" ){
      if(  !empty($_FILES['card-img']) && $id != "" && $nombre != "" ){
        
        $nowProducto = Producto::cargarProducto($id,$nombre,$descrip,$caracter,$cantidad,$ofertas,$img,$precio,$color);
        if( !empty($categorias) )Producto::agregarCategoria(1,$categorias,$id);
        if( $nowProducto == 0 )header("location: admin.php?men=".$nowProducto."&seccion=seccion-ag-pro");
        if( $nowProducto == 1 )header("location: admin.php?men=".$nowProducto."&seccion=seccion-ag-pro");
        if( $nowProducto == 2 )header("location: admin.php?men=".$nowProducto."&seccion=seccion-ag-pro");
      }else {
        header("location: admin.php?men=2&seccion=seccion-ag-pro");
      }
    } 
  }


if(isset($_FILES['foto_perfil'])){
  $files =  $_FILES['foto_perfil'] ;
  $img = Producto::img(2,$files);
  Funciones::cargarImagen($img,$_SESSION['id']);
  echo $img;
}