<?php
include_once("../../class/class_vista.php");
include_once("../../class/class_sessiones.php");
include_once("../../class/class_encript.php");
include_once("../../class/class_user.php");
include_once("../../class/class_funciones.php");
include_once("../../class/class_historial.php");
include_once("../../class/class_comentarios.php");
include_once("../../class/class_producto.php");

Session::iniciarSessiones();
if(Session::verificarSesssiones() == 0 ){
    header("location: ../../index.php");
    exit();
}
if(!isset($_GET['http'])){
    header("location: ../../error.php");
    exit();
}
if($_GET['http'] != $_SESSION['token']){
    header("location: ../../error.php");
    exit();
}

if(Productos::detallesDelProducto(0,id::desencriptar($_GET['data'])) === ""){
    header("location: ../../error.php");
    exit();
}

if(isset($_GET['question'])){
    if($_GET['question'] == "true") echo Funciones::alertas(1,3,id::desencriptar($_GET['data']));
    if($_GET['question'] == "false") echo Funciones::alertas(2,3,id::desencriptar($_GET['data']));
    if($_GET['question'] == "existe") echo Funciones::alertas(3,3,id::desencriptar($_GET['data']));
    if($_GET['question'] == 0) echo Funciones::alertas(4,3,id::desencriptar($_GET['data']));
    if($_GET['question'] == "notcompra") echo Funciones::alertas(5,3,id::desencriptar($_GET['data']));

}

if(Session::sessionHistorial() == 1 ) Historial::agregarHistorial($_SESSION['id'],id::desencriptar($_GET['data']));


$seccion = "producto";
include($seccion.".php");

