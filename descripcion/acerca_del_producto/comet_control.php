<?php
include_once("../../metodos/clas-producto.php");
include_once("../../metodos/clas-view.php");
include_once("../../metodos/clas-conte_pro.php");
include_once("../../cajon/bootstrap/bootstrap.php");
include_once("../../metodos/clas-carrito.php");
if(!isset($_SESSION))session_start();

if( isset($_POST['agregarComentario']) && $_POST['agregarComentario'] == true ){
    $comentario = $_POST['comentario'];
    if( $comentario != ""){
        $id = id::desencriptar($_POST['data']);
        if( Producto::crearComentarios($comentario,$id,$_SESSION['id']) == 1){
            echo Vista::viewComentarios($id,$_SESSION['id']);
        }
    }
}
if( isset($_POST['eliminarComentario']) && $_POST['eliminarComentario'] == true ){
    $id_comen = $_POST['comen'];
    $id = $_POST['data'];
    if(  Producto::eliminarComentarios($id_comen,$_SESSION['id']) == 1){
       echo Vista::viewComentarios($id, $_SESSION['id']);

    }
}

if(isset($_GET['estado']) && $_GET['estado'] == "agregado"){
    $id = id::desencriptar($_GET['data']);
    if(AcercaDelProductos::verCantidades($id,1) == 0){
        header("location: product.php?http=". $_SESSION['token']."&data=".$_GET['data']."&question=0");
    }else{
      $carrito = Carrito::buscarCarrito($_SESSION['id']);
      $cantidad = $_GET['can'];
      if( $carrito != 0 ){
          if(Carrito::restriccionCarrito($_SESSION['id'],$id) == 0){
              if(Carrito::agregarAlCarrito($carrito,$id,$cantidad) == 1 ){
                  header("location: product.php?http=".$_GET['http']."&data=".$_GET['data']."&question=true");
              }
          }else{
              header("location: product.php?http=".$_GET['http']."&data=".$_GET['data']."&question=existe ");
          }

      }else{
         header("location: product.php?http=".$_GET['http']."&data=".$_GET['data']."&question=false");
      }
    }
}

if(isset($_GET['like']) && $_GET['like'] == true){
    $id = id::desencriptar($_GET['data']);
    if(Producto::verificarLikes($_SESSION['id'],$id) > 0){
        if(Producto::valoracionUsuario($_SESSION['id'],$id) == 0)$verif = Producto::eliminarLikes($_SESSION['id'],$id);
        if(Producto::valoracionUsuario($_SESSION['id'],$id) == 1)$verif = Producto::actualizarLikes($_SESSION['id'],$id,0);
    }else{
       $verif =  Producto::valoracion($id,$_SESSION['id']);
       $verif = Producto::actualizarLikes($_SESSION['id'],$id,0);
    }
    if($verif == 0)echo Vista::ContenidoProducto($id,$_SESSION['token']);
    if($verif != 0)echo "error";
}

if(isset($_GET['dislike']) && $_GET['dislike'] == true){
    $id = id::desencriptar($_GET['data']);
    if(Producto::verificarLikes($_SESSION['id'],$id) > 0){
        if(Producto::valoracionUsuario($_SESSION['id'],$id) == 1)$verif = Producto::eliminarLikes($_SESSION['id'],$id);
        if(Producto::valoracionUsuario($_SESSION['id'],$id) == 0)$verif = Producto::actualizarLikes($_SESSION['id'],$id,1);
    }else{
       $verif =  Producto::valoracion($id,$_SESSION['id']);
       $verif = Producto::actualizarLikes($_SESSION['id'],$id,1);
    }
    if($verif == 0)echo Vista::ContenidoProducto($id,$_SESSION['token']);
    if($verif != 0)echo "error";
}
