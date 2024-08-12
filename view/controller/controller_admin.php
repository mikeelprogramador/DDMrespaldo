<?php 
include_once("../../class/class_vista.php");
include_once("../../class/class_crearProducto.php");
include_once("../../class/class_funciones.php");
include_once("../../class/class_user.php");
include_once("../../conf/model.php");
include_once("../../class/class_sessiones.php");
include_once("../../class/class_producto.php");
include_once("../../class/class_ofertas.php");
include_once("../../class/class_login.php");
include_once("../../class/class_encript.php");
//Se inician las sessiones
Session::iniciarSessiones();
if(Session::verificarSesssiones() == 0 ){
  header("location: ../../index.php");
  exit();
}

//Vista administrador de los productos
if(isset($_GET['search'])){
    echo Vista::buscarProducto(2,$_GET['search']);
}

//Vista general de los productos
if(isset($_GET['busquedaGeneral'])){
    echo Vista::mostrarProductos(2,$_GET['busquedaGeneral']);
}

//Desicion para eliminar un producto
if(isset($_GET['deleteProducto']) ){
  $id = id::desencriptar($_GET['deleteProducto']);
  $idComet = Vista::comentarioProducto($id);
  if(!empty($idComet)){
    Model::sqlDeletRespuestaProducto($idComet);
  }
  Model::sqlEliminarProducto(1,$id);
  Model::sqlEliminarProducto(2,$id);
  Model::sqlEliminarProducto(3,$id);
  Model::sqlEliminarProducto(4,$id);
  Model::sqlEliminarProducto(5,$id);
  echo Vista::buscarProducto(1);
}

//Formulario para cargar productos
if(isset($_POST ['enviar'])){
  
  $id = Funciones::vacunaXxs($_POST['id-pro']);
  $nombre = Funciones::vacunaXxs($_POST['name-pro']);
  $descrip = Funciones::vacunaXxs($_POST['descrip-pro']);
  $caracter = Funciones::vacunaXxs($_POST['caracter-pro']);
  $color = Funciones::vacunaXxs($_POST['color-pro']);
  $cantidad = Funciones::vacunaXxs($_POST['cantidad-pro']);
  $precio = Funciones::vacunaXxs($_POST['precio-pro']);
  (isset($_POST['oferta'])? $oferta = $_POST['oferta']: $oferta = "");
  (isset($_POST['iva-pro'])? $iva = $_POST['iva-pro']: $iva = 0);
  ($precio > 0?$precio = Funciones::strDinero($precio):$precio = 0 );

  /*Crea una array para las categorias*/
  $categorias = [];
  for($i = 1; $i <=CrearProducto::contarCategorias(2); $i ++){
    if(isset($_POST['categoria'.$i])  != ''){
      $categorias[] = $_POST['categoria'.$i];
    }
  }
 
  //Precio con el iba
  $precio = Funciones::iva($iva,Funciones::intDinero($precio));

  if(isset($_FILES['card-img'])){
    $img  = CrearProducto::img(1,$_FILES['card-img']);//creado la imagen
    //filtro para la imagen
    if( $img == "1" || $img == "0"){
      header("location: ../adm/admin.php?menPro=img".$img."&seccion=seccion-ag-pro");
      exit();
    }
  }


  if( $img !="1" && $img != "0" && $id != "" && $nombre != ""){
    //Filtro para el produco
    if( $img != "0" && $id != "" && $nombre != ""  ){
    //Crear el producto
      $nowProducto = CrearProducto::cargarProducto($id,$nombre,$descrip,$caracter,$cantidad,$ofertas,$img,$precio,$color);
      if( $nowProducto == 1 ){
        if( !empty($categorias) )CrearProducto::agregarCategoria(1,$categorias,$id);//Se le agregan la categorias al porducto ya creado
        header("location: ../adm/admin.php?menPro=".$nowProducto."&seccion=seccion-ag-pro");//datos si el prodcucto se creo correctamente
        exit();
      }
      if( $nowProducto == 0 ){
        header("location: ../adm/admin.php?menPro=".$nowProducto."&seccion=seccion-ag-pro");//dato si ya existe
        exit();
      }
      if( $nowProducto == 2 ){
        header("location: ../adm/admin.php?menPro=".$nowProducto."&seccion=seccion-ag-pro");//dato si no se creo
        exit();
      }

    }else {
      header("location: ../adm/admin.php?menPro=2&seccion=seccion-ag-pro");
      exit();
    }
  }

}


if(isset($_FILES['foto_perfil'])){
  $files =  $_FILES['foto_perfil'] ;
  $img = CrearProducto::img(2,$files);
  if($img =="1" || $img =="0"){
    echo "limitesImg";
  }else{
    Usuarios::cargarImagen($img,$_SESSION['id']);
    echo $img;
  }
  
}

if(isset($_GET['createCategoria']) && $_GET['createCategoria'] == true){
  if(CrearProducto::countCategorias(Funciones::vacunaXxs($_GET['categoria'])) == 0){
    Model::sqlCreateCategoria(Funciones::vacunaXxs($_GET['categoria']));
    echo 1;
  }else{
    echo 0;
  }
  
}

