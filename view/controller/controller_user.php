<?php
include_once("../../class/class_encript.php");
include_once("../../class/class_crearProducto.php");
include_once("../../class/class_vista.php");
include_once("../../class/class_user.php");
include_once("../../class/class_funciones.php");
include_once("../../class/class_carrito.php");
include_once("../../conf/model.php");
include_once("../../class/class_sessiones.php");
include_once("../../class/class_token.php");
include_once("../../class/class_correo.php");
include_once("../../class/class_login.php");
include_once("../../class/class_historial.php");
Session::iniciarSessiones();
if(Session::verificarSesssiones() == 0 ){
    header("location: ../../index.php");
    exit();
}
Session::sessionCodigo();

if(isset($_FILES['foto_perfil'])){
    $files =  $_FILES['foto_perfil'] ;
    $img = CrearProducto::img(2,$files);
    if($img =="1" || $img =="0"){
        echo "limitesImg";
    }else{
        Usuarios::cargarImagen($img,$_SESSION['id']);
        echo $img;
    }
}
if(isset($_GET['aumentar']) && $_GET['aumentar'] == true){
    $id = id::desencriptar($_GET['data']);
    $carrito = Carrito::buscarCarrito($_SESSION['id']);
    if($_GET['cantidad'] < $_GET['max']){
        echo(Carrito::aumentarCantidad(1,$carrito,$id) == 1?  Vista::mostrarCarrito(1,$_SESSION['id']): '');
    }
}

if(isset($_GET['restar']) && $_GET['restar'] == true){
    $id = id::desencriptar($_GET['data']);
    $carrito = Carrito::buscarCarrito($_SESSION['id']);
    if($_GET['cantidad'] > 1){
        echo(Carrito::aumentarCantidad(2,$carrito,$id) == 1? Vista::mostrarCarrito(1,$_SESSION['id']): '');
    }
}

if(isset($_GET['dinero']) && $_GET['dinero']== 'actualizar'){
    echo Funciones::strDinero(Carrito::dinero(1,$_SESSION['id']));
}

if(isset($_GET['eliminarDelCarrito']) && $_GET['eliminarDelCarrito'] == true){
    $carrito = Carrito::buscarCarrito($_SESSION['id']);
    $id = id::desencriptar($_GET['data']);
    Model::sqlEliminarDelCarrito($carrito,$id);
    echo Vista::mostrarCarrito(1, $_SESSION['id']);
}

//Recuperacion de contraseña
if(isset($_GET['saveDato'])){
    $_SESSION['codigo'] = token::Obtener_token(10);
    if(Login::buscarUsuariosCorreoId($_POST['correo'],$_SESSION['id']) == 0){
        echo "not exist";
    }else{
        echo Correo::enviarCorreo(2,$_POST['correo'], $_SESSION['codigo']);
    }
}

//Cambiar foto 
if(isset($_GET['cambiarFoto'])){
    $img = '../../img/logo-icon-person.jpg';
    Usuarios::cargarImagen($img,$_SESSION['id']);
    echo $img;
}

//Buscar productos por categoria,nombre,descripcion etc
if(isset($_GET['busquedaGeneral'])){
    $categorias = "";
    if(isset($_GET['cate']))$categorias = $_GET['cate'];
    echo Vista::mostrarProductos(2,$_GET['busquedaGeneral'],$categorias);
}

//Buscar productos por usu ofertas
if(isset($_GET['busquedaOfertas'])){
    echo Vista::mostrarProductos(3,$_GET['busquedaOfertas']);
}

//Vaciar el hisotrial
if(isset($_GET['vaciarHistorial'])){
    if(Historial::contarHistorial($_SESSION['id']) > 0){
        Model::sqlEliminarHistorial(1,$_SESSION['id']);
        echo 1;
    }else{
        echo 0;
    }
}

if(isset($_POST['deleteHistorial'])){
    $idHistoiral = id::desencriptar($_POST['deleteHistorial']);
    Model::sqlEliminarHistorial(2,$_SESSION['id'],$idHistoiral);
    echo Historial::verHistorial($_SESSION['id']);
}

if(isset($_GET['deleteCuenta'])){
    $id_user = $_SESSION['id'];
    $carrito = Carrito::buscarCarrito($id_user);
    Model::sqlVaciarCarrito($carrito);
    Model::sqlelimiarUsuario(1,$id_user);
    Model::sqlelimiarUsuario(2,$id_user);
    Model::sqlelimiarUsuario(3,$id_user);
    Model::sqlelimiarUsuario(4,$id_user);
    Model::sqlelimiarUsuario(5,$id_user);
    Model::sqlelimiarUsuario(6,$id_user);
    echo Session::destruirSessiones(1);
    
}

if(isset($_GET['actualizarUsuario'])){
    $metodo = 0;
    $nombre = Funciones::vacunaXxs($_POST['name']);
    $apellido = Funciones::vacunaXxs($_POST['lastname']);
    $correo = Funciones::vacunaXxs($_POST['email']);
    if(Login::encontrarUsuario(1,$correo) == 1){
        if(Usuarios::datosUsuario(3,$_SESSION['id']) === $correo){
            $metodo = 1;
        }else{
            echo 0;
        }
    }else{
        $metodo = 1;
    }
    if($metodo === 1){
        Model::sqlActauluizarUsuario($_SESSION['id'],$nombre,$apellido,$correo);
        echo 1;
    }


}