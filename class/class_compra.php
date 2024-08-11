<?php

class Compras{
    
    public static function verCompras($id_user){
        include_once("class_encript.php");
        include_once("class_fechas.php");
        include_once("../../conf/model.php");
        $salida = "<div class='contenido'>";
        $consulta = Model::sqlVerCompra($id_user);
        while($fila = $consulta->fetch_assoc()){
            $compra = id::encriptar($fila['id_compra']);
            $salida .= "<div class='compra'>";
            $salida .= "<div class='compra-info'>";
            $salida .= "<p class='compra-codigo'>Código de compra: ".$fila['id_compra']."</p>";
            $salida .= "<p class='compra-usuario'>".$fila['nombre']." ".$fila['apellido']."</p>";
            $salida .= "<p class='compra-departamento'>Departamento: ".$fila['departamento']."</p>";
            $salida .= "<p class='compra-municipio'>Municipio: ".$fila['municipio']."</p>";
            $salida .= "<p class='compra-total'>Total: ".$fila['total_compra']."</p>";
            $salida .= "<p class='compra-fecha'>Compra realizada ".Fecha::mostrarFechas($fila['fecha_de_compra'])."</p>";
            $salida .= "</div>";
            $salida .= "<div class='compra-opciones'>";
            $salida .= "<a class='compra-factura' href='../../descripcion/factura.php?code=".$compra."&verfactura'>Ver factura</a>";
            $salida .= "</div>";
            $salida .= "</div>";
        }
        $salida .= "</div>"; // cierre del contenedor de contenido
        return $salida;
    }

    public static function agregarCompra($id_user,$depar,$munici,$telefono,$barrio,$direccion,$nombre,$email){
        include_once("../../conf/model.php");
        $salida = 0;
        $consulta = Model::sqlCompras($id_user,$depar,$munici,$telefono,$barrio,$direccion,$nombre,$email);
        if($consulta){
            $salida = 1;
        }
        return $salida;
    }

    public static function countCompra(){
        include_once("../../conf/model.php");
        $salida = 0;
        $consulta = Model::sqlCountCompras();
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }
    public static function datosDeCompra($des,$id_user){
        include_once("../../conf/model.php");
        $salida = "";
        $consulta = Model::sqlMostrarCarrito($des,$id_user);
        while($fila = $consulta->fetch_array()){
            $salida .= $fila[0]." ";
        }
        return $salida;
    }

    public static function produCompra($id_compra,$id_pro,$cantidad,$precio){
        include_once("../../conf/model.php");
        $salida = 0;
        $consulta = Model::sqlProduCompra($id_compra,$id_pro,$cantidad,$precio);
        if($consulta){
            $salida = 1;
        }
        return $salida;
    }

    public static function comprasUni($id_compra,$id_pro,$cantidad,$precio){
        include_once("../../conf/model.php");
        $salida = 0;
        $consulta = Model::sqlComprasUni($id_compra,$id_pro,$cantidad,$precio);
        if($consulta){
            $salida = 1;
        }
        return $salida;
    }
}