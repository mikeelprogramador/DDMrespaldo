<?php
include_once("class_sessiones.php");
include_once("class_token.php");
Session::iniciarSessiones();
Session::sessionToken();

class Vista{
    /**
     * Funcion para buscar y moestar la flast card de los productos
     */
    public static function mostrarProductos($des, $text = null,$cate = null) {
        include_once("../../conf/model.php");
        include_once("class_encript.php");
        include_once("class_producto.php");
        $salida = '<div class="container mt-4">';
        $salida .= '<div class="row">';
        $token = token::Obtener_token(64);
        $_SESSION['token'] = $token;
        $consulta = Model::sqlMostrarProductos($des,$text,$cate);
        $count = 0;
        if($consulta->num_rows == 0){
            $salida = 0;
        }else{
            while ($fila = $consulta->fetch_assoc()) {
                $id = id::encriptar($fila['id_producto']);
                $url = '../../descripcion/acerca_del_producto/product.php?http=' . urlencode($token) . '&data=' . $id;
                if ($count % 4 == 0 && $count != 0) {
                    $salida .= '</div><div class="row">';
                }
                $salida .= '<div class="col-sm-6 col-md-4 col-lg-3 mb-4">';
                $salida .= '<a href="' . $url . '" class="card-link">';
                $salida .= '<div class="card h-100" style="width: 100%;">';
                $salida .= '<img src="' . $fila['img'] . '" class="card-img-top" alt="La imagen no ha sido ubicada">';
                $salida .= '<div class="card-body d-flex flex-column">';
                $salida .= '<h5 class="card-title">' . $fila['producto_nombre'] . '</h5>';
                $salida .= '<p class="card-text">COP $ ' . $fila['precio'] . '</p>';
                // $salida .= '<p class="card-text">' . $fila['descripcion_producto'] . '</p>';
                $salida .= '<p class="card-text">' . Productos::calificacionProducto($fila['id_producto']) . '</p>';
                $salida .= '<a href="' . $url . '" class="btn btn-primary mt-auto">Descripcion del producto</a>';
                $salida .= '</div>';
                $salida .= '</div>';
                $salida .= '</a>';
                $salida .= '</div>';
                $count++;
            }
            $salida .= '</div>'; 
            $salida .= '</div>'; 
        }
        return $salida;
    }
    
    
    /**
     * Funcion de peticion asincrona para busacr los productos en tiempo real
     */
    public static function buscarProducto($des,$text = null){
        include_once("../../conf/model.php");
        include_once("class_encript.php");
        $salida = "<div class='table-responsive'>"; // Añade un contenedor para la tabla responsiva
        $salida .= "<table class='table table-striped table-hover'>"; // Añade clases de Bootstrap para la tabla
        $salida .= "<thead class='thead-dark'><tr>";
        $salida .= "<th scope='col'>ID</th>";
        $salida .= "<th scope='col'>Nombre</th>";
        $salida .= "<th scope='col'>Descripción</th>";
        $salida .= "<th scope='col'>Caracteristicas</th>";
        $salida .= "<th scope='col'>Precio</th>";
        $salida .= "<th scope='col'>Cantidad</th>";
        $salida .= "<th scope='col'>Imagen</th>";
        $salida .= "<th scope='col'>Editar</th>";
        $salida .= "<th scope='col'>Eliminar</th>";
        $salida .= "</tr></thead><tbody>"; // Encabezado de la tabla con clase 'thead-dark'
    
        $consulta = Model::sqlMostrarProductos($des,$text);
        while($fila = $consulta->fetch_array()){
            $id = id::encriptar($fila[0]);
            $salida .= "<tr>";
            $salida .= "<td>{$fila[0]}</td>";
            $salida .= "<td>{$fila[1]}</td>";
            $salida .= "<td>{$fila[2]}</td>";
            $salida .= "<td>{$fila[3]}</td>";
            $salida .= "<td>COP $ {$fila[7]}</td>";
            $salida .= "<td>{$fila[4]}</td>";
            $salida .= "<td><img src='{$fila[6]}' alt='Imagen del producto' class='img-fluid img-thumbnail' style='max-width: 100px; height: auto;'></td>"; // Imagen con clases de Bootstrap y estilos personalizados
            $salida .= "<td><a href='admin.php?seccion=edit&data=$id'><button type='button'>Editar</button></a></td>"; // Botón de edición con clase de Bootstrap
            $salida .= "<td><button type='button' onclick=\"decision('".id::encriptar($fila[0])."')\">Eliminar</button></td>"; 
            $salida .= "</tr>";
        }
        $salida .= "</tbody></table>";
        $salida .= "</div>"; // Cierra el contenedor de tabla responsiva
        return $salida;
    }
    /**
     * Metodo para visualizar la lista de productos
     */
    public static function ContenidoProducto($id, $token) {
        include_once("../../conf/model.php");
        include_once("clasS_producto.php");
        include_once("class_encript.php");
        include_once("class_fechas.php");
        include_once("class_ofertas.php");
    
        $salida = "";
        $consulta = Model::sqlverificarProducto($id, 1);
    
        while ($fila = $consulta->fetch_array()) {
            $productoId = id::encriptar($fila[0]);
            $like = Productos::contarValoracion(0, $fila[0]);
            $deslike = Productos::contarValoracion(1, $fila[0]);
            $salida .= "<div class='producto' id='actualizar'>";
            $salida .= "<div class='row' >";
            $salida .= "<div class='col-md-6' id='producto-imagen'><img src='" .$fila[6] . "' alt='Producto' class='img-fluid'></div>"; // imagen del producto
            $salida .= "<div class='col-md-6' id='producto-detalles'>";
            $salida .= "<h2 class='producto-nombre' style='color: #c29349;'>" . $fila[1] . "</h2>";
            $salida .= "<p class='producto-descripcion'>" . $fila[2] . "</p>";
            $salida .= "<p class='producto-caracteristicas'><strong>Características: </strong> " . $fila[3] . "</p>";
            $salida .= "<p class='producto-colores'><strong>Cantidades disponibles: </strong>" . $fila[4] . "</p>";
            $salida .= "<p class='producto-cantidad'><strong>Colores </strong>" . $fila[8] . "</p>";
            $salida .= "<p class='producto-precio'><strong>Precio: </strong>" . $fila[7] . "</p>";
            $salida .= "<p class='producto-ofertas'><strong>Ofertas: </strong>" . Ofertas::NombresOfertas($fila[5]) . "</p>";
            $salida .= "<p class='producto-precio'><strong id='mostra_fecha'>".Fecha::mostrarFechas($fila[9])."</strong></p>";
            if($fila[10] != null){
                $salida .= "<p class='producto-precio'><strong id='mostra_fecha'>Editado ".Fecha::mostrarFechas($fila[10])."</strong></p>";
            }
            $salida .= "<button class='btn btn-primary' type='button' id='incremento' onclick='incremento()'>+</button>";
            $salida .= "<input type='number' id='contador' class='form-control' value='1' min='1' max='" . $fila[4] . "' disabled>";
            $salida .= "<button class='btn btn-primary' type='button' id='decremento' onclick='decremento()'>-</button>";
            $salida .= "<div class='like-container' id='like-container'>";
            $salida .= self::verLikes($productoId,$like,$deslike);
            $salida .= "</div>";
            $salida .= "<a class='btn btn-primary producto-comprar' id='enlace' onclick='enviarDatos(2,\"{$token}\",\"{$productoId}\")' >Compra ahora</a><br>";
            $salida .= "<a class='btn btn-primary producto-comprar' onclick='enviarDatos(1,\"{$token}\",\"{$productoId}\")' >Agregar al carrito</a>";
            $salida .= "</div>";
            $salida .= "</div>";
            $salida .= "</div>";
        }
        return $salida;
    }
    
