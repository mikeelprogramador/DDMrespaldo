function rol(e){var o={UsuarioEditar:e};$.ajax({data:o,url:"../controller/controller_admin.php",datatype:"texto",method:"post",success:function(e){"1"===e&&(document.getElementById("rango").style.display="block")},error:function(e,o,n){console.log(n)}})}function editarRol(){var e=document.getElementById("nuevoRango").value;if("Rango"===e)window.alert(Mensajes.mensajesGlobales(157));else{var o={rango:e,datoUsuario:""};$.ajax({data:o,url:"../controller/controller_admin.php",datatype:"texto",method:"post",success:function(e){console.log(e),"1"===e&&(window.alert(Mensajes.mensajesGlobales(160)),location.reload(!0)),"0"===e&&(window.alert(Mensajes.mensajesGlobales(158)),document.getElementById("rango").style.display="none"),"-1"===e&&(window.alert(Mensajes.mensajesGlobales(159)),document.getElementById("rango").style.display="none")},error:function(e,o,n){console.log(n)}})}}function cancelarRol(){document.getElementById("rango").style.display="none"}