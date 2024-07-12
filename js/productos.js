function busquedaAdm(event){
    let texto = event.target.value;
    var param = {
        'search': texto
    }

    $.ajax({
        data: param,
        url: 'buscar.php',
        datatype: 'html',
        method: 'get',
        success: function(respuestas){
            $("#search").html(respuestas);
            //console.log(respuestas);
        },
        error: function(xhr,status, error){
            console.log("Erro",error);
        }
    })
}

function buscarProductos(ban){
    let texto; 
    if(ban === 1){
        texto = $("#barra-search").val();
    }
    var param = {
        'busquedaGeneral': texto
    }
    //console.log(texto);    

    $.ajax({
        data: param,    
        url: 'buscar.php',
        datatype: 'html',
        method: 'get',
        success: function(respuestas){
            $("#subContainer").html(respuestas);
            //console.log(respuestas);
        },
        error: function(xhr,status, error){
            console.log("Erro",error);
        }
    })

}

function pulsar(event){
    if(event.which === 13 ){
        event.preventDefault(); 
        $("#boton").click();
    }
}

function eliminar(id){;
    var param = {
        'id': id
    }

    $.ajax({
        data: param,
        url: 'buscar.php',
        datatype: 'html',
        method: 'get',
        success: function(respuesta){
            document.getElementById("search").innerHTML = respuesta;
        },
        error: function(xhr,status,error){
            console.log(error);
        }

    })

}

function decision(id){
    Swal.fire({
        title: "!Borrar producto¡" ,
        text: "¿Estas seguro de eliminar el producto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "¡Eliminado!",
            text: "Presiona OK para confirmar",
            icon: "success",
          }).then((result) => {
            if(result.isConfirmed){
                eliminar(id);
            }
          });
          
        }
      });
}

function recargar(){
    window.location.reload();
}

