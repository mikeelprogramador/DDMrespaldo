<?php

$server = $_GET['servidor'];
$root = $_GET['root'];
$clave = $_GET['clave'];

$conexion = new  mysqli($server,$root,$clave);

if($conexion -> connect_error){
    echo "error en la conexion";
}

$base = "bd_ddm";
$sql_create_bd = "CREATE DATABASE IF NOT EXISTS $base";


if($conexion->query($sql_create_bd) == true ){

    $ruta_base = 'bd_ddm.sql';

    $conexion2 = new mysqli($server,$root,$clave,$base);
    $sql = file_get_contents($ruta_base);

    // Ejecutar múltiples consultas separadas por punto y coma
    if ($conexion2->multi_query($sql)) {
        unlink('instalador.php');
        header("location: index.php");
        exit();
    } else {
        echo "Error al importar la base de datos: " ;
    }


}else{
    echo "Verifca si la base ya existe";
}
$conexion->close();
$conexion2->close();

