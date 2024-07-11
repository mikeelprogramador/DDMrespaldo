<?php  
if(!isset($_SESSION))session_start();

class Funciones{

    public static function intDinero($dinero){
        $salida = str_replace(",","",$dinero);
        $salida = str_replace(".","",$salida);
        $salida = substr($salida,0,-2);
        $salida = intval($salida);
        return $salida;
    }
    public static function strDinero($dinero){
        $salida = number_format($dinero, 2, ',', '.');
        return $salida;
    }
     public static function reinicarEnvio(){
        $_SESSION['correo'] = "";
        $_SESSION['departamento'] = "";
        $_SESSION['municipios'] = "";
        $_SESSION['telefono'] = "";
        $_SESSION['barrio'] = "";
        $_SESSION['direccion'] = "";
        if(isset($_SESSION['cantidades']))$_SESSION['cantidades'] = 0;
     }

     public static function totalFactura($total){
        $salida = 0;
        $total =  explode(" ",$total);
        for($i = 0;$i <count($total); $i ++){
            $salida += Funciones::intDinero($total[$i]);
        }
        $salida = Funciones::strDinero($salida);
        return $salida;
     }


}