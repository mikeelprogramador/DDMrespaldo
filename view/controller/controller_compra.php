<?php
include_once("../../class/class_vista.php");
include_once("../../class/class_compra.php");
include_once("../../class/class_carrito.php");
include_once("../../class/class_user.php");
include_once("../../class/class_producto.php");
include_once("../../class/class_funciones.php");
include_once("../../conf/model.php");
include_once("../../class/class_encript.php");
if(!isset($_SESSION))session_start();

if(isset($_GET['estado']) && $_GET['estado'] == "compraUni" ){

    if(!isset($_POST['departamenrtos']) && !isset($_POST['municipios'])){
        header("location: ../../descripcion/acerca_del_producto/product.php?http=".$_SESSION['token']."&data=".$_GET['data']."&erro=direccion");
        exit();
    }else{
        $_SESSION['correo'] = Funciones::vacunaXxs($_POST['email']);
        $_SESSION['departamento'] = Vista::regiones(3,$_POST['departamentos']);
        $_SESSION['municipios'] = Vista::regiones(4,$_POST['municipios']);
        $_SESSION['telefono'] = Funciones::vacunaXxs($_POST['telefono']);
        $_SESSION['barrio'] = Funciones::vacunaXxs($_POST['barrio']);
        $_SESSION['direccion'] = Funciones::vacunaXxs($_POST['direccion']);
        header("location: ../../descripcion/shopping/compras.php?seccion=informacion&htpp=".$_SESSION['token']."&data=".$_GET['data']."&estado=compraUni");
        exit();
        
    }
}

if(isset($_GET['estado']) && $_GET['estado'] == "compraMax" ){
    if(!isset($_POST['departamenrtos']) && !isset($_POST['municipios'])){
        header("location: ../../view/user/ddm.php?seccion=carrito&error=direccion");
        exit();
    }else{
        $_SESSION['correo'] = Funciones::vacunaXxs($_POST['email']);
        $_SESSION['departamento'] = Vista::regiones(3,$_POST['departamentos']);
        $_SESSION['municipios'] = Vista::regiones(4,$_POST['municipios']);
        $_SESSION['telefono'] = Funciones::vacunaXxs($_POST['telefono']);
        $_SESSION['barrio'] = Funciones::vacunaXxs($_POST['barrio']);
        $_SESSION['direccion'] = Funciones::vacunaXxs($_POST['direccion']);
        header("location: ../../descripcion/shopping/compras.php?seccion=informacion&htpp=".$_SESSION['token']."&estado=compraMax");
        exit();
    }
}

if(isset($_GET['compra']) && $_GET['compra'] == "eliminar"){
        Session::reinicarEnvio();
        header("location:".$_SESSION['url']."");
        exit();
    
}

if(isset($_GET['estado']) && $_GET['estado'] == "comprando" && isset($_GET['identific']) && $_GET['identific'] == "compraMax"){
    $id_user    = $_SESSION['id'];
    $depar      = $_SESSION['departamento'];
    $muni       = $_SESSION['municipios'];
    $tel        = $_SESSION['telefono'];
    $barrio     =  $_SESSION['barrio'];
    $direccion  = $_SESSION['direccion'];
    $nombre     = Usuarios::verificarPerfil(2,$id_user);
    $emil       = $_SESSION['correo'];

    if(Compras::agregarCompra($id_user,$depar,$muni,$tel,$barrio,$direccion,$nombre,$emil) == 1 ){
        $id_compra = Compras::countCompra();
        $id_productos = explode(" ",Compras::datosDeCompra(2,$id_user));//Combirtir en una array para saber cuantos productos hay
        $cantidades =  explode(" ",Compras::datosDeCompra(3,$id_user));//Combirtir en una array para saber cuantos productos hay
        $precios =  explode(" ",Compras::datosDeCompra(4,$id_user));//Combirtir en una array para saber cuantos productos hay

        if(Compras::produCompra($id_compra,$id_productos,$cantidades,$precios,) == 1){
            Model::sqlActualizarCantidadesMAx($id_productos,$cantidades);
            Model::sqlActualizarTotalCompra($id_compra,$id_user);
            $carrito = Carrito::buscarCarrito($id_user);
            Model::sqlVaciarCarrito($carrito);
           header("location: ../../descripcion/factura.php?code=".id::encriptar($id_compra)."&ContinuarCompra");
           exit();

        }else{
            Model::sqlBorraComporaAU(1,$id_compra,$id_user);
            header("location: ../../view/user/ddm.php?seccion=carrito&error=datos");
            exit();
                
        }
            
    }else{
       header("location: ../../view/user/ddm.php?seccion=carrito&error=datos");
       exit();
    }
}

if(isset($_GET['estado']) && $_GET['estado'] == "comprando" && isset($_GET['identific']) && $_GET['identific'] == "compraUni"){
    $id_user    = $_SESSION['id'];
    $depar      = $_SESSION['departamento'];
    $muni       = $_SESSION['municipios'];
    $tel        = $_SESSION['telefono'];
    $barrio     =  $_SESSION['barrio'];
    $direccion  = $_SESSION['direccion'];
    $cantidades = $_SESSION['cantidad'];
    $nombre     = Usuarios::verificarPerfil(2,$id_user);
    $emil       = $_SESSION['correo'];
    
    if(Compras::agregarCompra($id_user,$depar,$muni,$tel,$barrio,$direccion,$nombre,$emil) == 1 ){

        $id_compra = Compras::countCompra();
        $id_pro = id::desencriptar($_GET['data']);
        $precio = Funciones::intDinero(Productos::detallesDelProducto(7,$id_pro));
        $_SESSION['totalCompra'] = $cantidades*$precio;
        

        if(Compras::comprasUni($id_compra,$id_pro,$cantidades,Funciones::strDinero($_SESSION['totalCompra'])) == 1){
            Model::sqlActualizarTotalCompra($id_compra,$id_user);
            Model::sqlActualizarCantidadesUni($id_pro,$cantidades);     
            header("location: ../../descripcion/factura.php?code=".id::encriptar($id_compra)."&ContinuarCompra");
            exit();
        }else{
            Model::sqlBorraComporaAU(1,$id_compra,$_SESSION['id']);
            header("location: ../acerca_del_producto/product.php?http=".$_SESSION['token']."&data=".$_GET['data']."&erro=direccion");
            exit();
        } 
    }else{
        header("location: ../acerca_del_producto/product.php?http=".$_SESSION['token']."&data=".$_GET['data']."&erro=direccion");
        exit();
    }
}

