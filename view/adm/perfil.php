<link rel="stylesheet" href="../../css/perfiladmin.css">

<!-- Barra de navegacion delperfil -->
<div class="con"> 
  
  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Más informacion</a>
  <ul class="dropdown-menu custom-dropdown">
    <li><a class="dropdown-item" href="admin.php?seccion=historial">Historial</a></li>
    <hr>
    <li><a class="dropdown-item" href="admin.php?seccion=megustas">Productos que me gustaron</a></li>
    <hr>
    <li><a class="dropdown-item" href="admin.php?seccion=comentarios">Comentarios</a></li>
    <div id="contenido_sub-contenedor">
    <hr>
    <li><a class="dropdown-item" onclick="regresarPerfil()">Regresar</a></li>
    </div>
    
  </ul>


<!-- contenedor obsiones de usuario -->
<div class="sub-contenedor" id="sub-contenedor">
  <!-- contendor 1 -->
  <div class="option" onclick="cambiarDato(1)">
    Cambiar contraseña
  </div>
  <!-- contenedor 4 -->
  <div class="option" onclick="datosUsuario()">
  Cambiar datos
  </div>
  <!-- conteneodor 3 -->
  <div class="option" onclick="eliminarFoto();">
      Eliminar foto
  </div>
  <!-- contenedor 5 -->
  <div class="option" onclick="deleteCuenta(1);">
    Eliminar Cuenta
  </div>

</div>

<div class="container mt-5" id="datos-usuario">
  <div class="card p-4">
    <label for="actualizarNombre">Nombre</label>
    <input type="text" class="form-control mb-3" value="<?php echo Usuarios::datosUsuario(1,$_SESSION['id'])?>" id="actualizarNombre" disabled>
      
    <label for="actualizarApellido">Apellido</label>
    <input type="text" class="form-control mb-3" value="<?php echo Usuarios::datosUsuario(2,$_SESSION['id'])?>" id="actualizarApellido" disabled>
      
    <label for="actualizarEmail">Email</label>
    <input type="email" class="form-control mb-3" value="<?php echo Usuarios::datosUsuario(3,$_SESSION['id'])?>" id="actualizarEmail" disabled>
      
      <div class="d-flex justify-content-between">
        <button class="btn btn-primary" onclick="habilitarActu(1)"  id="habiliatarActualizacion">Actualizar</button>
        <button class="btn btn-secondary" onclick="devolver('datos-usuario')" id="regresar">Regresar</button>
        <button class="btn btn-success" onclick="actualizarDatos()" id="actualizar">Actualizar datos</button>
        <button class="btn btn-danger" onclick="habilitarActu(2)" id="cancelar">Cancelar</button>
      </div>
  </div>
</div>

<!-- cambio de correo o de contraseñas -->
<div id="cambio">
  <div id="mensaje"></div>
  <p id="mensajeCorreo"></p>
  <p id="dato"></p>
  <form action="../controller/controller_user.php?saveDato" method="post" onsubmit="enviarCorreo(event,1)">
    <label for="">Correo</label>
    <input type="text" id="correo" name="correo" placeholder="email@gmail.com" required> 
    <input type="submit">
  </form>
  <button class="btn btn-secondary" onclick="devolver('cambio')">Regresar</button>

</div>


<!-- perfil -->
<div>
<center>

<div class="perfil" id="perfil">
    <?php
        echo Vista::perfil($_SESSION['id'],1);
    ?>
</div>
</center>
</div>


</div> <br><br>






