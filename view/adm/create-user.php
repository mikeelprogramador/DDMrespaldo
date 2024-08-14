<link rel="stylesheet" href="../../css/usuario_creado.css">
<center>
    <p><h2>Crear cuenta</h2></p>
    <form action="../controller/controller_admin.php?createUsuario" method="post" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="nom">Nombre</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="Ingrese tu nombre" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Correo" required>
        </div>
        <div class="form-group clave">
            <label for="clave">Contraseña</label>
            <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required>
            <img id="toggle-password" class="toggle-password" src="../../img/ojo1.png" alt="Mostrar contraseña"  onclick="vercontraseña('clave',2)">
        </div>
        <div class="form-group clave">
            <label for="confirm_clave">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="confirm_clave" name="confirm_clave" placeholder="Confirmar Contraseña" required>
            <img id="toggle-confirm-password" class="toggle-password" src="../../img/ojo1.png" alt="Mostrar contraseña"  onclick="vercontraseña('confirm_clave',2)">
        </div>
        <div class="form-group clave">
        <select name="rango">
            <option  disabled selected>Rango</option>
            <option value="1">Admin</option>
            <option value="2">Cliente</option>
        </select>
        </div>
        <div id="error" class="error"></div>
        <br>
        <button type="submit" class="btn btn-primary">Crear Cuenta</button>
    </form>
</center>
<br><br>
<script src="../../js/contra_registro.js"></script>