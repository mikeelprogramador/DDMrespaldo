function cambiarMouse(e){e.style.cursor="pointer"}function activarfiles(){document.getElementById("foto_perfil").click()}function mostrarImagen(e,t){var n=new FormData,l=e.target.files[0];n.append("foto_perfil",l),1===t&&(ur="../controller/controller_user.php"),2===t&&(ur="../controller/controller_admin.php"),$.ajax({url:ur,type:"POST",data:n,dataType:"html",contentType:!1,processData:!1,success:function(e){"limitesImg"===e?alertPro(e):(document.getElementById("imagen_perfil").src=e,document.getElementById("foto_avatar").src=e)},error:function(e,t,n){console.log(n)}})}function verConfiguraciones(){document.getElementById("perfil").style.display="none",document.getElementById("sub-contenedor").style.display="block",document.getElementById("contenido_sub-contenedor").style.display="block"}function regresarPerfil(){document.getElementById("contenido_sub-contenedor").style.display="none",document.getElementById("sub-contenedor").style.display="none",document.getElementById("cambio").style.display="none",document.getElementById("perfil").style.display="block"}function cambiarDato(e){document.getElementById("sub-contenedor").style.display="none",document.getElementById("cambio").style.display="block",1===e&&(document.getElementById("mensajeCorreo").innerHTML=Mensajes.mensajesGlobales(136))}function devolver(e){document.getElementById(e).style.display="none",document.getElementById("sub-contenedor").style.display="block"}function eliminarFoto(){alertdelet(Mensajes.mensajesSeewalert(403),Mensajes.mensajesGlobales(138),Mensajes.mensajesGlobales(139),1)}function eliminarFotoPerfil(e){var t={};1===e&&(t.cambiarFoto=""),2===e&&(t.elimarCuenta=""),$.ajax({data:t,url:"../controller/controller_user.php",datatype:"texto",method:"get",success:function(e){document.getElementById("imagen_perfil").src=e,document.getElementById("foto_avatar").src=e,alertNormales(Mensajes.mensajesSeewalert(402),Mensajes.mensajesGlobales(141),Mensajes.mensajesGlobales(142))},error:function(e,t,n){console.log(n),alertNormales(Mensajes.mensajesSeewalert(401),Mensajes.mensajesGlobales(102),Mensajes.mensajesGlobales(143))}})}function deleteCuenta(e){1===e&&alertdelet(Mensajes.mensajesSeewalert(404),Mensajes.mensajesGlobales(132),Mensajes.mensajesGlobales(155),2),2===e&&$.ajax({url:"../controller/controller_user.php?deleteCuenta",datatype:"texto",success:function(e){window.location.href=e},error:function(e,t,n){console.log(n)}})}function datosUsuario(){document.getElementById("sub-contenedor").style.display="none",document.getElementById("datos-usuario").style.display="block"}function habilitarActu(e){var t=document.getElementById("habiliatarActualizacion"),n=document.getElementById("regresar"),l=document.getElementById("actualizar"),o=document.getElementById("cancelar"),a=document.getElementById("actualizarNombre"),s=document.getElementById("actualizarApellido"),r=document.getElementById("actualizarEmail");1===e&&(t.style.display="none",n.style.display="none",l.style.display="block",o.style.display="block",a.disabled=!1,s.disabled=!1,r.disabled=!1),2===e&&(t.style.display="block",n.style.display="block",l.style.display="none",o.style.display="none",a.disabled=!0,s.disabled=!0,r.disabled=!0)}function actualizarDatos(){var e=document.getElementById("actualizarNombre"),t=document.getElementById("actualizarApellido"),n=document.getElementById("actualizarEmail"),l={name:e.value,lastname:t.value,email:n.value};$.ajax({data:l,url:"../controller/controller_user.php?actualizarUsuario",datatype:"texto",method:"post",success:function(e){console.log(e),"0"===e&&setTimeout((function(){window.alert(Mensajes.mensajesGlobales(106))}),2e3),"1"===e&&setTimeout((function(){window.alert(Mensajes.mensajesGlobales(156)),location.reload(!0)}),1500)},error:function(e,t,n){console.log(n)}})}