<?php
if(!isset($_SESSION))session_start();

class AcercaDelProductos{

    public static function verCantidades($id_pro,$des){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlverificarProducto($id_pro,$des);
        while($fila = $consulta ->fetch_assoc()){
            $salida = $fila['cantidades'];
        }
        return $salida;
    }

}