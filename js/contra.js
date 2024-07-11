
function verificacion(data = null){
    let texto = "";
    //Lista de error cuando el usuario inicia sesion
    if( data == "error-1" ){
        texto = "Error, el Usuario o la contraseña no coinciden.";
    }
    if( data === "error0" ){
        texto = "Ups ocurrio un error al momento de verificar los datos, intenta más tarde.";
    }
    //Lista de errores cuando el usaurio crea una cuanta
    if( data === "-1error" ){
        texto = "Estos datos ya le pertenecen a un usuario, verifica nuevamente";
    }
    if( data === "0error" ){
        texto = "Ups ah ocurrido un erro al crear el usuario, verifca que los datos sean correctos";
    }
    //Mensaje de alerta
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: texto ,
        //footer: '<a href="#">Why do I have this issue?</a>'
      }).then((result) => {
        if(result.isConfirmed){
            window.location.href = 'index.php';
        }
      });
}
function Recaptcha() {
    return new Promise((resolve) => {
        let token = generarToken(Math.floor(Math.random() * (10-6+1)) + 6);
        Swal.fire({
            icon: "question",
            title: "Verificación",
            html:
            '<p>¡Queremos saber si realmente eres humano!</p>' +
            '<p>Código de verificación</p>' +
            '<div>' +
            '<p style="-webkit-touch-callout: none; webkit-user-select: none; -moz-user-select: none;-ms-user-select: none; user-select: none;">'+
            token +
            '</p>'+
            '</div>',
            input: 'text',
            inputLabel: 'Ingresa el codigo:',
            confirmButtonText: 'Enviar',
            cancelButtonColor: '#d33',
            inputValidator: (value) => {
                if (!value) {
                    return 'Debes ingresar algo!';
                }
            }
        }).then((result) => {
            let salida;
            if (result.isConfirmed) {
                let valor_user = result.value;
                if(valor_user === token ){
                    salida = true;
                }else{
                    salida = false;
                }
            }
            resolve(salida);
        });
    });
}


function generarToken(longitud) {
    const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let token = '';

    for (let i = 0; i < longitud; i++) {
        const randomIndex = Math.floor(Math.random() * caracteres.length);
        token += caracteres.charAt(randomIndex);
    }

    return token;
}

// terminos y condiciones

function validarFormulario() {
    var terminos = document.getElementById('terminos');
    if (!terminos.checked) {
        alert('Debes aceptar los términos y condiciones para continuar.');
        return false;
    }
    return true;
}
