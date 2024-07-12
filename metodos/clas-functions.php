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

     public static function valorUnitario($cantidad,$sub_valor){
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
        $salida = 0;
        $total =  explode(" ",$total);
        for($i = 0;$i <count($total); $i ++){
            $salida += Funciones::intDinero($total[$i]);
        }
        $salida = Funciones::strDinero($salida);
        return $salida;
     }

         /**
     * Metodo verifica la gerarquia del usuario
     */
    public static function verificarPerfil($des,$id_user){
        include_once("modelo.php");
        $salida = "";
        $consulta = Model::sqlVerificarPerfil($des,$id_user);
        while($fila = $consulta->fetch_array()){
            $salida .= $fila[0];
        }
        return $salida;
    }
    /**
     * Metodo actualiza el estado del usuario
     */
    public static function actualizarEstadoUser($des,$id_user){
        include_once("modelo.php");
        $consulta = Model::sqlActualizarEstadoUser($des,$id_user);
    }
    /**
     * Meotdo busca el codifo del usuario
     */
    public static function buscarIdUsuario($email){
        include_once("modelo.php");
        $salida = 0; 
        $consulta = Model::sqlUsuario(2,$email);
        while($fila=$consulta->fetch_array()){
            $salida += $fila['id'];
        }
        return $salida;
    }

    public static function cargarImagen($img,$id_user){
        include_once("modelo.php");
        $consulta = Model::sqlActualizarImagen($img,$id_user);
    }

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