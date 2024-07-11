<?php
class Producto {
    /**
     * Crear un producto
     */
    public static function cargarProducto($id,$nombre,$descrip,$caracter,$cantidad,$oferta,$img,$precio,$color){
        $salida = 0;
       include_once("modelo.php");
       if(Producto::verificarProducto($id) == 1 ){
           $salida += 0;
       }else{
            $consulta = Model::sqlCargarProducto($id,$nombre,$descrip,$caracter,$cantidad,$oferta,$img,$precio,$color);
            if($consulta){
                $salida += 1;
            }else{
                $salida += 2;
            }
        }
       return $salida;
    }

    /**
     * Metodo si el producto existe
     */
    public static function verificarProducto($id){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlverificarProducto($id,2);
        while($fila=$consulta->fetch_array()){
            if($fila[0] == 1){
                $salida += 1;
            }else{
                $salida +=0;
            }
        }
        return $salida;
    }
    /**
     * Cargar la imagen
     */
    public static function img($des,$img){
        $salida = "";
        $file = $img;
        $tamaño = $file["size"];
        $nombre = $file["name"];
        $tipo = pathinfo($nombre, PATHINFO_EXTENSION); 
        $ruta_provicional = $file["tmp_name"];
        if($des ==1)$carpeta = "../../fotos/"; 
        if($des ==2)$carpeta = "../../img_user/"; 
           
        if($tipo != 'jpg' && $tipo != 'png' && $tipo != 'gif'&& $tipo != 'tiff' && $tipo != 'webp' && $tipo != 'bmp'&& $tipo != 'jpeg' && $tipo != 'jfif'){
            $salida = "0";
        }else if($tamaño > 3*1024*1024){
            $salida = "1";
        }else{
            $src = $carpeta.$nombre;
            move_uploaded_file($ruta_provicional,$src);
            if($des ==1)$carpeta = $salida .= "../../fotos/".$nombre;
            if($des ==2)$carpeta = $salida .= "../../img_user/".$nombre;
            
        }
        return $salida;
    }
    /**
     * Eliminar el producto
     */
    public static function eliminarProducto($id){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlEliminarProducto($id);
        if( $consulta ){
            $salida = 1; //si se elimino correctamnete
        }
        return $salida; 
    }
    /**
     * Metodo para crear comentario
     */
    public static function crearComentarios($comentario,$id_producto,$id_usuario){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlComentarios($comentario,$id_producto,$id_usuario);
        if($consulta){
            $salida = 1;
        }
        return $salida; 
    }
    /**
     * Eliminar comentario
     */
    public static function eliminarComentarios($id_comen, $id_user){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlEliminarComentario("","eliminar",$id_comen, $id_user);
        if($consulta){
            $salida = 1;
        }
        return $salida; 
    }

    public static function productos($des,$id_pro){
        include_once("modelo.php");
        $salida = ""; 
        $consulta = Model::sqlProductos($des,$id_pro);
        while($fila = $consulta->fetch_array()){
            $salida .= $fila[0];
        }
        return $salida; 
    }
    
    public static function agregarCategoria($des,$categoria,$id_pro){
        include_once("modelo.php");
        $consulta = Model::sqlAgregarCategoria($des,$categoria,$id_pro);
    }

    public static function contarCategorias($des){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlAgregarCategoria($des);
        while($fila = $consulta->fetch_array()){
            $salida += $fila[0];
        }
        return $salida;
    }

        /**
     * Agregar megusta a un producto
     */
    public static function valoracion($id_pro,$id_user,){
        include_once("modelo.php");
        $salida = 1;
        $consulta = Model::sqlValoracion($id_pro,$id_user);
        if($consulta){
            $salida = 0;
        }
    }

    public static function actualizarLikes($id_user,$id_pro,$valoracion){
        include_once("modelo.php");
        $salida = 1;
        $consulta = Model::sqlLikes(3,$id_user,$id_pro,$valoracion);
        if($consulta){
            $salida = 0;
        }
        return $salida;
    }

    public static function contarValoracion($valoracion,$id_pro){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlContarValoracion($valoracion,$id_pro);
        while($fila = $consulta->fetch_array()){
            $salida += $fila[0];
        }
        return $salida;
    }

    public static function verificarLikes($id_user,$id_pro){
        include_once("modelo.php");
        $salida = 0;
        $consulta = Model::sqlLikes(1,$id_user,$id_pro);
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida; 
    }

    public static function eliminarLikes($id_user,$id_pro){
        include_once("modelo.php");
        $salida = 1;
        $consulta = Model::sqlLikes(2,$id_user,$id_pro);
        if($consulta){
            $salida = 0;
        }
    }

    public static function valoracionUsuario($id_user,$id_pro){
        include_once("modelo.php");
        $salida = -1;
        $consulta = Model::sqlLikes(4,$id_user,$id_pro);
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }

    public static function checkUsuario($id_user,$id_pro){
        include_once("modelo.php");
        $salida = -1;
        $consulta = Model::sqlLikes(5,$id_user,$id_pro);
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }
    
}
