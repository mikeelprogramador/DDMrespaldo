function busquedaAdm(e){var o={search:e.target.value};$.ajax({data:o,url:"../controller/controller_admin.php",datatype:"html",method:"get",success:function(e){$("#search").html(e)},error:function(e,o,n){console.log("Erro",n)}})}function buscarProductos(e,o=null){var n,t,s=document.getElementById("barra-search").value;if(0===e&&(n="../controller/controller_admin.php",t="subContainer",mensaje=Mensajes.mensajesProductos(307,s)),1===e&&(n="../controller/controller_user.php",t="homeProductos",mensaje=Mensajes.mensajesProductos(307,s)),2===e&&(n="../controller/controller_user.php?cate="+o,t="productosCategorias",mensaje=Mensajes.mensajesProductos(308,s,o)),3===e&&(n="../controller/controller_user.php",t="ofertas-contenedor",mensaje=Mensajes.mensajesProductos(312,s)),0===e||1===e||2===e)var r={busquedaGeneral:s};else r={busquedaOfertas:s};$.ajax({data:r,url:n,datatype:"html",method:"get",success:function(e){document.getElementById(t).innerHTML="0"===e?mensaje:e},error:function(e,o,n){console.log("Erro",n)}})}function pulsar(e){13===e.which&&(e.preventDefault(),$("#boton").click())}function eliminar(e){var o={deleteProducto:e};$.ajax({data:o,url:"../controller/controller_admin.php",datatype:"html",method:"get",success:function(e){document.getElementById("search").innerHTML=e},error:function(e,o,n){console.log(n)}})}function decision(e){Swal.fire({title:Mensajes.mensajesProductos(309),text:Mensajes.mensajesProductos(310),icon:Mensajes.mensajesSeewalert(404),showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:Mensajes.mensajesGlobales(132)}).then((o=>{o.isConfirmed&&Swal.fire({title:Mensajes.mensajesGlobales(128),text:Mensajes.mensajesGlobales(133),icon:Mensajes.mensajesSeewalert(402)}).then((o=>{o.isConfirmed&&eliminar(e)}))}))}function recargar(){window.location.reload()}