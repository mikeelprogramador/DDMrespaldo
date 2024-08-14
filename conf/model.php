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
    public static function sqlRegistarUsuario($nombre,$apellido,$email,$newPwd){
        include("model/conexion.php");
        include_once("../class/class_sessiones.php");
        $rango = 2;
        if(isset($_SESSION['rango']))$rango = $_SESSION['rango'];
        $sql = "INSERT INTO tb_usuarios(nombre,apellido,email,pasword,fecha_registro,cate_user,foto_usuarios) ";
        $sql .= "VALUES('$nombre','$apellido','$email','$newPwd', DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p'),'$rango','../../img/logo-icon-person.jpg')";
        return $conexion->query($sql);
        $conexion->close();
        Session::EliminarRango();
    }
    /**
     * Metodo que verifica si el usuario existe, tambien muestra el rol del usuario
     * @param email {tetxo} correo  que el cliente elige para la cuenta.
     * @param newPwd {texto} contraseña incriptada que el cliente eligio para la cuenta
     */
    public static function sqlInicoSesion($email,$newPwd){
        include("model/conexion.php");
        $sql = "select (select cate_user from tb_usuarios where email = '$email' and pasword = '$newPwd' ), count(*) from tb_usuarios";
        return $conexion->query($sql);
        $conexion->close();
    }
    /**
     * Metodo para buscar o contra los usuarios
     * @param des {number} decisiones para el sql 1:realiza un conteo 
     * 2:busca el usuario por el correo 
     * 3: busca a la persona por el ahi.
     * 4 busca la actividad del usuario si esta activo o inactivo
     * @param valor {texto}  es el dato que se buscara en el sql, puede ser el correo o el codigo del usuario.
     */
    public static function sqlUsuario($des,$valor){
        include("model/conexion.php");
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
        $conexion->close();
    }
    /**
     * Metodo que verica el rol, 0: SuperAdmin, 1:Admin, 2:Cliente
     * @param des {number} decision para el sql, 1:consultar rol, 2:consultar nombre del usuario.
     * @param id_user {number} codigo del usuario.
     */
    public static function sqlVerificarPerfil($des,$id_user){
        include("model/conexion.php");
        if($des == 1){
            $dato = "cate_user";
        }if($des == 2){
            $dato = "nombre";
        }
        $sql = "select $dato from tb_usuarios where id = '$id_user'";
        return  $conexion->query($sql);
        $conexion->close();
    }
    /**
     * Metodo para hacer un conteo de los usuarios y porder ver los usuarios
     * aunque el nombre no concuerde con el metodo, este metodo sirve para crear el cidigo de un usuario
     * por eso el nombre sqlCrearIdUsuario
     * @param des {numero} es una decision, si es 1 realiza un coteo de la tabla usuarios,si es 2 muestra los 
     * de dicha tabla
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     */
    public static function sqlCraerIdUsuario($des){
        include("model/conexion.php");
        if( $des == 1) $dato = "count(*)";
        if( $des == 2) $dato = "*";
        $sql = "select $dato from tb_usuarios ";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para cambiar la contraseña del usuario cuando no recuerde dicha contraseña se activara un mecaniosmo de 
     * recuperacion y cambio de con traseña
     * @param password {texto} la contraseña por la que se remplazada en la base de datos
     * @param id_user {numero} el codigo del usuario
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     */
    public static function sqlCambiarPassword($password,$id_user){
        include("model/conexion.php");
        $sql = "update tb_usuarios  ";
        $sql .= "set pasword = '$password' ";
        $sql .= "where id = '$id_user' ";
        $conexion->query($sql);
        $conexion->close();
    }


    /**
     * Metodo para agregar un dato a la tabla histotial
     * @param id_user {numero} el codigo del usuario
     * @param id_pro {texto} el codigo del porducto
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     */
    public static function sqlAgregarHistorial($id_user,$id_pro){
        include("model/conexion.php");
        $sql = "insert into tb_historial(id_usuario,id_producto,fec_ver)";
        $sql .="values('$id_user','$id_pro',DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p'))";
        $conexion->query($sql);
        $conexion->close();
    }


    /**
     * Metodo de busqueda se diseño para saber si el correo y el codigo de la persona existen
     * en la base de datos, esto se utiliza  para verificar la existencia de la persona al enviar 
     * un correo electronico
     * @param correo {texto} correo del usuario
     * @param id_user {numero} codigo del usuario
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     */
    public static function sqlbuscarUsuario($correo,$id_user){
        include("model/conexion.php");
        $sql = "select count(*) from tb_usuarios  ";
        $sql .= "where email = '$correo' and id = '$id_user' ";
        return $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para agregar un porducto en la base de datos
     * @param id {texto} codigo del producto
     * @param nombre {texto} nombre del producto creado
     * @param descrip {texto} es la descripcion del producto
     * @param caracter {texto } caracteristicas del producto
     * @param cantidad {numero} cantidades de productos disponibles
     * @param ofertas {texto} la opferta que tendra el producto
     * @param img {texto} imagen del producto
     * @param precio {texto} el precio del producto
     * @param color {texto} el color del producto
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     */
    public static function sqlCargarProducto($id,$nombre,$descrip,$caracter,$cantidad,$oferta,$img,$precio,$color){
        include("model/conexion.php");
        $sql = "INSERT INTO tb_productos";
        $sql .= "(id_producto,producto_nombre,descripcion_producto,caracteristicas_producto,cantidades,id_ofertas,img,precio,color,fec_cre)";
        $sql.= "VALUE('$id','$nombre','$descrip','$caracter','$cantidad','$oferta','$img','$precio','$color', DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p'))";
        return  $conexion->query($sql);
        $conexion->close();
    }
    public static function sqlActualizarProducto($id,$nombre,$descrip,$caracter,$cantidad,$oferta,$img,$precio,$color){
        include("model/conexion.php");
        $sql = "update tb_productos ";
        $sql .= "set producto_nombre = '$nombre',descripcion_producto = '$descrip',caracteristicas_producto = '$caracter',";
        $sql .= "cantidades = '$cantidad',id_ofertas = '$oferta',img = '$img',precio = '$precio', color = '$color',editado_produto =  DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p') ";
        $sql .= "where id_producto = '$id' ";
        $conexion->query($sql);
        $conexion->close();
    }
    /**
     * Metodo para ha cer conteo de los productos, verifica si el codigo del producto ya exista
     * @param id {texto} codigo del producto
     * @param des {numero} 1 muestra el producto segun el id
     * 2 hace un conteo de la tabla productos con el id ingresado
     * 3 hace un conteo de la tabla facturas con el id ingresado
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     */
    public static function sqlverificarProducto($id,$des){
        include("model/conexion.php");
        if( $des == 1 ){
            $sql = "select * ";
            $tabla = "tb_productos";
        }if( $des == 2 ){
            $sql = "select count(*) ";
            $tabla = "tb_productos";
        }if( $des == 3 ){
            $sql = "select count(*) ";
            $tabla = "tb_facturas";
        }
        $sql .= "from $tabla where id_producto = '$id'";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para mostar los productos
     * @param des {numero} 1 muestra toda la tabla productoos
     * 2 muestra los productos segun una busqueda que se hace con la variable search, con un metodo textoBusqueda
     * 3 Muestra los productos segun sus ofertas con opcion de busqueda con un metodo textoBusqueda
     * esta busqueda se hace con el tercer parametor que la categoria de los productos
     * @param search {texto} este parametro es la gusqueda del prducto, se inicializa en null para que
     * para que no afecte las operacion, cuando ya no sea null se sabe que hay un texto en la variable
     * @param categoria {texto} en este paramtro esta la categoria a a la que pertenece el producto
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * En este metodo se muestran los productos, cuando el paramtro search no sea null y el parametro des sea igual a 2 o a 3 
     * se mostara los produtos con una pequeña busqueda gracias a una funcion textoBusqueda
     */
    public static function sqlMostrarProductos($des,$search = null,$categoria = null){
        include("model/conexion.php");
        if($des == 1 ){
            $sql = "select * from tb_productos ";
        }
        if( $des === 2){
            $sql = "select distinct t1.* from tb_productos as t1 ";
            $sql .="left join tb_categoriasProducto as t2 on t1.id_producto = t2.id_producto ";
            $sql .= "left join tb_categorias as t3 on t2.id_categoria = t3.id_Categoria ";
            if( $categoria == null){
                if($search != null)$sql .= Model::textoBuqueda(1,$search);
            }else{
                if($search != null){
                    $sql .= Model::textoBuqueda(2,$search);
                    $sql .= " and t3.categoria = '$categoria' ";
                }else{
                    $sql .= "where t3.categoria = '$categoria' ";
                }

            }
            
        }
        if($des === 3){
            $sql  = "select distinct t1.* from tb_productos as t1 ";
            $sql .= "inner join tb_ofertas as t4 on t1.id_ofertas = t4.idOferta ";
            $sql .= "left join tb_categoriasProducto as t2 on t1.id_producto = t2.id_producto ";
            $sql .= "left join tb_categorias as t3 on t2.id_categoria = t3.id_Categoria ";
            if($search != null){
                $sql .= Model::textoBuqueda(2,$search);
            }
        }
        $sql .= " ORDER BY RAND()";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para hacer busquedas
     * @param des {numero} 1 para que la busqueda tambien se realise por el codigo del producto
     * 2 para cerrar co parentcis las busquedas
     * @param search {texto} el texto con el que se va hace la busqueda
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Este metodo con una parametro search que tiene un texto a buscar, toma el texto y lo combierte en una array para buscar el productos
     * segun cualquir letra que este contenga, la busqueda se hace por el nombre, caracteristicas y el id
     */
    private static function textoBuqueda($des,$search){
        $palabra = explode(" ",$search);
            $sql = "where ";
            for($i = 0; $i < count($palabra); $i++){
                $sql .= "(producto_nombre like '%".$palabra[$i]."%' or descripcion_producto like '%".$palabra[$i]."%' ";
                $sql .= "or caracteristicas_producto like '%".$palabra[$i]."%'  or t3.categoria like '%".$palabra[$i]."%' ";
                if($des === 1 )$sql .=" or t1.id_producto like '%".$palabra[$i]."%')";
                if($des === 2 )$sql .=")";
                if($i != count($palabra)-1){
                    $sql .= " and ";
                }
            }
        return $sql;
    }

    /**
     * Metodo para eliminar el producto, este metodo usa una funcion de mysql la cual elimina el 
     * productos de todas las tablas
     * @param id {texto} codigo del producto    
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     */
    public static function sqlEliminarProducto($id){
        include("model/conexion.php");
        $sql = "select EliminarProductos('$id')";
        $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para eliminar comentarios
     * @param id_comen {number} codigo del comentario echo por el usuairo
     * @param id_user {number} codigo usuario
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Esta funcion hace un delet en la tabla comentarios al comentario que el usuario quiera eliminar
     */
    public static function sqlEliminarComentario($id_comen, $id_user){
        include("model/conexion.php");
        $sql = "DELETE FROM tb_comentarios ";
        $sql .= "where id_comentario = '$id_comen' and id_usuario = '$id_user' ";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para guardar los comentarios
     * @param comentarios {texto} este parametro guarda el comentario que realizo el usuario
     * @param id_producto {texto} este parametro contiene el codigo del producto
     * @param id_usuario {texto} este parametro contiene el codigo del usuario
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Este metodo hace un insert into en la tabla comentario para ingresar el comentario realizado por el usuario 
     * utiliza una funcion DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p para tarer la el año,mes,dia,hora,minuto,segundo y formato 12 horas
     * de la fecha por ejemplo 2024-07-09 09:19:22 PM
     */
    public static function sqlComentarios($comentario,$id_producto,$id_usuario){
        include("model/conexion.php");
        $sql = "INSERT INTO tb_comentarios(comentario,fechaComentario,id_producto,id_usuario)";
        $sql .= "value('$comentario',DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p'),'$id_producto','$id_usuario')";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para ver los comentario
     * @param id_pro {texto} este arametro contiene el codigo del producto 
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Este metodo se encarga se realizar una consulta sql que segun el codigo del producto mostrar los comentarios 
     * que se han realizado en el producto.
     */
    public static function sqlViewComentarios($id_pro){
        include("model/conexion.php");
        $sql = "select tb_usuarios.nombre,tb_usuarios.foto_usuarios,comentario,fechaComentario,tb_usuarios.id,id_comentario,editado ";
        $sql .= "from tb_comentarios ";
        $sql .= "inner join tb_usuarios on tb_comentarios.id_usuario = tb_usuarios.id ";
        $sql .= "inner join tb_productos on tb_comentarios.id_producto = tb_productos.id_producto ";
        $sql .= "where tb_productos.id_producto = '$id_pro' order by fechaComentario desc     ";
        return  $conexion->query($sql);
        $conexion->close();
    }



    /**
     * Metodo para actualizar el estado del usuario
     * @param des {numero} si la desicion es 1 el estado cambiara a activo 
     * por el contratio si la desicion es 2 el estado cambiara a inactivo
     * @param id_user {numero} codigo del usuario
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Este metodo en la tabla usuario el esatdo del usuario que se encuantra en el parametro id_user, y gracias a el parametro 
     * des podemos decirle que se actualize a esatdo activo o inactivo
     * 
     */
    public static function sqlActualizarEstadoUser($des,$id_user){
        include("model/conexion.php");
        if($des == 1){
            $dato = "Activo";
        }if($des == 2){
            $dato = "Inactivo";
        }
        $sql = "update tb_usuarios set status_user = '$dato' where id= ('$id_user') ";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para ver los detalles de un producto en espesifico
     * @param des {numero} este parametro contiene que un numero que segun este numero se ejecutan opciones diferentes 
     * 1 ver el nombre del producto
     * 2 ver la descripcion del producto
     * 3 ver la caracteristicas del producto
     * 4 ver la cantidades del producto
     * 5 ver la ofertas del producto
     * 6 ver la magen del producto
     * 7 ver el precio del producto
     * 8 ver el color del producto
     * 10 ver la fecha del producto
     * @param id_pro {texto} en este parametro esta el codigo del producto
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * este metodo muestra pequeñas partes que se necesiten sobre el producto
     */
    public static function sqlDetallesDelProducto($des,$id_pro){
        include("model/conexion.php");
        $tabla = "tb_productos";
        if($des == 0)$dato = "id_producto";
        if($des == 1)$dato = "producto_nombre";
        if($des == 2)$dato = "descripcion_producto";
        if($des == 3)$dato = "caracteristicas_producto";
        if($des == 4)$dato = "cantidades";
        if($des == 5)$dato = "id_ofertas";
        if($des == 6)$dato = "img";
        if($des == 7)$dato = "precio";
        if($des == 8)$dato = "color";
        if($des == 10)$dato = "fec_cre";
        $sql = "SELECT $dato FROM $tabla where id_producto = '$id_pro'";
        return  $conexion->query($sql);
        $conexion->close();

    }

    /**
     * Metodo para mostrar las categorias
     * @param des {numero}este parametro si es 1 ejecuta un select de la tabla categorias
     * 2 muestra con el id_pro en que categorias esta el producto
     * @param id_pro {texto} este parametro puede estar nulo o puede contener el codigo del producto
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Metodo para mostar las coategorias y segun una desicion puede mostar en las categorias que esta un producto
     * o solo mostrar todas las categorias
     */
    public static function sqlMostrarCategorias($des,$id_pro =null){
        include("model/conexion.php");
        if($des == 1) $sql = "select * from tb_categorias";
        if($des == 2){
            $sql = "select id_categoria,categoria,";
            $sql .= "(select id_categoria from tb_categoriasProducto as t2 where id_producto = '$id_pro' and t1.id_categoria = t2.id_categoria) ";
            $sql .= "from tb_categorias as t1";
        }
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlEliminarCategoria($idProducto){
        include("model/conexion.php"); 
        $sql = "delete from tb_categoriasProducto ";
        $sql .= "where id_producto = '$idProducto' ";
        $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para agregar categorias
     * @param des {numero} si es 1 inserta en que categorias va a estar el producto atraves de un cilo fo
     * si es dos hace muestra el codigo de la ultima categoria, para que se puede realizar un conteo con dicho
     * sql, ejemplo: en contoller_admin va a estar esta funcion con el dato dos para que muestra la el codigo de la 
     * ultima categoria para asi ejecutar un cilo for para encontra en que categorias tiene que estar el productos
     * @param categoria {texto} este parametro es un array en donde esta el codigo de la categroia 
     * @param id_pro {texto} codigo del producto
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * En este metodo si la opcion es 1 con el parametro categorias, que en su interior es un array con el codigo
     * de las categoria insertaremos dato por dato ejemplo si el productos esta en 3 categorias el cilo flor se ejecutara 
     * 3 veces ya que en la array ahi tres codigo de las categrias a las que va a pertener el productoy con una decision de
     * aprepara la coma, esta desion se hace para cuando termine el cilo for no quele con una como da más y haya un error
     * en el interprete de mysql
     */
    public static function sqlAgregarCategoria($des,$categorias = null,$id_pro = null){
        include("model/conexion.php");
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
            $sql = "select id_categoria from tb_categorias order by id_categoria desc  limit 1";
        }
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlActualizarImagen($img,$id_user){
        include("model/conexion.php");
        $sql = "UPDATE tb_usuarios ";
        $sql .= "set foto_usuarios = '$img' ";
        $sql .= "where id = '$id_user'";
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlCarrito($des,$id_user){
        include("model/conexion.php");
        if($des == 1 ){
            $sql = "INSERT INTO  tb_carrito(id_usuario)";
            $sql .= "values('$id_user')";
        }
        if($des == 2 ){
            $sql = "select count(*) from tb_carrito ";
            $sql .= "where id_usuario = '$id_user'";
        }
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlBuscarCarrito($id_user){
        include("model/conexion.php");
        $sql = "select id_carrito from tb_carrito ";
        $sql .= "where id_usuario = '$id_user'";
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlAgregarCarrito($carrito,$id_pro,$cantidad){
        include("model/conexion.php");
        $sql = "INSERT INTO tb_carypro(id_carrito,id_producto,cantidad_de_productos)";
        $sql .= "values('$carrito','$id_pro','$cantidad')";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para mostrar el coarrito
     * @param des {numero} un parametro que segun el numero es una desicion
     * 1 motrar el carrito del usuario 
     * 2 obtener el codigo del producto que se encuentra almacenado en el carrito del usuairo
     * 3 obtener las cantidades de cada producto que se encuentra en el carrtio del usuario
     * 4 obtener el precio de todos los productos que se encuentran en el carrito del usuario
     * @param id_user {numero} parametro con el codigo del usuairo
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Metodo que ejecuta un sql en el cual se muestra los productos del carrito segun el codigo de la persona
     * que se agregue en id_user y las desiciones ayuda a obtener el codigo de los productos,las cantidades y los precion
     * para cuando se realize una compra total o una compra desde el carrito
     */
    public static function sqlMostrarCarrito($des,$id_user){
        include("model/conexion.php");
        if($des == 1)$dato = "*";
        if($des == 2)$dato = "t1.id_producto";
        if($des == 3)$dato = "t2.cantidad_de_productos";
        if($des == 4)$dato = "t1.precio";
        $sql = "select $dato from tb_productos as t1 ";
        $sql .= "inner join tb_carypro as t2 on t1.id_producto = t2.id_producto ";
        $sql .= "inner join tb_carrito as t3 on t2.id_carrito = t3.id_carrito ";
        $sql .= "where t3.id_usuario = '$id_user' ";
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlAumentarCantidad($des,$carrito,$id_pro){
        include("model/conexion.php");
        if($des == 1)$operacion = "+";
        if($des == 2)$operacion = "-";
        $sql = "update tb_carypro ";
        $sql .= "set cantidad_de_productos = cantidad_de_productos $operacion 1 ";
        $sql .= "where id_carrito = '$carrito' and id_producto = '$id_pro' ";
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlRestriccionCarrito($id_user,$id_pro){
        include("model/conexion.php");
        $sql = "select count(*) from tb_carypro as t1  ";
        $sql .= "inner join tb_carrito as t2 on t1.id_carrito = t2.id_carrito ";
        $sql .= "where t2.id_usuario = '$id_user' and t1.id_producto = '$id_pro' ";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para insertar un megusta en un producto
     * @param id_pro {texto} se encuentra el codigo del producto 
     * @param id_user {numero} en este paramtro se encuntra el codigo del usuario
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * En este metodo se insertara el like o disloike que el usuario haya dado a cierto producto
     */
    public static function sqlValoracion($id_pro,$id_user){
        include("model/conexion.php");
        $sql = "INSERT INTO tb_valoracion(id_producto,id_usuario) ";
        $sql .= "values('$id_pro','$id_user')";
        return  $conexion->query($sql);
        $conexion->close();

    }

    /**
     * Metodo para contar lso megustas
     * @param valoracion {numero} aqui esta la valoracion que queramos buscar 
     * cabe aclarar que 0(es megusta ) y 1(no megusta)
     * @param id_pro {texto} en este parametro estara el codigo del producto
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Metodo para hacer un coteo de los likes o dislike que tiene un producto
     */
    public static function sqlContarValoracion($valoracion,$id_pro){
        include("model/conexion.php");
        $sql = "select count(*) from tb_valoracion ";
        $sql .= "where id_producto = '$id_pro' and valoracion = '$valoracion';";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * 
     */
    public static function sqlLikes($des,$id_user,$id_pro,$valoracion = null){
        include("model/conexion.php");
        if($des == 1 )$sql = "select count(*) from tb_valoracion ";
        if($des == 2 ) $sql = "delete from tb_valoracion ";
        if($des == 3 )$sql = "update tb_valoracion set valoracion = '$valoracion'";
        if($des == 4 )$sql = "select valoracion from tb_valoracion ";
        $sql .= "where id_usuario = '$id_user' and id_producto = '$id_pro' "; 
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlRegiones($des,$valor = null){
        include("model/conexion.php");
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
         return  $conexion->query($sql);
         $conexion->close();
    }

    /**
     *Metodo las compras
     * @param id_user {numero} parametro con el codigo del usuario
     * @param depar {texto} en este parametro esta el departamento escogido por el usuario cuando llana el 
     * formulario para la compra
     * @param munici {texto} en este parametro esta eñ municipio escoigo por el usuario
     * @param telefono {numero} parametro con el numero telefonico ingreado por el usuario
     * @param barrio {texto} parametro con el barrio de recidencia del usuario
     * @param direccion {texto} paramtro con la direccion dada por el usuario
     * @param nombre {texto} parametro con el nombre de la parsona que realizo la compra
     * @param eamil {texto} parametro con el correo electronico de la persona
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * En este metodo se agrega una compra a la tabla compras
     */
    public static function sqlCompras($id_user,$depar,$munici,$telefono,$barrio,$direccion,$nombre,$email){
        include("model/conexion.php");
        $sql = "INSERT INTO tb_compras(id_usuario,departamento,municipio,telefono,barrio,direccion,fecha_de_compra,cliente,correo)";
        $sql .= "values('$id_user','$depar','$munici','$telefono','$barrio','$direccion', DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p'),'$nombre','$email')";
         return  $conexion->query($sql);
         $conexion->close();
    }

    /**
     * Metodo para contar la contra en la que se esta realizando
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Metodo que me devuelve el codigo de la compra que se esta realizando.
     */
    public static function sqlCountCompras(){
        include("model/conexion.php");
        $sql = "select id_compra  from tb_compras order by id_compra desc limit 1;";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para realizar una compra por medio del carrito
     * @param id_compra {numero} parametro que contiene el codigo de la compra
     * @param id_pro {texto} array con el codigo de los productos que hay en el caarrito
     * @param cantidad {numero} array segun las cantidades que estan en el carrtio
     * @param precio {texto} array con el precio de todos los productos segun el carrito
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Metodo para ingresar todo los productos que haya en el corrito a la factura 
     * con un ciclo for se procede a sacar uno por uno lod datos que habia en las arrays
     * para insertarlos en una sola compra con muchos prodcutos se el precio lo convertimos en un numero,
     * ya que en la base de datos se guarda como texto, depues de hacer las operacion lo convertimos denuevo
     * en un texto para almacenarlo en la base de datos
     * se usa una variable de seccion para almacenar el total de la compra 
     * metodo intDinero combierte el precio que esta en texto a un numero 
     * metodo strDinero combierte el numero en un texto convertido en precio
     * metodo detallesDelProducto se usa para hayar el los nombre de los productos que estamos ingresando a la factura
     * por ultimo una desicion para poner la coma asi cuando termine el ciclo for el sql no tendra una coma al final 
     * del sql ejemplo (),(),
     */
    public static function sqlProduCompra($id_compra,$id_pro,$cantidad,$precio){
        include("model/conexion.php");
        include_once("../../class/class_funciones.php");
        include_once("../../class/class_producto.php");
        $sql = "INSERT INTO tb_facturas(id_compra,id_producto,producto,cantidades,sub_valor)values";
        $limite = count($id_pro)-1;
        for($i = 0;$i <$limite; $i ++){
            $can = $cantidad[$i];
            $valor = Funciones::intDinero($precio[$i]);
            $total = Funciones::strDinero(intval($valor) * intval($can));
            $_SESSION['totalCompra'] += intval($valor) * intval($can);
            $porducto = Productos::detallesDelProducto(1,$id_pro[$i]);
            //Sql para insertra los articulos comprados;
            $sql .= "('$id_compra','$id_pro[$i]','$porducto','$can','$total')";
            if($i != $limite-1){
                $sql .= ",";
            }
        }
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para compra unitaria o compra desde el producto
     * @param id_compra {numero} parametor con el codigo de la compra
     * @param id_pro {texto} parametor con el codigo del producto
     * @param cantidad {numero} parametro con la cantidades que se van a comprar del producto
     * @param precio {texto} precio del producto segun las cantidades de producto a comprar
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Metodo para ingresar en la tabla facuras la compra de un solo producto con sus caracteristicas, codigo de compra
     * codigo del producto, cantidades del producto comprado y el valor, con un metodo de una classe llamada productos 
     * sacamos el nombre del producto para tambien insertarlo en la tabla
     */
    public static function sqlComprasUni($id_compra,$id_pro,$cantidad,$precio){
        include("model/conexion.php");
        include_once("../class/class_productophp");
        $porducto = Productos::detallesDelProducto(1,$id_pro);
        $sql = "INSERT INTO tb_facturas(id_compra,id_producto,producto,cantidades,sub_valor)";
        $sql .= "values('$id_compra','$id_pro','$porducto','$cantidad','$precio')";
        return  $conexion->query($sql);
        $conexion->close();
    }

    /**
     * Metodo para borrar una compra 
     * @param des {numero} parametro que ejecuta una desicion 
     * 1 para eliminar la compra con el codigo de la compra y el codigo del usuario
     * 2 para eliminar las facturas que esten en la compra con el codigo de la compra
     * @param id_compra {numero} parametro con el codigo de la compra
     * @param id_user {numero} parametro que puede se nulo, peor tambien puede contener el codigo del usuario
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Metodo para eliminar una ejemplo en el controller_compra en la linea 64 y 108 ay dos metodos que
     * su funcion es agregar la factura a la compra, en caso de que no se agregen esas facturas a la compra
     * se ejecutara esta funcion que elimina inmediatamente la compra de la base de datos
     */
    public static function sqlBorraComporaAU($des,$id_compra,$id_user = null){
        include("model/conexion.php");
        $sql = "delete from ";
        if($des == 1) $sql .= "tb_compras where id_compra = '$id_compra' and id_usuario = '$id_user'";
        if($des == 2) $sql .= "tb_facturas where id_compra = '$id_compra'";
         return  $conexion->query($sql);
         $conexion->close();
    }

    public static function sqlVaciarCarrito($id_carrito){
        include("model/conexion.php");
        $sql  = "delete from tb_carypro ";
        $sql .= "where id_carrito = '$id_carrito'";
         return  $conexion->query($sql);
         $conexion->close();
    }

    /**
     * Metodo para actualizar lso productos segun las cantidades del carrito
     * @param id_pro {texto} array en donde se encuentrar el codigo de los productos que estan en el carrito de compras
     * @param cantidad {numero}array en donde se enctra las cantiades comopradas desde el carrito
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Metodo para actualizar las cantidades del producto segun las cantidades de articulos que compramos desde 
     * el carrito de compras, utilizamos un cilco for para las array en donde extraemos las cantidades y el codigo
     * del producto y ejecutamos el sql cada vez que que el cilo for se recargue, esto porque un update no deja acomular
     * por eso se ejecuta de en el for.
     * donde a las cantidades actuales de le restaran las cantidades compradas desde el carrtio 
     * por ejemplo si en el carrito hay 3 producto el el cilo for se ejecuta 3 veces y el update igual
     * 
     * mejorar sintaxis
     */
    public static function sqlActualizarCantidadesMax($id_pro,$cantidad){
        include("model/conexion.php");
        $limite = count($id_pro)-1;
        for($i = 0;$i <$limite; $i ++){
            $can = intval($cantidad[$i]);
            $pro = $id_pro[$i];
            $sql = "update tb_productos ";
            $sql .="set cantidades = cantidades - '$can' ";
            $sql .="where id_producto = '$pro'";
            $conexion->query($sql);
        }
        $conexion->close();
    }

    /**
     * Metodo para actualizar cantidades del porductos por la compra desde el producto o compra unitaria
     * @param id_pro {texto} parametro con el codigo del producto
     * @param cantidad {numero} paramtro con la cantidades del producto que se compro
     * @return conexion se retornal el resumtado de la confulta, osea si la consulta es exitosa retornamos true
     * de lo contrario de retorna false
     * 
     * Metodo para actualizar el producto que se compro de manera rapida o unitario o compra desde el producto
     * conde a las cantidades actuales de le restan las cantidades compradas 
     */
    public static function sqlActualizarCantidadesUni($id_pro,$cantidad){
            include("model/conexion.php");
            $sql = "update tb_productos ";
            $sql .="set cantidades = cantidades - '$cantidad' ";
            $sql .="where id_producto = '$id_pro'";
            $conexion->query($sql);
            $conexion->close();
    }
    public static function sqlVerCompra($id_user){
        include("model/conexion.php");
        $sql  = "select * from tb_compras as t1 ";
        $sql .= "inner join tb_usuarios as t2 on t1.id_usuario = t2.id ";
        $sql .= "where t1.id_usuario = '$id_user'";
         return  $conexion->query($sql);
         $conexion->close();
    }

    public static function sqlFactura($des,$id_user,$id_compra){
        include("model/conexion.php");
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
         return  $conexion->query($sql);
         $conexion->close();
    }

    public static function sqlEliminarDelCarrito($carrito,$id_pro){
        include("model/conexion.php");
        $sql = "DELETE  FROM tb_carypro ";
        $sql .= "where id_carrito = '$carrito' and id_producto = '$id_pro'";
         return  $conexion->query($sql);
         $conexion->close();
    }

    public static function sqlVentas(){
        include("model/conexion.php");
        $sql  = "select DISTINCT producto,";
        $sql .= "(select sum(cantidades) from tb_facturas as t2 where t1.id_producto = t2.id_producto )  ";
        $sql .= "from tb_facturas as t1  ";
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlComprasDelUsuario(){
        include("model/conexion.php");
        $sql  = "select DISTINCT nombre,";
        $sql .= "(select count(*) from tb_compras as  t3 where  t1.id = t3.id_usuario ) ";
        $sql .= "from tb_usuarios as t1  ";
        $sql .= "inner join tb_compras as t2 on t1.id = t2.id_usuario";
        return  $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlActualizarTotalCompra($id_compra,$id_user){
        include("model/conexion.php");
        include_once("clas-functions.php");
        $sql = "update tb_compras ";
        $sql .="set total_compra = '".Funciones::strDinero($_SESSION['totalCompra'])."' ";
        $sql .="where id_compra = '$id_compra' and id_usuario = '$id_user'";
        $_SESSION['totalCompra'] = 0; 
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlCreateCategoria($categoria){
        include("model/conexion.php");
        $sql = "INSERT INTO tb_categorias(categoria)";
        $sql .="values('$categoria')";
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlCountCategorias($categoria){
        include("model/conexion.php");
        $sql = "select count(*) from tb_categorias ";
        $sql .="where categoria = '$categoria'";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function actualizarComentario($idComentario,$comentario){
        include("model/conexion.php");
        $sql = "update tb_comentarios ";
        $sql .= "set comentario = '$comentario', ";
        $sql .= "editado = DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p')";
        $sql .= "where id_comentario = '$idComentario' ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function ResponderComentario($idComentario,$respuestas,$idUser){
        include("model/conexion.php");
        $sql = "insert into tb_respuestasComentarios(idComentario,repuesta,idUsuario,fech_repuesta)";
        $sql .="values('$idComentario','$respuestas','$idUser',DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p'))";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlBuscarOfertas($des,$oferta){
        include("model/conexion.php");
        if($des === 1 ){
            $dato = "idOferta";
            $busqueda = "oferta";
        }
        if($des === 2 ){
            $dato = "oferta";
            $busqueda = "idOferta";
        }
        $sql = "select $dato from tb_ofertas where $busqueda = '$oferta' ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlCrearOfertas($idOferta){
        include("model/conexion.php");
        $sql = "insert into tb_ofertas(oferta)";
        $sql .= "values('$idOferta')";
        $conexion->query($sql);
        $conexion->close();

    }

    public static function sqlActualizarOferta($idOferta,$oferta){
        include("model/conexion.php");
        $sql = "update tb_ofertas ";
        $sql .= "set oferta = '$oferta' ";
        $sql .= "where idOferta = '$idOferta'";
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlELiminarOferta($oferta){
        include("model/conexion.php");
        $sql = "delete from tb_ofertas where oferta = '$oferta' ";
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlEliminarHistorial($des,$idUser,$idHistorial = null){
        include("model/conexion.php");
        $sql = "delete from tb_historial ";
        if($des === 1)$sql .= "where id_usuario = '$idUser' ";
        if($des === 2)$sql .= "where id_usuario = '$idUser' and idHistorial = '$idHistorial' ";
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlActualizarCategoria($categoria,$newCategoria){
        include("model/conexion.php");
        $sql = "update tb_categorias set categoria = '$newCategoria' where categoria = '$categoria' ";
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlDeletCategoria($categoria){
        include("model/conexion.php");
        $sql = "delete from tb_categorias where categoria = '$categoria' ";
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlDeletRespuestaProducto($idComet){
        include("model/conexion.php");
        for($i = 0;$i < count($idComet); $i++){
            $sql = "delete from tb_respuestasComentarios where idComentario = '$idComet[$i]' ";
            $conexion->query($sql);
        }
        $conexion->close();
    }


    public static function sqlTotalVentas(){
        include("model/conexion.php");
        $sql = "select total_compra from  tb_compras ";
        return $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlDeleteRespuesta($idRespuesta){
        include("model/conexion.php");
        $sql = "delete from tb_respuestascomentarios where idRespuesta = '$idRespuesta' ";
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlelimiarUsuario($des,$idUser){
        include("model/conexion.php");
        if($des === 1)$sql = "delete from tb_comentarios where id_usuario = '$idUser' ";
        if($des === 2)$sql = "delete from tb_respuestascomentarios where idUsuario = '$idUser' ";
        if($des === 3)$sql = "delete from tb_carrito where id_usuario = '$idUser' ";
        if($des === 4)$sql = "delete from tb_historial where id_usuario = '$idUser' ";
        if($des === 5)$sql = "delete from tb_valoracion where id_usuario = '$idUser'";
        if($des === 6)$sql = "delete from tb_usuarios where id = '$idUser' ";
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlActauluizarUsuario($idUser,$nombre,$apellido,$correo){
        include("model/conexion.php");
        $sql = "update tb_usuarios ";
        $sql .= "set nombre = '$nombre', apellido = '$apellido', email = '$correo' ";
        $sql .= "where id = '$idUser' ";
        $conexion->query($sql);
        $conexion->close();
    }

    public static function sqlActualizarRol($idUser,$rol){
        include("model/conexion.php");
        $sql = "update tb_usuarios ";
        $sql .= "set cate_user = '$rol' ";
        $sql .= "where id = '$idUser' ";
        $conexion->query($sql);
        $conexion->close();
    }


}
