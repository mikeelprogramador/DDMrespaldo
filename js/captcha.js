function Recaptcha(e,n=null){return new Promise((t=>{if(1===e)var o='<p>¡Queremos saber si realmente eres humano!</p><p>Código de verificación</p><div><p style="-webkit-touch-callout: none; webkit-user-select: none; -moz-user-select: none;-ms-user-select: none; user-select: none;">'+(r=generarToken(Math.floor(5*Math.random())+6))+"</p></div>";if(2===e){var r=n;o="<p>Te enviamos a tu correo un token de autencticacion </p>"}Swal.fire({icon:"question",title:"Verificación",html:o,input:"text",inputLabel:"Ingresa el código:",confirmButtonText:"Enviar",cancelButtonColor:"#d33",inputValidator:e=>{if(!e)return"Debes ingresar algo!"}}).then((e=>{let n;if(e.isConfirmed){n=e.value===r}t(n)}))}))}function generarToken(e){const n="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";let t="";for(let o=0;o<e;o++){const e=Math.floor(62*Math.random());t+=n.charAt(e)}return t}function validarFormulario(){return!!document.getElementById("terminos").checked||(alertNormales(Mensajes.mensajesSeewalert(401),Mensajes.mensajesGlobales(101),Mensajes.mensajesGlobales(110)),!1)}