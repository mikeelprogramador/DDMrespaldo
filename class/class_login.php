<?php
class Login {

    /**
     * Este metodo se encarga de registrara a los nuevos usuarios
     */
    public static function registrar($nombre,$apellido,$email,$password){
        include_once("class_encript.php");
        include_once("../../conf/model.php");
        $passwordEncript = Encriptar::codificar(1,$password);
        if( Login::encontrarUsuario(1,$email) == 0 ){
            $consulta = Model::sqlRegistarUsuario($nombre,$apellido,$email,$passwordEncript);
            if($consulta){
                $salida = 1;
            }else{
                $salida = 0;//Si ocuurio un error al momento de registrar a la persona
            }
        }else{
            $salida = -1;//Si los datos que la persoan ingreso ya existen
        }
        return $salida; 
    }
        

    public static function inicio($email,$password){
        include_once("class_encript.php");
        include_once("../../conf/model.php");
        $salida = 0;
        $passwordBd = Login::obtenerPassword(2,$email);
        if(Encriptar::codificar(2,$password,$passwordBd)){
            $consulta = Model::sqlInicoSesion($email,$passwordBd);
            while($fila= $consulta->fetch_array()){
                if( $fila[1] > 0 ){
                    $salida = 1;
                    if( $fila[0] == "0" || $fila[0] == "1"){
                        $salida = 2; 
                    }
                }else{
                    $saldia = 0;// si ocurre un error al momenro de veridcar los datos
                }
            }
        }else{
            $salida = -1;// si la contraseña no es la misma que esta en la base de datos
        }
        return $salida;
    }

    public static function obtenerPassword($des,$dato){
        include_once("../../conf/model.php");
        $salida = "";
        $consulta = Model::sqlUsuario($des,$dato);
        while($fila= $consulta->fetch_array()){
            $salida .= $fila[4];
        }
        return $salida; 
    }


    public static function encontrarUsuario($des,$email){
        include_once("../../conf/model.php");
        $consulta = Model::sqlUsuario($des,$email);
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }

    public static function buscarUsuariosCorreoId($correo,$id_user){
        include_once("../../conf/model.php");
        $consulta = Model::sqlbuscarUsuario($correo,$id_user);
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }
}