        public static function verlikes($productoId,$like,$deslike){
            $salida = "";
            $salida .= "<img src='../../img/como.png' alt='Me Gusta' id='like-icon' class='reaction-icon' onclick='toggleLike(\"{$productoId}\")'>$like";
            $salida .= "<img src='../../img/disgusto.png' alt='No Me Gusta' id='dislike-icon' class='reaction-icon' onclick='toggleDislike(\"{$productoId}\")'>$deslike";
            return $salida;
        }
    
    

    public static function perfil($id_user,$des){
        include_once("../../conf/model.php");
        $salida = "";
        $consulta = Model::sqlUsuario(3,$id_user);
        while($fila = $consulta->fetch_array()){

            // este es el primer contenedor 

            $salida .= "<div class='container'> ";
            $salida .= "<div class='container1 mt-5'>";
            
            $salida .= "<div class='row justify-content-center'>";
            $salida .= "<div class='col-md-4'>";
            $salida .= "<div class='circle text-center bg-primary text-white rounded-circle >";
            $salida .= "<label for='foto_perfil' id='label_foto' onclick='activarfiles()' >";
            $salida .= "<img src='$fila[8]' class='img-fluid' id='imagen_perfil' alt='No cargaste la imagen en la base' onmouseenter='cambiarMouse(this)'>";
            $salida .= "<input type='file' class='form-control' id='foto_perfil' onchange='mostrarImagen(event,$des)' ";
            $salida .= "</label>";
            $salida .= "</div>";
            $salida .= "</div>";

            $salida .= "<div class='col-md-8 ' > ";
            $salida .= "<div class='mb-3' >";
            $salida .= "<p>Nombre: ".$fila[1]."</p>";
            $salida .= "</div>";  

            $salida .= "<div class='mb-3'>";
            $salida .= "<p'>Apellido: ".$fila[2]."</p>";
            $salida .= "</div>";

            $salida .= "<div class='mb-3'>";
            $salida .= "<p'>Email: ".$fila[3]."</p>";
            $salida .= "</div>";
            $salida .= "</div>";
            $salida .= "</div>";
            $salida .= "</div>";
            $salida .= "</div>"; 
            
            // este es el segundo contenedor  

            $salida .= "<div class='con'> ";
            $salida .= "<div class='container3 mt-5' onclick='verConfiguraciones()' onmouseenter='cambiarMouse(this)'>";
            $salida .= "Configuracion de cuenta";
            $salida .= "</div>";
            $salida .= "</div>";

        }
        return $salida; 
    }