if(isset($_POST['updateCategoria'])){
  $categoria = Funciones::vacunaXxs($_POST['categoria']);
  if(CrearProducto::countCategorias($categoria) >0){
    $newCategoria = Funciones::vacunaXxs($_POST['newCategoria']);
    Model::sqlActualizarCategoria($categoria,$newCategoria);
    echo 1;
  }else{
    echo 0;
  }
}

if(isset($_POST['deleteCategroia'])){
  $categoria = Funciones::vacunaXxs($_POST['deleteCategroia']);
  if(CrearProducto::countCategorias($categoria) >0){
    if(Vista::contarCategoriasConProductos($categoria) == 0){
      Model::sqlDeletCategoria($categoria);
      echo 1;
    }else{
      echo -1;
    }
  }else{
    echo 0;
  }
}



if(isset($_GET['aparece']) && $_GET['aparece'] == true){
  echo Vista::mostrarCategorias(2,1);
}

//Actualizar el producto
if(isset($_GET['producto']) && ($_GET['producto'])== "actualizar"){
  $id = id::desencriptar($_GET['data']);
  $nombre = Funciones::vacunaXxs($_POST['nombre_pro']);
  $descrip = Funciones::vacunaXxs($_POST['descripcion_pro']);
  $caracter = Funciones::vacunaXxs($_POST['carac_pro']);
  $color = Funciones::vacunaXxs($_POST['colores_por']);
  $cantidad = Funciones::vacunaXxs($_POST['cantidad_pro']);
  $precio = Funciones::vacunaXxs($_POST['precio_pro']); 
  $categorias = [];
  (isset($_POST['oferta'])? $oferta = $_POST['oferta']: $oferta = Productos::detallesDelProducto(5,$id));
  (isset($_POST['iva-pro'])? $iva = $_POST['iva-pro']: $iva = 0);
  ($precio > 0?$precio = Funciones::strDinero($precio):$precio = 0 );

  for($i = 1; $i <=CrearProducto::contarCategorias(2); $i ++){
    if(isset($_POST['categoria'.$i])  != ''){
      $categorias[] = $_POST['categoria'.$i];
    }
  }
  if(isset($_FILES['img_pro'])){
    $img = $_FILES['img_pro'];
    if(empty($img['name'])){
      $img = Productos::detallesDelProducto(6,$id);
    }else{
      $img  = CrearProducto::img(1,$_FILES['img_pro']);//creado la imagen
    }
  }
  $precio = Funciones::iva($iva,Funciones::intDinero($precio));
  Model::sqlActualizarProducto($id,$nombre,$descrip,$caracter,$cantidad,$oferta,$img,$precio,$color);
  if( !empty($categorias) ){
    Model::sqlEliminarCategoria($id);
    CrearProducto::agregarCategoria(1,$categorias,$id);
  }
  header("location:../adm/admin.php?actualizado=1&seccion=seccion-ac-pro");
  exit();
  
}

if(isset($_POST['offer-name'])){
  echo Ofertas::buscarOfertas($_POST['offer-name']);
}

if(isset($_POST['create-offer-name'])){
  $oferta = Funciones::vacunaXxs($_POST['create-offer-name']);
  if(Ofertas::contarOfertas($oferta) == 0){
    Model::sqlCrearOfertas($oferta);
    echo 0 ;
  }else{
    echo 1;
  }
}

if(isset($_POST['update-offer'])){
  $idOferta = $_POST['id-offer'];
  $oferta = Funciones::vacunaXxs($_POST['update-offer']);
  Model::sqlActualizarOferta($idOferta,$oferta);
  echo 1;
}

if(isset($_POST['delete-offer'])){
  $oferta = Funciones::vacunaXxs($_POST['delete-offer']);
  if(Ofertas::contarOfertas($oferta) == 1){
    Model::sqlELiminarOferta($oferta);
    echo 1 ;
  }else{
    echo 0;
  }
}

if(isset($_GET['createUsuario'])){
    $email = Funciones::vacunaXxs($_POST['email']);
    $password = Funciones::vacunaXxs($_POST['clave']);
    $nombre = Funciones::vacunaXxs($_POST['nom']);
    $apellido = Funciones::vacunaXxs( $_POST['apellido']);
    if(isset($_POST['rango'])){
      $rango = $_POST['rango'];
    }else{
      $rango = "";
    }
    if($rango === "" ){
      $registro = Login::registrar($nombre,$apellido,$email,$password);
    }else{
      $_SESSION['rango'] = $rango;
      $registro = Login::registrar($nombre,$apellido,$email,$password);
    }
  if($registro === 1){
    header("location: ../adm/admin.php?correct");
    exit();
  }else{
    Session::EliminarRango();
    header("location: ../adm/admin.php?error");
    exit();
  }
}

if(isset($_POST['datoUsuario'])){
  if(isset($_SESSION['usuarioRango'])&& $_SESSION['usuarioRango'] != ""){
    $idUser = id::desencriptar($_SESSION['usuarioRango']);
    if(Usuarios::verificarPerfil(1,$idUser) === "0"){
      echo  0;
    }else{
      Model::sqlActualizarRol($idUser,$_POST['rango']);
      echo  1;
    }
  }else{
    echo  -1;
  }
  $_SESSION['usuarioRango'] = "";
}


if(isset($_POST['UsuarioEditar'])){
  $_SESSION['usuarioRango'] = $_POST['UsuarioEditar'];
  echo 1;
}