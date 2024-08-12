<?php

class ModelVista{

    public static function sqlVerHistorial($id_user){
        include("model/conexion.php");
        $sql = "select * from tb_historial as t1 ";
        $sql .= "inner join tb_productos as t2 on t1.id_producto = t2.id_producto ";
        $sql .= "where id_usuario = '$id_user' order by fec_ver desc";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlContarRespuestas($idComentario){
        include("model/conexion.php");
        $sql = "select count(*) from tb_respuestasComentarios ";
        $sql .= "where idComentario = '$idComentario' ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlVerRespuestas($idComentario){
        include("model/conexion.php");
        $sql = "select t3.nombre,t3.foto_usuarios,repuesta,fech_repuesta,t3.id,idRespuesta,idComentario ";
        $sql .= "from tb_respuestasComentarios as t1 ";
        $sql .= "inner join tb_comentarios as t2 on t1.idComentario = t2.id_comentario ";
        $sql .= "inner join tb_usuarios as t3 on t1.idUsuario = t3.id  ";
        $sql .= "where idComentario = '$idComentario' order by fech_repuesta desc ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlVerValoracionProducto($idProducto){
        include("model/conexion.php");
        $sql = "select count(valoracion) as likes, ";
        $sql .= "(select count(valoracion) ";
        $sql .= "from tb_valoracion ";
        $sql .= "where id_producto = '$idProducto' and valoracion = 1  )as dislikes  ";
        $sql .= "from tb_valoracion ";
        $sql .= "where id_producto = '$idProducto   ' and valoracion = 0 ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlVerComentariosUsuarios($idUsuario){
        include("model/conexion.php");
        $sql = "select nombre,foto_usuarios,t2.comentario,t2.fechaComentario ";
        $sql .= "from tb_usuarios as t1 ";
        $sql .= "inner join tb_comentarios as t2 on t1.id = t2.id_usuario ";
        $sql .= "where id = '$idUsuario'";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlVerRespuestasUsuarios($idUsuario){
        include("model/conexion.php");
        $sql = "select nombre,foto_usuarios,t2.repuesta,t2.fech_repuesta ";
        $sql .= "from tb_usuarios as t1 ";
        $sql .= "inner join tb_respuestasComentarios as t2 on t1.id = t2.idUsuario ";
        $sql .= "where id = '$idUsuario'";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlMegustasUsuarios($idUsuario){
        include("model/conexion.php");
        $sql = "select producto_nombre,precio,descripcion_producto,img ";
        $sql .= "from tb_productos as t1  ";
        $sql .= "inner join tb_valoracion as t2 on t1.id_producto = t2.id_producto  ";
        $sql .= "inner join tb_usuarios as t3 on t2.id_usuario = t3.id ";
        $sql .= "where t3.id = '$idUsuario' and valoracion = 0 ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlverOfertas(){
        include("model/conexion.php");
        $sql = "select * from tb_ofertas";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlContarOfertas($oferta){
        include("model/conexion.php");
        $sql = "select count(*) from tb_ofertas ";
        $sql .= "where oferta = '$oferta' ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlContarHistorial($idUser){
        include("model/conexion.php");
        $sql = "select count(*) from tb_historial ";
        $sql .= "where id_usuario = '$idUser' ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlContarCategoriasConProductos($categoria){
        include("model/conexion.php");
        $sql = "select count(*) from tb_categorias as t1 ";
        $sql .= "inner join tb_categoriasProducto as t2 on t1.id_categoria = t2.id_categoria ";
        $sql .= "where categoria = '$categoria' ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlComentarioProducto($idProducto){
        include("model/conexion.php");
        $sql = "select id_comentario from tb_comentarios as t1  ";
        $sql .= "inner join tb_productos as t2 on t1.id_producto = t2.id_producto ";
        $sql .= "where t1.id_producto = '$idProducto' ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlVentasPormeses($año){
        include("model/conexion.php");
        $sql = "SELECT MONTH(fecha_de_compra) AS meses,  SUM(CAST(REPLACE(REPLACE(total_compra, '.', ''), ',', '.') AS DECIMAL(18))) AS total_por_mes ";
        $sql .= "FROM tb_compras ";
        $sql .= "WHERE YEAR(fecha_de_compra) = '$año' AND MONTH(fecha_de_compra) BETWEEN 1 AND 12 ";
        $sql .= "GROUP BY MONTH(fecha_de_compra) ";
        return $conexion->query($sql);
        $conexion->close();
    }


 


    
}