    public static function mostrarCategorias($des,$desbd,$id_pro = null){
        include_once("../../conf/model.php");
        $salida = "";
        $consulta = Model::sqlMostrarCategorias($desbd,$id_pro);
        while($fila = $consulta->fetch_array()){
            if($des == 1){
                $salida .= "<li><a class='dropdown-item' href='ddm.php?seccion=categorias&cate=$fila[1]'>$fila[1]</a></li>";
            }
            if($des == 2){
                $salida .= "<input type=checkbox  name=categoria$fila[0] value=$fila[0] >$fila[1] <br>";
            }
            if($des == 3){
                $salida .= "<option value='".$fila[1]."'>".$fila[1]."</option>";
            }
            if($des == 4){
                if($fila[0] == $fila[2]){
                    $salida .= "<input type=checkbox  name=categoria$fila[0] value=$fila[0] checked >$fila[1] <br>";
                }else{
                    $salida .= "<input type=checkbox  name=categoria$fila[0] value=$fila[0] >$fila[1] <br>";
                }
            }
        }
        return $salida;
    }

    public static function regiones($des,$id_region = null){
        include_once("../../conf/model.php");
        $salida = "";
        $consulta = Model::sqlRegiones($des,$id_region);
        while($fila = $consulta->fetch_array()){
            if($des == 1){
                $salida .="<option value='".$fila[0]."' >".$fila[1]."</option>";
            }
            if($des == 2){
                $salida .="<option value='".$fila[0]."' >".$fila[2]."</option>";
            }
            if($des == 3 || $des == 4){
                $salida .= $fila[0];
            }
           
        }
        return $salida;
    }

    
    public static function factura($des,$id_user,$id_compra,$des2 = null){
        include_once("../conf/model.php");
        $salida = "";
        $consulta = Model::sqlFactura($des,$id_user,$id_compra);
        while($fila = $consulta->fetch_array()){
            $salida .= $fila[0];
            if($des >8)$salida .="<br><br>";
        }
        if($des2 == 'total')$salida = str_replace("<br><br>"," ",$salida);
        return $salida;
    }

    public static function verUsuarios() {
        include_once("../../conf/model.php");
        include_once("class_encript.php");
        $consulta = Model::sqlCraerIdUsuario(2);
        $salida = '<div class="table-responsive">';
        $salida .= '<table class="user-table">';
        $salida .= '<thead>';
        $salida .= '<tr>';
        $salida .= '<th>Nombre</th>';
        $salida .= '<th>Email</th>';
        $salida .= '<th>Fecha de Registro</th>';
        $salida .= '<th>Rol</th>';
        $salida .= '<th>Extra</th>';
        $salida .= '<th>Editar</th>';
        $salida .= '</tr>';
        $salida .= '</thead>';
        $salida .= '<tbody>';
        
        while($fila = $consulta->fetch_array()) {
            $id = id::encriptar($fila[0]);
            $salida .= '<tr>'; 
            $salida .= '<td data-label="Nombre">' . htmlspecialchars($fila[1]) . ' ' . htmlspecialchars($fila[2]) . '</td>';
            $salida .= '<td data-label="Email">' . htmlspecialchars($fila[3]) . '</td>';
            $salida .= '<td data-label="Registro">' . htmlspecialchars($fila[5]) . '</td>';
            $salida .= '<td data-label="Rol">';
            if($fila[6] == 0) $salida .= 'SuperAdmin';
            if($fila[6] == 1) $salida .= 'Admin';
            if($fila[6] == 2) $salida .= 'Cliente';
            $salida .= '</td>';
            $salida .= '<td data-label="Extra">' . htmlspecialchars($fila[7]) . '</td>';
            $salida .= "<td data-label='Editar'><button class='btn btn-primary' onclick=\"rol('".$id."')\">Editar Rol</button></td>";
            $salida .= '</tr>';
        }
        
        $salida .= '</tbody>';
        $salida .= '</table>';
        $salida .= '</div>'; 
        
        // Contenedor para editar el rango
        $salida .= "<div class='container mt-3' id='rango'>";
        $salida .= "<select id='nuevoRango' class='form-select'>";
        $salida .= "<option disabled selected>Rango</option>";
        $salida .= "<option value='1'>Admin</option>";
        $salida .= "<option value='2'>Cliente</option>";
        $salida .= "</select>";
        $salida .= "<button class='btn btn-primary mt-2' onclick=\"editarRol()\">Cargar Nuevo rango</button>";
        $salida .= "<button class='btn btn-secondary mt-2' onclick=\"cancelarRol()\">Cancelar</button>";
        $salida .= '</div>';              
    
        return $salida;
    }

