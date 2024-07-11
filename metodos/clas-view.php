<?php
if(! isset($_SESSION))session_start();
if(! isset($_SESSION['token'])) $_SESSION['token'] = "";
class Vista{
    /**
     * Funcion para buscar y moestar la flast card de los productos
     */
    public static function mostrarProductos($text = null,$des = null,$cate = null) {
        include_once("modelo.php");
        include_once("../../cajon/bootstrap/bootstrap.php");
        $salida = '<div class="container mt-4">'; 
        $salida .= '<div class="row">';  
        $token = token::Obtener_token(64);
        $_SESSION['token'] = $token; 
        $consulta = Model::sqlMostrarProductos($text,$des,$cate);
        while ($fila = $consulta->fetch_assoc()) {
            $id = id::encriptar($fila['id_producto']);
            $salida .= '<div class="col-sm-6 col-md-4 col-lg-3 mb-4">'; 
            $salida .= '<div class="card h-100" style="width: 100%;">';  
            $salida .= '<img src="'.$fila['img'].'" class="card-img-top" alt="La imagen no ha sido ubicada">';
            $salida .= '<div class="card-body d-flex flex-column">';
            $salida .= '<h5 class="card-title">'.$fila['producto_nombre'].'</h5>';
            $salida .= '<p class="card-text">COP $ '.$fila['precio'].'</p>';
            $salida .= '<p class="card-text">'.$fila['descripcion_producto'].'</p>';
            $salida .= '<a href="../../descripcion/acerca_del_producto/product.php?http='.urlencode($token).'&data='.$id.'" class="btn btn-primary mt-auto"  >Comprar</a>';  
            $salida .= '</div>';
            $salida .= '</div>';
            $salida .= '</div>';
        }
        $salida .= '</div>'; 
        $salida .= '</div>';  
        return $salida;
    }
    /**
     * Funcion de peticion asincrona para busacr los productos en tiempo real
     */
    public static function buscarProducto($text = null, $des = null){
        include_once("modelo.php");
        include_once("../../cajon/bootstrap/bootstrap.php");
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
    
        $consulta = Model::sqlMostrarProductos($text,$des);
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
            $salida .= "<td><button type='button' onclick='decision(\"{$fila[0]}\")'>Eliminar</button></td>"; 
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
    include_once("modelo.php");
    include_once("clas-producto.php");
    include_once("../../cajon/bootstrap/bootstrap.php");

    $salida = "";
    $consulta = Model::sqlverificarProducto($id, 1);

    while ($fila = $consulta->fetch_array()) {
        $productoId = id::encriptar($fila[0]);
        $like = Producto::contarValoracion(0, $fila[0]);
        $deslike = Producto::contarValoracion(1, $fila[0]);

        $salida .= "<div class='producto' id='actualizar'>";
        $salida .= "<div class='row' >";
        $salida .= "<div class='col-md-6' id='producto-imagen'><img src='" .$fila[6] . "' alt='Producto' class='img-fluid'></div>"; // imagen del producto
        $salida .= "<div class='col-md-6' id='producto-detalles'>";
        $salida .= "<h2 class='producto-nombre' style='color: #c29349;'>" . $fila[1] . "</h2>";
        $salida .= "<p class='producto-descripcion'>" . $fila[2] . "</p>";
        $salida .= "<p class='producto-caracteristicas'><strong>Características: </strong>" . $fila[3] . "</p>";
        $salida .= "<p class='producto-colores'><strong>Cantidades disponibles: </strong>" . $fila[4] . "</p>";
        $salida .= "<p class='producto-cantidad'><strong>Colores </strong>" . $fila[8] . "</p>";
        $salida .= "<p class='producto-precio'><strong>Precio: </strong>" . $fila[7] . "</p>";
        $salida .= "<p class='producto-ofertas'><strong>Ofertas: </strong>" . $fila[5] . "</p>";
        $salida .= "<button class='btn btn-primary' type='button' id='incremento' onclick='incremento()'>+</button>";
        $salida .= "<input type='number' id='contador' class='form-control' value='1' min='1' max='" . $fila[4] . "' disabled>";
        $salida .= "<button class='btn btn-primary' type='button' id='decremento' onclick='decremento()'>-</button>";
        $salida .= "<div class='like-container'>";
        $salida .= "<img src='../../img/como.png' alt='Me Gusta' id='like-icon' class='reaction-icon' onclick='toggleLike(\"{$productoId}\")'>$like";
        $salida .= "<img src='../../img/disgusto.png' alt='No Me Gusta' id='dislike-icon' class='reaction-icon' onclick='toggleDislike(\"{$productoId}\")'>$deslike";
        $salida .= "</div>";
        $salida .= "<a class='btn btn-primary producto-comprar' id='enlace' onclick='enviarDatos(2,\"{$token}\",\"{$productoId}\")' >Compra ahora</a><br>";
        $salida .= "<a class='btn btn-primary producto-comprar' onclick='enviarDatos(1,\"{$token}\",\"{$productoId}\")' >Agregar al carrito</a>";
        $salida .= "</div>";
        $salida .= "</div>";
        $salida .= "</div>";
    }
    return $salida;
}

    
    

