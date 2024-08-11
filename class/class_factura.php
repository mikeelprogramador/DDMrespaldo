<?php

class Facturas {
    public static function valorUnitario($cantidad,$sub_valor){
        include_once("class_funciones.php");
        $salida = "";
        $sub_valor =  explode(" ",$sub_valor);
        $cantidad =  explode(" ",$cantidad);
        for($i = 0;$i <count($cantidad)-1; $i ++){
            $valor = Funciones::intDinero($sub_valor[$i]);
            $salida .=Funciones::strDinero(intval($valor)/intval($cantidad[$i]))."<br><br>";
        }
        return $salida;
     }

     public static function totalFactura($total){
        include_once("class_funciones.php");
        $salida = 0;
        $total =  explode(" ",$total);
        for($i = 0;$i <count($total); $i ++){
            $salida += Funciones::intDinero($total[$i]);
        }
        $salida = Funciones::strDinero($salida);
        return $salida;
     }
}