    public static function verMegustasUsuario($idUsuario){
        include_once("../../conf/model_vista.php");
        $salida = '<div class="container mt-4">';
        $salida .= '<div class="row">';
        $consulta = ModelVista::sqlMegustasUsuarios($idUsuario);
        $count = 0;
        if($consulta->num_rows == 0){
            $salida = 0;
        }else{
            while($fila = $consulta->fetch_assoc()){
                if ($count % 4 == 0 && $count != 0) {
                    $salida .= '</div><div class="row">';
                }
                $salida .= '<div class="col-sm-6 col-md-4 col-lg-3 mb-4">';
                $salida .= '<div class="card h-100" style="width: 100%;">';
                $salida .= '<img src="' . $fila['img'] . '" class="card-img-top" alt="La imagen no ha sido ubicada">';
                $salida .= '<div class="card-body d-flex flex-column">';
                $salida .= '<h5 class="card-title">' . $fila['producto_nombre'] . '</h5>';
                $salida .= '<p class="card-text">COP $ ' . $fila['precio'] . '</p>';
                $salida .= '</div>';
                $salida .= '</div>';
                $salida .= '</a>';
                $salida .= '</div>';
                $count++;
            }
            $salida .= '</div>'; 
            $salida .= '</div>';
            
        }
        return $salida;
    }

    public static function contarCategoriasConProductos($categoria){
        include_once("../../conf/model_vista.php");
        $consulta = ModelVista::sqlContarCategoriasConProductos($categoria);
        while($fila = $consulta->fetch_array()){
            $salida = $fila[0];
        }
        return $salida;
    }

    public static function comentarioProducto($idProducto){
        include_once("../../conf/model_vista.php");
        $salida = [];
        $consulta = ModelVista::sqlComentarioProducto($idProducto);
        while($fila = $consulta->fetch_array()){
            $salida[] = $fila[0];
        }
        return $salida;
    }
    
    public static function mostrarCarrito($des,$id_user){
        include_once("class_encript.php");
        include_once("../../conf/model.php");
        include_once("class_funciones.php");
        include_once("class_carrito.php");
        $salida = "";
        $consulta = Model::sqlMostrarCarrito($des, $id_user);
        if ($consulta->num_rows == 0) {
            $salida = 0;
        } else {
            while($fila = $consulta->fetch_assoc()){
                $id = id::encriptar($fila['id_producto']);
                $valor = Funciones::intDinero($fila['precio']);
                $cantidad = floatval($fila['cantidad_de_productos']);
                if ($fila['cantidades'] == 0) {
                    $carrito = Carrito::buscarCarrito($id_user);
                    Model::sqlEliminarDelCarrito($carrito, $fila['id_producto']);
                    header("location: ddm.php?seccion=carrito");
                }
                $salida .= '<div class="card h-100">';
                $salida .= '<img src="' . $fila['img'] . '" class="card-img-top" alt="Imagen no disponible">';
                $salida .= '<div class="card-body">';
                $salida .= '<h5 class="card-title">' . $fila['producto_nombre'] . '</h5>';
                $salida .= '<p class="card-text" style="color: #28a745;">COP $ ' . $fila['precio'] . '</p>';
                $salida .= "<div class='d-flex justify-content-between align-items-center'>";
                $salida .= "<button class='btn btn-primary' type='button' id='decremento' onclick='restarCantidad(\"$id\",\"$cantidad\")'>-</button>";
                $salida .= '<input type="number" id="cantidad" class="form-control" value="' . $cantidad . '" min="1" max="' . $fila['cantidades'] . '" disabled>';
                $salida .= "<button class='btn btn-primary' type='button' id='incremento' onclick='sumarCantidad(\"$id\",\"$cantidad\",\"{$fila['cantidades']}\")'>+</button>";
                $salida .= "</div>";
                $salida .= '<p class="card-text mt-3">Valor total: ' . Funciones::strDinero($valor * $cantidad) . '</p>';
                $salida .= "<button class='btn btn-danger mt-auto' onclick=\"eliminarDelCarrito('".$id."')\">Eliminar del carrito</button>";
                $salida .= "</div>";
                $salida .= "</div>";
            }
        }
        return $salida;
    }

}    