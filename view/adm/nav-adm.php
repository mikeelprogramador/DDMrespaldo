<!doctype html>
<html lang="es">
<head>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-05CZXNWMZE"></script>
  <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-05CZXNWMZE');
  </script> 

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DDM</title>
  <link rel="stylesheet" href="../../css/stylo1.css">
  <link rel="stylesheet" href="../../css/style-nav-right.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="body">

<nav class="navbar navbar-expand-lg bg-gris-oscuro custom-navbar" id="nav">
  <div class="container-fluid">
    <img src="../../img/Imagen3.png" alt="Logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin.php?seccion=admin_home">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Productos
          </a>
          <ul class="dropdown-menu custom-dropdown">
            <li><a class="dropdown-item" href="admin.php?seccion=seccion-ag-pro">Agregar productos</a></li>
            <li><a class="dropdown-item" href="admin.php?seccion=seccion-ac-pro">Acerca de los productos</a></li>
          </ul>
        </li>     
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Estadisticas
          </a>
          <ul class="dropdown-menu custom-dropdown">
            <li><a class="dropdown-item" href="admin.php?estadisticas=ventas&seccion=estadisticas">Estadisticas de Ventas</a></li>
            <li><a class="dropdown-item" href="admin.php?estadisticas=ingresosMes&seccion=estadisticas">Ingresos Mes</a></li>
            <li><a class="dropdown-item" href="admin.php?estadisticas=ingresosTotales&seccion=estadisticas">Ingresos Totales</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Otras opciones
          </a>
          <ul class="dropdown-menu custom-dropdown">
            <li><a class="dropdown-item" href="admin.php?seccion=ofertas">Ofertas</a></li>
            <li><a class="dropdown-item" href="admin.php?seccion=categoria">Categorias</a></li>
          </ul>
        </li>
        <?php if( Usuarios::verificarPerfil(1,$_SESSION['id']) == 0): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Administracion
            </a>
            <ul class="dropdown-menu custom-dropdown">
              <li><a class="dropdown-item" href="admin.php?seccion=seguimiento_usuarios">Seguimiento de Usuarios</a></li>
              <li><a class="dropdown-item" href="admin.php?seccion=create-user">Crear Usuario</a></li>
            </ul>
          </li>
        <?php endif; ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="avatar">
              <img src='<?php echo Usuarios::fotoPerfil($_SESSION['id']) ?>' id="foto_avatar">
            </div>
            <?php echo Usuarios::verificarPerfil(2,$_SESSION['id'])?>
          </a>
          <ul class="dropdown-menu custom-dropdown">
            <li><a class="dropdown-item" href="admin.php?seccion=perfil">Mi perfil</a></li>
            <li><a class="dropdown-item" href="admin.php?seccion=out">Cerrar sesion</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">
            Bienvenido <?php echo Usuarios::verificarPerfil(1,$_SESSION['id'])== 0? "SuperAdmin":"Admin"?>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <?php if ($seccion == "admin_home"): ?>
    <form class="d-flex" role="search">
      <input class="form-control me-2" id="barra-search" type="search" placeholder="Buscar productos" aria-label="Search" onkeypress="pulsar(event)">
      <button class="btn btn-outline-success" type="button" id="boton" onclick="buscarProductos(0)">Buscar</button>
    </form>
  <?php endif; ?>
</nav>

<div class="conteiner">
  <?php include($seccion.".php"); ?>
</div>

<?php include("jscriptAdmin.php");?>

<footer class="footer">
  <div class="container_footer text-center">
    <div class="footer-content">
      <p>&copy; <?php echo date("Y"); ?> DDM. Empresa de marketing</p>
      <p>
        <a href="#" class="text-white footer-link">Términos y condiciones</a>
      </p>
    </div>
    <div class="footer-contact">
      <p>Contáctanos:</p>
      <p>Correo: maicolsanchez211@gmail.com</p>
      <p>Teléfono: +57 3185049904</p>
    </div>
    <div class="footer-contact">
      <p>Contáctanos:</p>
      <p>Correo: judacas135@gmail.com</p>
      <p>Teléfono: +57 3219612850</p>
    </div>
  </div>
</footer>

</body>
</html>