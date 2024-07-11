<?php
class estilo{

    private $menssage;
    private $nowMenssage;

    public function __construct($texto) {
        $this->menssage = $texto;
        estilo::cambio();
    }

    private function cambio(){
        $opciones = [
            'cost'=> 12,
        ];
       $this-> nowMenssage = password_hash($this->menssage,PASSWORD_DEFAULT,$opciones);
       $this-> menssage = "";
    }
    public function imprimir(){
        return $this->nowMenssage;
    }
    private function verificar($texto,$base){
        return password_verify($texto,$base);
    }

    public function texto($texto1,$texto2){
        return $this->verificar($texto1,$texto2);
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
    /**
     * Autor 
     * marcos alberto saavedra sanabr
     * sacado de stackoverflow
     */
    }
    
}