    /**
     * Metodo para visuarliza los comentarios
     */
    public static function viewComentarios($id_pro,$id_user){
        include_once("modelo.php");
        $salida = "";
        $consulta = Model::sqlViewComentarios($id_pro);
        while($fila = $consulta->fetch_array()){
            $salida .= $fila[0]."<br>";
            $salida .= $fila[1]."<br>";
            $salida .= $fila[2]."<br>";
            if( $fila[3] == $id_user){
                $salida.= "<button>Editar</button><br>";
                $salida.= "<button onclick='eliminarComentario(\"$fila[4]\",\"$id_pro\")'>Eliminar</button><br>";
            }
            $salida .= "<button>Responder</button><br><br>";
        }
        return $salida;
    }

    public static function perfil($id_user,$des){
        include_once("modelo.php");
        $salida = "";
        $consulta = Model::sqlUsuario(3,$id_user);
        while($fila = $consulta->fetch_array()){
            $salida .= "<div class='container mt-5'>";
            $salida .= "<div class='row justify-content-center'>";
            $salida .= "<div class='col-md-4'>";
            $salida .= "<div class='circle text-center bg-primary text-white rounded-circle' >";
            $salida .= "<img src='$fila[8]' class='img-fluid' id='imagen_perfil' alt='No cargaste la imagen en la base' onmouseenter='cambiarFoto(this)'>";
            $salida .= "</div>";
            $salida .= "</div>";
            $salida .= "<div class='col-md-8'>";
            $salida .= "<div class='mb-3'>";
            $salida .= "<label class='form-label'>Nombre</label>";
            $salida .= "<input type='text' class='form-control' id='edit_nombre' value='$fila[1]' disabled>";
            $salida .= "</div>";
            $salida .= "<div class='mb-3'>";
            $salida .= "<label class='form-label'>Apellido</label>";
            $salida .= "<input type='text' class='form-control' id='edit_apellido' value='$fila[2]' disabled>";
            $salida .= "</div>";
            $salida .= "<div class='mb-3'>";
            $salida .= "<label class='form-label'>Correo</label>";
            $salida .= "<input type='text' class='form-control' value='$fila[3]' disabled>";
            $salida .= "<input type='file' class='form-control' id='foto_perfil' onchange='mostrarImagen(event,$des)' ";
            $salida .= "</div>";
            $salida .= "<div class='mb-3'>";
            $salida .= "<button type='button' class='btn btn-primary' onclick='editarDatos()'>Editar datos</button>";
            $salida .= "<button type='button' class='btn btn-secondary ms-2' id='boton_correo'>Cambiar correo</button>";
            $salida .= "<button type='button' class='btn btn-secondary ms-2' id='boton_contraseña'>Cambiar contraseña</button>";
            $salida .= "<button type='button' class='btn btn-secondary ms-2' id='delete_img' onclick='eliminarFoto()'>Eliminar foto</button>";
            $salida .= "</div>";
            $salida .= "</div>";
            $salida .= "</div>";
            $salida .= "</div>";
        }
        return $salida; 
    }

    public static function mostrarCategorias($des){
        include_once("modelo.php");
        $salida = "";
        $consulta = Model::sqlMostrarCategorias();
        while($fila = $consulta->fetch_array()){
            if($des == 1){
                $salida .= "<li><a class='dropdown-item' href='ddm.php?seccion=categorias&cate=$fila[1]'>$fila[1]</a></li>";
            }
            if($des == 2){
                $salida .= "<input type=checkbox  name=categoria$fila[0] value=$fila[0] >$fila[1] <br>";
            }
        }
        return $salida;
    }

