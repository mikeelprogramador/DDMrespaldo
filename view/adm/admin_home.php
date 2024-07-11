<form class="d-flex" role="search">
  <input class="form-control me-2" id="barra-search" type="search" placeholder="Buscar productos" aria-label="Search" onkeypress="pulsar(event)">
  <button class="btn btn-outline-success " type="button" id="boton"  onclick="buscarProductos(1)">Buscar</button>
</form>


<center>
<br>
<div class="subContainer" id="subContainer">
  <?php
    
    echo Vista::mostrarProductos();
  ?>
</div>

</center>