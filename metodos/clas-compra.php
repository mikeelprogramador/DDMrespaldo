<?php

class Compras{

    public static function agregarCompra($id_user,$depar,$munici,$telefono,$barrio,$direccion){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlCompras($id_user,$depar,$munici,$telefono,$barrio,$direccion);
        if($consulta){
            $salida = 1;
        }
        return $salida;
    }

    public static function countCompra(){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlCountCompras();
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }
    public static function datosDeCompra($des,$id_user){
        include_once("modelo.php");
        $salida = "";
        $consulta = Model::sqlMostrarCarrito($des,$id_user);
        while($fila = $consulta->fetch_array()){
            $salida .= $fila[0]." ";
        }
        return $salida;
    }

    public static function produCompra($id_compra,$id_pro,$cantidad,$precio){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlProduCompra($id_compra,$id_pro,$cantidad,$precio);
        if($consulta){
            $salida = 1;
        }
        return $salida;
    }

    public static function comprasUni($id_compra,$id_pro,$cantidad,$precio){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlComprasUni($id_compra,$id_pro,$cantidad,$precio);
        if($consulta){
            $salida = 1;
        }
        return $salida;
    }

}