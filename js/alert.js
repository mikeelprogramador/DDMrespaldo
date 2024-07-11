function confirmacion(option = null){
    let text = ""; 
    if( option == "1" ){
        text = "El producto se ha cardo exitosamente";
    }
    //Mensaje de alerta 
    Swal.fire({
        title: "¡Cargado!",
        text: text,
        icon: "success"
      }).then((result) => {
        if(result.isConfirmed){
            window.location.href = 'admin.php?';
        }
      });
}
function alertError(option = null ){
    let text = "";
    //Mensaje de error del producto
    if( option == "0" ){
        text = "El codigo de este producto ya se encuntra creado";
    }
    if( option == "2" ){
        text =  "Hubo un error al crear el producto";
    }
    //Mensaje de error de la imagen 
    if( option == "img0" ){
        text =  "Error, el producto no cumple los estandares";
    }
    if( option == "img1" ){
        text =  "Error, la imagen supera los limites establecidos";
    }
    //Mensaje de alerta
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: text ,
        //footer: '<a href="#">Why do I have this issue?</a>'
      }).then((result) => {
        if(result.isConfirmed){
            window.location.href = 'admin.php?seccion=seccion-ag-pro';
        }
      });
}

function alertCarrito(des){
    if(des === 1 ){
        Swal.fire({
            title: "Cargado",
            text: "Su producto se cargo exitosamente!",
            icon: "success"
        });
    }
    if(des === 2 ){
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "No tines un carrito para agregar productos",
        });
    }
    if( des === 3 ){
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Este producto ya esta agregado en el carrito.",
        });
    }
    if( des === 4 ){
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "No hay cantidades disponibles",
        });
    }
}
