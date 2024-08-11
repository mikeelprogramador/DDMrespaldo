<?php

class Encriptar{
    private static function encriptar($password){
        $opciones = [
            'cost'=> 12,
        ];
       $passwordEncript = password_hash($password,PASSWORD_DEFAULT,$opciones);
        return $passwordEncript;
    }

    private static function verificar($password,$passwordBd){
        return password_verify($password,$passwordBd);
    }

    public static function codificar($des,$password,$passwordBd = null){
        if($des == 1)$salida = self::encriptar($password);
        if($des == 2)$salida = self::verificar($password,$passwordBd);
        return $salida;
    }
}

class id{

    public static function encriptar($dato) {
        return base64_encode($dato);
    }
    
    public static function desencriptar($dato) {
        return base64_decode($dato);
    }

}