    public static function mostrarCarrito($des,$id_user){
        include_once("../../cajon/bootstrap/bootstrap.php");
        include_once("modelo.php");
        include_once("clas-functions.php");
        $salida = "";
        $consulta = Model::sqlMostrarCarrito($des,$id_user);
        while($fila = $consulta->fetch_assoc()){
            $id = id::encriptar($fila['id_producto']);
            $valor = Funciones::intDinero($fila['precio']);
            $cantidad = floatval($fila['cantidad']);
            if($fila['cantidades'] == 0){
                $carrito = Carrito::buscarCarrito($id_user);
                Model::sqlEliminarDelCarrito($carrito,$fila['id_producto']);
                header("location: ddm.php?seccion=carrito");
            }
            $salida .= '<div class="container mt-4">'; 
            $salida .= '<div class="row">';
            $salida .= '<div class="col-sm-6 col-md-4 col-lg-3 mb-4">'; 
            $salida .= '<div class="card h-100" style="width: 100%;">';  
            $salida .= '<img src="'.$fila['img'].'" class="card-img-top" alt="La imagen no ha sido ubicada">';
            $salida .= '<div class="card-body d-flex flex-column">';
            $salida .= '<h5 class="card-title">'.$fila['producto_nombre'].'</h5>';
            $salida .= '<p class="card-text">COP $ '.$fila['precio'].'</p>';
            $salida .= "<button class='btn btn-primary' type='button' id='incremento' onclick='sumarCantidad(\"$id\",\"{$fila['cantidad']}\",\"{$fila['cantidades']}\")'>+</button>";
            $salida .= '<input type="number" id="cantidad" class="form-control" value="'.$fila['cantidad'].'" min="1" max="'.$fila['cantidades'].'" disabled>';
            $salida .= "<button class='btn btn-primary' type='button' id='decremento' onclick='restarCantidad(\"$id\",\"{$fila['cantidad']}\")'>-</button>";
            $salida .= '<p class="card-text"> Valor total: '.number_format($valor*$cantidad, 2, ',', '.').'</p>';
            $salida .= '<button class="btn btn-primary mt-auto" >Eilimar del carrtio</button>';
            $salida .= '</div>';
            $salida .= '</div>';
            $salida .= '</div>';
            $salida .= '</div>'; 
            $salida .= '</div>';
        }
        return $salida;
    }

    public static function regiones($des,$id_region = null){
        include_once("modelo.php");
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

    

    public static function verCompras($id_user){
        include_once("../../cajon/bootstrap/bootstrap.php");
        include_once("modelo.php");
        $salida = "<div class='contenido'>";
        $consulta = Model::sqlVerCompra($id_user);
        while($fila = $consulta->fetch_assoc()){
            $compra = id::encriptar($fila['id_compra']);
            $salida .= "<div class='compra'>";
            $salida .= "<div class='compra-info'>";
            $salida .= "<p class='compra-codigo'>Código de compra: ".$fila['id_compra']."</p>";
            $salida .= "<p class='compra-usuario'>".$fila['nombre']." ".$fila['apellido']."</p>";
            $salida .= "<p class='compra-departamento'>Departamento: ".$fila['departamento']."</p>";
            $salida .= "<p class='compra-municipio'>Municipio: ".$fila['municipios']."</p>";
            $salida .= "<p class='compra-total'>Total: ".$fila['total_compra']."</p>";
            $salida .= "</div>";
            $salida .= "<div class='compra-opciones'>";
            $salida .= "<a class='compra-factura' href='../../descripcion/factura.php?code=".$compra."'>Ver factura</a>";
            $salida .= "</div>";
            $salida .= "</div>";
        }
        $salida .= "</div>"; // cierre del contenedor de contenido
        return $salida;
    }
    
    
    
    

    public static function factura($des,$id_user,$id_compra,$des2 = null){
        include_once("modelo.php");
        $salida = "";
        $consulta = Model::sqlFactura($des,$id_user,$id_compra);
        while($fila = $consulta->fetch_array()){
            $salida .= $fila[0];
            if($des >8)$salida .="<br><br>";
        }
        if($des2 == 'total')$salida = str_replace("<br><br>"," ",$salida);
        return $salida;
    }



}    