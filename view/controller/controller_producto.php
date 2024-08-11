<?php
include_once("../../class/class_producto.php");
include_once("../../class/class_vista.php");
include_once("../../class/class_encript.php");
include_once("../../class/class_carrito.php");
include_once("../../class/class_funciones.php");
include_once("../../class/class_comentarios.php");
include_once("../../class/class_user.php");
include_once("../../conf/model.php");
if(!isset($_SESSION))session_start();

if( isset($_POST['agregarComentario']) && $_POST['agregarComentario'] == true ){
    $comentario = Funciones::vacunaXxs($_POST['comentario']);
    if( $comentario != ""){
        $id = id::desencriptar($_POST['data']);
        if( Productos::crearComentarios($comentario,$id,$_SESSION['id']) == 1){
            echo Comentarios::verComentarios($id,$_SESSION['id']);
        }
    }
}
if( isset($_POST['eliminarComentario']) && $_POST['eliminarComentario'] == true ){
    $id_comen = $_POST['comen'];
    $id = $_POST['data'];
    if(  Productos::eliminarComentarios($id_comen,$_SESSION['id']) == 1){
       echo Comentarios::verComentarios($id, $_SESSION['id']);

    }
}

if(isset($_GET['estado']) && $_GET['estado'] == "agregado"){
    $id = id::desencriptar($_GET['data']);
    if(Productos::verCantidades($id,1) == 0){
        header("location: ../../descripcion/acerca_del_producto/product.php?http=". $_SESSION['token']."&data=".$_GET['data']."&question=0");
        exit();
    }else{
      $rango = Usuarios::verificarPerfil(1,$_SESSION['id']);
      $cantidad = $_GET['can'];
      if( $rango === "2" ){
        $carrito = Carrito::buscarCarrito($_SESSION['id']);
          if(Carrito::restriccionCarrito($_SESSION['id'],$id) == 0){
              if(Carrito::agregarAlCarrito($carrito,$id,$cantidad) == 1 ){
                  header("location: ../../descripcion/acerca_del_producto/product.php?http=".$_GET['http']."&data=".$_GET['data']."&question=true");
                  exit();
              }
          }else{
              header("location: ../../descripcion/acerca_del_producto/product.php?http=".$_GET['http']."&data=".$_GET['data']."&question=existe ");
              exit();
          }

      }else{
         header("location: ../../descripcion/acerca_del_producto/product.php?http=".$_GET['http']."&data=".$_GET['data']."&question=false");
         exit();
       }
    }
}

if(isset($_GET['like']) && $_GET['like'] == true){
    $id = id::desencriptar($_GET['data']);
    if(Productos::verificarLikes($_SESSION['id'],$id) == 0){
        $verif =  Productos::valoracion($id,$_SESSION['id']);
        $verif = Productos::actualizarLikes($_SESSION['id'],$id,0);
     }else{
        if(Productos::valoracionUsuario($_SESSION['id'],$id) == 0)$verif = Productos::eliminarLikes($_SESSION['id'],$id);
        if(Productos::valoracionUsuario($_SESSION['id'],$id) == 1)$verif = Productos::actualizarLikes($_SESSION['id'],$id,0);
     }

    if($verif == 0){
        $like = Productos::contarValoracion(0, $id);
        $deslike = Productos::contarValoracion(1, $id);
        echo Vista::verlikes($_GET['data'],$like,$deslike);
    }
    if($verif != 0)echo "error";
}

if(isset($_GET['dislike']) && $_GET['dislike'] == true){
    $id = id::desencriptar($_GET['data']);
    if(Productos::verificarLikes($_SESSION['id'],$id) == 0){
        $verif =  Productos::valoracion($id,$_SESSION['id']);
        $verif = Productos::actualizarLikes($_SESSION['id'],$id,1);
    }else{
        if(Productos::valoracionUsuario($_SESSION['id'],$id) == 1)$verif = Productos::eliminarLikes($_SESSION['id'],$id);
        if(Productos::valoracionUsuario($_SESSION['id'],$id) == 0)$verif = Productos::actualizarLikes($_SESSION['id'],$id,1);
    }

    if($verif == 0){
        $like = Productos::contarValoracion(0, $id);
        $deslike = Productos::contarValoracion(1, $id);
        echo Vista::verlikes($_GET['data'],$like,$deslike);
    }
    if($verif != 0)echo "error";
}

if(isset($_POST['updateComet']) && $_POST['updateComet'] == 'true' ){
    $comentario = Funciones::vacunaXxs($_POST['comet']);
    $id = id::desencriptar($_POST['data']);
    Model::actualizarComentario($_POST['idComet'],$comentario);
    echo Comentarios::verComentarios($id,$_SESSION['id']);
}

if(isset($_POST['respuestaCome']) && $_POST['respuestaCome'] == 'true' ){
    $comentario = Funciones::vacunaXxs($_POST['comet']);
    Model::ResponderComentario($_POST['idComet'],$comentario,$_SESSION['id']);
    echo Comentarios::verRespuestas($_POST['idComet'],$_SESSION['id']);
}
 if(isset($_POST['deletRespuesta'])){
    Model::sqlDeleteRespuesta($_POST['deletRespuesta']);
    echo 1;
 }