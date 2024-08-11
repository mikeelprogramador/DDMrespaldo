<?php
include("confic.php");
$conexion = mysqli_connect($url,$user,$clave,$bd);

if($conexion->connect_error){
    echo "no se puedo conectar a la base de datos";
}