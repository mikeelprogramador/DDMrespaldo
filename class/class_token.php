<?php
/**
 * Autor 
 * marcos alberto saavedra sanabr
 * sacado de stackoverflow
 */
class token{
    public static function Obtener_token($cantidadCaracteres)
    {
        $Caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $ca = strlen($Caracteres);
        $ca--;
        $Hash = '';
        for ($x = 1; $x <= $cantidadCaracteres; $x++) {
            $Posicao = rand(0, $ca);
            $Hash .= substr($Caracteres, $Posicao, 1);
        }
        return $Hash;
    }
}