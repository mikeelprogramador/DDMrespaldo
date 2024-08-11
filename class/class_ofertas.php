<?php

class Ofertas {

    public static function verOfertas($des){
        include_once("../../conf/model_vista.php");
        $salida ="";
        $consulta = ModelVista::sqlverOfertas();
        while($fila = $consulta->fetch_array()){
            if($des === 1)$salida .= "<option value='".$fila[1]."'>Oferta</option>";
            if($des === 2)$salida .= "<option value='".$fila[0]."'>".$fila[1]."</option>";
        }
        return $salida;
    }

    public static function buscarOfertas($idOferta){
        include_once("../../conf/model.php");
        $consulta = Model::sqlBuscarOfertas(1,$idOferta);
        if($consulta->num_rows === 0){
            $salida = "Not exist";
        }else{
            while($fila = $consulta->fetch_array()){
                $salida = $fila[0];
            }
        }
        return $salida;
    }

    public static function contarOfertas($oferta){
        include_once("../../conf/model_vista.php");
        $consulta = ModelVista::sqlContarOfertas($oferta);
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }

    public static function NombresOfertas($oferta){
        include_once("../../conf/model.php");
        $consulta = Model::sqlBuscarOfertas(2,$oferta);
        if($consulta->num_rows === 0){
            $salida = "No tiene oferta";
        }else{
            while($fila = $consulta->fetch_array()){
                $salida = $fila[0];
            }
        }
        return $salida;
    }


}