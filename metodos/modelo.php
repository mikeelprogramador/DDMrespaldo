<?php

class Model {

    /**
     * Metodo para registara a un cliente
     * @param id {number} codigo del usuario
     * @param nombre {texto} nombre que el cliente elige para la cuenta.
     * @param apellido {texto} apellido del cliente que elige para la cuenta.
     * @param email {tetxo} correo  que el cliente elige para la cuenta.
     * @param newPwd {texto} contraseña incriptada que el cliente eligio para la cuenta
     */
    public static function sqlRegistarUsuario($id,$nombre,$apellido,$email,$newPwd){
        include("bd-conect/inclucion-bd.php");
        $sql = "INSERT INTO tb_usuarios(id,nombre,apellido,email,pasword,fecha_registro,cate_user,foto_usuarios) ";
        $sql .= "VALUES($id,'$nombre','$apellido','$email','$newPwd',now(),'2','../../img/logo-icon-person.jpg')";
        return $conexion->query($sql);
    }
    /**
     * Metodo que verifica si el usuario existe, tambien muestra el rol del usuario
     * @param email {tetxo} correo  que el cliente elige para la cuenta.
     * @param newPwd {texto} contraseña incriptada que el cliente eligio para la cuenta
     */
    public static function sqlInicoSesion($email,$newPwd){
        include("bd-conect/inclucion-bd.php");
        $sql = "select (select cate_user from tb_usuarios where email = '$email' and pasword = '$newPwd' ), count(*) from tb_usuarios";
        return $conexion->query($sql);
    }
    /**
     * Metodo para buscar o contra los usuarios
     * @param des {number} decisiones para el sql 1:realiza un conteo 2:busca el usuario por el correo 3: busca a la persona por el ahi.
     * @param valor {texto}  es el dato que se buscara en el sql, puede ser el correo o el codigo del usuario.
     */
    public static function sqlUsuario($des,$valor){
        include("bd-conect/inclucion-bd.php");
        if( $des == 1 ){
            $dato = "count(*)";
            $busca = "email";
        }if( $des == 2 ){
            $dato = "*";
            $busca = "email";
        }if( $des == 3){
            $dato = "*";
            $busca = "id";
        }
        $sql = "select $dato from tb_usuarios where $busca='$valor'";
        return $conexion->query($sql);
    }
    /**
     * Metodo que verica el rol, 0: SuperAdmin, 1:Admin, 2:Cliente
     * @param des {number} decision para el sql, 1:consultar rol, 2:consultar nombre del usuario.
     * @param id_user {number} codigo del usuario.
     */
    public static function sqlVerificarPerfil($des,$id_user){
        include("bd-conect/inclucion-bd.php");
        if($des == 1){
            $dato = "cate_user";
        }if($des == 2){
            $dato = "nombre";
        }
        $sql = "select $dato from tb_usuarios where id = '$id_user'";
        return $resulatdo = $conexion->query($sql);
    }
    /**
     * Metodo que crea el codigo del usuairo apartir de cuantos clientes existna el la pagina,muestra los datos del usuario
     * 
     */
    public static function sqlCraerIdUsuario($des){
        include("bd-conect/inclucion-bd.php");
        if( $des == 1) $dato = "count(*)";
        if( $des == 2) $dato = "*";
        $sql = "select $dato from tb_usuarios ";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlCargarProducto($id,$nombre,$descrip,$caracter,$cantidad,$oferta,$img,$precio,$color){
        include("bd-conect/inclucion-bd.php");
        $sql = "INSERT INTO tb_productos";
        $sql .= "(id_producto,producto_nombre,descripcion_producto,caracteristicas_producto,cantidades,id_ofertas,img,precio,color)";
        $sql.= "VALUE('$id','$nombre','$descrip','$caracter','$cantidad','$oferta','$img','$precio','$color')";
        return $resulatdo = $conexion->query($sql);
    }
    /**
     * Metodo para verificar si un producto y para mostrar un producto
     * param @palabra la palabra clave para buscar o mostrar
     */
    public static function sqlverificarProducto($id,$des){
        include("bd-conect/inclucion-bd.php");
        if( $des == 1 ){
            $sql = "select * ";
        }
        if( $des == 2 ){
            $sql = "select count(*) ";
        }
        $sql .= "from tb_productos where id_producto = '$id'";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlMostrarProductos($search = null,$des = null,$categoria = null){
        include("bd-conect/inclucion-bd.php");
        if($des == 1 ){
            $sql = "select * from tb_productos ";
        }
        if( $des === 2){
            $sql = "select * from tb_productos ";
            if( $search != null )$sql .= Model::textoBuqueda($search);
        }
        if($des == 3 ){
            $sql = "select t1.id_producto,img,producto_nombre,precio,descripcion_producto ";
            $sql .= "from tb_productos as t1 ";
            $sql .="inner join tb_categoriasProducto as t2 on t1.id_producto = t2.id_producto ";
            $sql .= "inner join tb_categorias as t3 on t2.id_categoria = t3.id_Categoria ";
            if( $search != null ){
                $sql .= Model::textoBuqueda($search);
                $sql .= " and t3.categoria = '$categoria' ";
            }else{
                $sql .= "where t3.categoria = '$categoria' ";
            }
        }
       // echo $sql ;
        return $resulatdo = $conexion->query($sql);
    }

    private static function textoBuqueda($search){
        $palabra = explode(" ",$search);
        //var_dump($palabra);
            $sql = "where ";
            for($i = 0; $i < count($palabra); $i++){
                $sql .= "(producto_nombre like '%".$palabra[$i]."%' or descripcion_producto like '%".$palabra[$i]."%' or id_producto like '%".$palabra[$i]."%')";
                if($i != count($palabra)-1){
                    $sql .= " and ";
                }
            }
        return $sql;
    }


    public static function sqlEliminarProducto($id){
        include("bd-conect/inclucion-bd.php");
        Model::sqlEliminarFkProductos(1,$id);
        Model::sqlEliminarComentario($id,1);
        Model::sqlEliminarFkProductos(2,$id);
        $sql = "DELETE FROM tb_productos WHERE id_producto = '$id'";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlEliminarFkProductos($des,$id){
        include("bd-conect/inclucion-bd.php");
        if( $des == 1){
            $tabla = "tb_categoriasProducto";
        }if($des == 2){
            $tabla = "tb_valoracion";
        }
        $sql = "DELETE FROM $tabla WHERE id_producto =  '$id'";
        $resultado = $conexion->query($sql);
    }
    /**
     * comentra bien este metodo, 4 parametros
     * param @$id  codigo del producto
     * param @$put clave de paso
     * param @id_comen codigo comentario
     * param @id_user codigo usuario
     */
    public static function sqlEliminarComentario($id = null, $des = null, $id_comen = null, $id_user = null){
        include("bd-conect/inclucion-bd.php");
        $sql = "DELETE FROM tb_comentarios ";
        if( $des == "eliminar" ){
            $sql .= "where id_comentario = '$id_comen' and id_usuario = '$id_user' ";
        }
        if( $des == 1){
            $sql .= "where id_producto = '$id'";
        }
        return $resultado = $conexion->query($sql);
    }

    public static function sqlComentarios($comentario,$id_producto,$id_usuario){
        include("bd-conect/inclucion-bd.php");
        $sql = "INSERT INTO tb_comentarios(comentario,fechaComentario,id_producto,id_usuario)";
        $sql .= "value('$comentario',now(),'$id_producto','$id_usuario')";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlViewComentarios($id_pro){
        include("bd-conect/inclucion-bd.php");
        $sql = "select tb_usuarios.nombre,comentario,fechaComentario,tb_usuarios.id,id_comentario ";
        $sql .= "from tb_comentarios ";
        $sql .= "inner join tb_usuarios on tb_comentarios.id_usuario = tb_usuarios.id ";
        $sql .= "inner join tb_productos on tb_comentarios.id_producto = tb_productos.id_producto ";
        $sql .= "where tb_productos.id_producto = '$id_pro' ";
        return $resultado = $conexion->query($sql);
    }




    public static function sqlActualizarEstadoUser($des,$id_user){
        include("bd-conect/inclucion-bd.php");
        if($des == 1){
            $dato = "Activo";
        }if($des == 2){
            $dato = "Inactivo";
        }
        $sql = "update tb_usuarios set status_user = '$dato' where id= ('$id_user') ";
        //echo $sql;
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlProductos($des,$id_pro){
        include("bd-conect/inclucion-bd.php");
        if($des == 1)$dato = "producto_nombre";
        if($des == 2)$dato = "descripcion_producto";
        if($des == 3)$dato = "caracteristicas_producto";
        if($des == 4)$dato = "cantidades";
        if($des == 5)$dato = "id_ofertas";
        if($des == 6)$dato = "img";
        if($des == 7)$dato = "precio";
        if($des == 8)$dato = "color";
        $sql = "SELECT $dato FROM tb_productos where id_producto = '$id_pro'";
        return $resulatdo = $conexion->query($sql);

    }

    public static function sqlMostrarCategorias(){
        include("bd-conect/inclucion-bd.php");
        $sql = "select * from tb_categorias";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlAgregarCategoria($des,$categorias = null,$id_pro = null){
        include("bd-conect/inclucion-bd.php");
        if( $des == 1){
            $sql ="INSERT INTO tb_categoriasProducto(id_producto,id_categoria)values";
            for($i = 0; $i <count($categorias); $i ++){
                $sql .= "('$id_pro','$categorias[$i]')";
                if($i != count($categorias)-1){
                    $sql .= ",";
                }
            }
        }
        if($des == 2 ){
            $sql = "select count(*) from tb_categorias";
        }
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlActualizarImagen($img,$id_user){
        include("bd-conect/inclucion-bd.php");
        $sql = "UPDATE tb_usuarios ";
        $sql .= "set foto_user = '$img' ";
        $sql .= "where id = '$id_user'";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlCarrito($des,$id_user){
        include("bd-conect/inclucion-bd.php");
        if($des == 1 ){
            $sql = "INSERT INTO  tb_carrito(id_usuario)";
            $sql .= "values('$id_user')";
        }
        if($des == 2 ){
            $sql = "select count(*) from tb_carrito ";
            $sql .= "where id_usuario = '$id_user'";
        }
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlBuscarCarrito($id_user){
        include("bd-conect/inclucion-bd.php");
        $sql = "select id_carrito from tb_carrito ";
        $sql .= "where id_usuario = '$id_user'";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlAgregarCarrito($carrito,$id_pro,$cantidad){
        include("bd-conect/inclucion-bd.php");
        $sql = "INSERT INTO tb_carypro(id_carrito,id_producto,cantidad_de_productos)";
        $sql .= "values('$carrito','$id_pro','$cantidad')";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlMostrarCarrito($des,$id_user){
        include("bd-conect/inclucion-bd.php");
        if($des == 1)$dato = "*";
        if($des == 2)$dato = "t1.id_producto";
        if($des == 3)$dato = "t2.cantidad_de_productos";
        if($des == 4)$dato = "t1.precio";
        $sql = "select $dato from tb_productos as t1 ";
        $sql .= "inner join tb_carypro as t2 on t1.id_producto = t2.id_producto ";
        $sql .= "inner join tb_carrito as t3 on t2.id_carrito = t3.id_carrito ";
        $sql .= "where t3.id_usuario = '$id_user' ";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlAumentarCantidad($des,$carrito,$id_pro){
        include("bd-conect/inclucion-bd.php");
        if($des == 1)$operacion = "+";
        if($des == 2)$operacion = "-";
        $sql = "update tb_carypro ";
        $sql .= "set cantidad_de_productos = cantidad_de_productos $operacion 1 ";
        $sql .= "where id_carrito = '$carrito' and id_producto = '$id_pro' ";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlRestriccionCarrito($id_user,$id_pro){
        include("bd-conect/inclucion-bd.php");
        $sql = "select count(*) from tb_carypro as t1  ";
        $sql .= "inner join tb_carrito as t2 on t1.id_carrito = t2.id_carrito ";
        $sql .= "where t2.id_usuario = '$id_user' and t1.id_producto = '$id_pro' ";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlValoracion($id_pro,$id_user){
        include("bd-conect/inclucion-bd.php");
        $sql = "INSERT INTO tb_valoracion(id_producto,id_usuario) ";
        $sql .= "values('$id_pro','$id_user')";
        return $resulatdo = $conexion->query($sql);

    }

    public static function sqlContarValoracion($valoracion,$id_pro){
        include("bd-conect/inclucion-bd.php");
        $sql = "select count(*) from tb_valoracion ";
        $sql .= "where id_producto = '$id_pro' and valoracion = '$valoracion';";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlLikes($des,$id_user,$id_pro,$valoracion = null){
        include("bd-conect/inclucion-bd.php");
        if($des == 1 )$sql = "select count(*) from tb_valoracion ";
        if($des == 2 ) $sql = "delete from tb_valoracion ";
        if($des == 3 )$sql = "update tb_valoracion set valoracion = '$valoracion'";
        if($des == 4 )$sql = "select valoracion from tb_valoracion ";
        if($des == 5 )$sql = "select id_usuario from tb_valoracion ";
        $sql .= "where id_usuario = '$id_user' and id_producto = '$id_pro' ";
        return $resulatdo = $conexion->query($sql);
    }

    public static function sqlRegiones($des,$valor = null){
        include("bd-conect/inclucion-bd.php");
        $continuacion = " ";
        if($des == 1){
            $dato = "*";$tabla = "tb_departamentos";
        }
        if($des == 2){
            $dato = "*";$tabla = "tb_municipios";
        }
        if($des == 3){
            $dato = "departamento";$tabla = "tb_departamentos"; $continuacion = "where id_departamento = $valor";
        }
        if($des == 4){
            $dato = "municipio";$tabla = "tb_municipios"; $continuacion = "where id_municipio = $valor";
        }
        $sql = "SELECT $dato FROM $tabla $continuacion ";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlCompras($id_user,$depar,$munici,$telefono,$barrio,$direccion,$nombre,$email){
        include("bd-conect/inclucion-bd.php");
        $sql = "INSERT INTO tb_compras(id_usuario,departamento,municipio,telefono,barrio,direccion,fecha_de_compra,cliente,correo)";
        $sql .= "values('$id_user','$depar','$munici','$telefono','$barrio','$direccion',now(),'$nombre','$email')";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlCountCompras(){
        include("bd-conect/inclucion-bd.php");
        $sql = "select id_compra  from tb_compras order by id_compra desc limit 1;";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlProduCompra($id_compra,$id_pro,$cantidad,$precio){
        include("bd-conect/inclucion-bd.php");
        include_once("clas-functions.php");
        include_once("clas-producto.php");
        $sql = "INSERT INTO tb_facturas(id_compra,id_producto,producto,cantidades,sub_valor)values";
        $limite = count($id_pro)-1;
        for($i = 0;$i <$limite; $i ++){
            $can = $cantidad[$i];
            $valor = Funciones::intDinero($precio[$i]);
            $total = Funciones::strDinero(intval($valor) * intval($can));
            $_SESSION['totalCompra'] += intval($valor) * intval($can);
            $porducto = Producto::productos(1,$id_pro[$i]);
            //Sql para insertra los articulos comprados;
            $sql .= "('$id_compra','$id_pro[$i]','$porducto','$can','$total')";
            if($i != $limite-1){
                $sql .= ",";
            }
        }
       return $resultado = $conexion->query($sql);
    }

    public static function sqlComprasUni($id_compra,$id_pro,$cantidad,$precio){
        include("bd-conect/inclucion-bd.php");
        include_once("clas-producto.php");
        $porducto = Producto::productos(1,$id_pro);
        $sql = "INSERT INTO tb_facturas(id_compra,id_producto,producto,cantidades,sub_valor)";
        $sql .= "values('$id_compra','$id_pro','$porducto','$cantidad','$precio')";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlBorraComporaAU($des,$id_compra,$id_user = null){
        include("bd-conect/inclucion-bd.php");
        $sql = "delete from ";
        if($des == 1) $sql .= "tb_compras where id_compra = '$id_compra' and id_usuario = '$id_user'";
        if($des == 2) $sql .= "tb_facturas where id_compra = '$id_compra'";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlVaciarCarrito($id_carrito){
        include("bd-conect/inclucion-bd.php");
        $sql  = "delete from tb_carypro ";
        $sql .= "where id_carrito = '$id_carrito'";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlActualizarCantidadesMax($id_pro,$cantidad){
        include("bd-conect/inclucion-bd.php");
        $limite = count($id_pro)-1;
        for($i = 0;$i <$limite; $i ++){
            $can = intval($cantidad[$i]);
            $pro = $id_pro[$i];
            $sql = "update tb_productos ";
            $sql .="set cantidades = cantidades - '$can' ";
            $sql .="where id_producto = '$pro'";
            $conexion->query($sql);
        }
    }
    public static function sqlActualizarCantidadesUni($id_pro,$cantidad){
        include("bd-conect/inclucion-bd.php");
            $sql = "update tb_productos ";
            $sql .="set cantidades = cantidades - '$cantidad' ";
            $sql .="where id_producto = '$id_pro'";
            $conexion->query($sql);
    }
    public static function sqlVerCompra($id_user){
        include("bd-conect/inclucion-bd.php");
        $sql  = "select * from tb_compras as t1 ";
        $sql .= "inner join tb_usuarios as t2 on t1.id_usuario = t2.id ";
        $sql .= "where t1.id_usuario = '$id_user'";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlFactura($des,$id_user,$id_compra){
        include("bd-conect/inclucion-bd.php");
        $limit = "limit 1";
        if($des == 1)$valor = "t1.id_compra";
        if($des == 2)$valor = "t2.fecha_de_compra";
        if($des == 3)$valor = "t4.nombre";
        if($des == 4)$valor = "t4.apellido";
        if($des == 5)$valor = "t2.municipio";
        if($des == 6)$valor = "correo";
        if($des == 7)$valor = "t2.direccion";
        if($des == 8)$valor = "t2.barrio";
        if($des == 9){
            $valor = "t1.cantidades";$limit ="";
        }
        if($des == 10){
            $valor = "producto";$limit ="";
        }
        if($des == 12){
            $valor = "sub_valor";$limit ="";
        }
        $sql  = "select $valor from tb_facturas as t1 ";
        $sql .= "inner join tb_compras as t2 on t1.id_compra = t2.id_compra ";
        $sql .= "inner join tb_usuarios as t4 on t2.id_usuario = t4.id ";
        $sql .= "where t4.id = '$id_user' and t2.id_compra = '$id_compra' $limit";
        //echo $sql;
        return $resultado = $conexion->query($sql);
    }

    public static function sqlEliminarDelCarrito($carrito,$id_pro){
        include("bd-conect/inclucion-bd.php");
        $sql = "DELETE  FROM tb_carypro ";
        $sql .= "where id_carrito = '$carrito' and id_producto = '$id_pro'";
        return $resultado = $conexion->query($sql);
    }

    public static function sqlVentas(){
      include("bd-conect/inclucion-bd.php");
      $sql  = "select DISTINCT producto,";
      $sql .= "(select cantidades from tb_facturas as t2 where t1.id_producto = t2.id_producto )  ";
      $sql .= "from tb_facturas as t1  ";
      return $resultado = $conexion->query($sql);
    }

    public static function sqlComprasDelUsuario(){
      include("bd-conect/inclucion-bd.php");
      $sql  = "select DISTINCT nombre,";
      $sql .= "(select count(*) from tb_compras as  t3 where  t1.id = t3.id_usuario ) ";
      $sql .= "from tb_usuarios as t1  ";
      $sql .= "inner join tb_compras as t2 on t1.id = t2.id_usuario";
      return $resultado = $conexion->query($sql);
    }

    public static function sqlActualizarTotalCompra($id_compra,$id_user){
        include("bd-conect/inclucion-bd.php");
        $sql = "update tb_compras ";
        $sql .="set total_compra = '".$_SESSION['totalCompra']."' ";
        $sql .="where id_compra = '$id_compra' and id_usuario = '$id_user'";
        $_SESSION['totalCompra'] = 0; 
        $conexion->query($sql);
    }

}
