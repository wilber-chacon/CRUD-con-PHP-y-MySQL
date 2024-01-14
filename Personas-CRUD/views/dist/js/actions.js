const url = "../controllers/mainController.php";

// Proceso para el regitro de nuevos datos

const registrar = async () => {
  
  const { ok, mensaje } = await fetch(`${url}?operacion=registrar`, {
    method: "POST",
    body: new FormData($("#form-register")[0]),
  }).then((res) => res.json());

  if (ok) {
    $('#form-register').trigger("reset");
    return toastr.success(mensaje);
    
  } else {
    return toastr.error(mensaje);
  }
};

//creación del evento crick para el boton que registra los datos
$("#btn-register").click(async (e) => {
  e.preventDefault();
  await registrar();
});



// Proceso para la actualizacion de los datos

const actualizar = async () => {
  
  const { ok, mensaje } = await fetch(`${url}?operacion=modificar`, {
    method: "POST",
    body: new FormData($("#form-update")[0]),
  }).then((res) => res.json());

  if (ok) {
    return sweetAlert("¡Exito!", mensaje, "success").then(() => {
      window.location.href = "./";
    });
    // return toastr.success(mensaje);
    
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
    // return toastr.error(mensaje);
  }
};

//creación del evento crick para el boton que actualiza los datos
$("#btn-update").click(async (e) => {
  e.preventDefault();
  await actualizar();
});



// proceso para la eliminacion de un registro

const eliminarRegistro = async () => {
  
  const { ok, mensaje } = await fetch(`${url}?operacion=eliminar`, {
    method: "POST",
    body: new FormData($("#form-del")[0]),
  }).then((res) => res.json());

  if (ok) {
    $('#form-del').trigger("reset");
    setInterval( function () {
      location.reload();
  }, 1500 );
    
    
    return toastr.success(mensaje);
    
  } else {
    return toastr.error(mensaje);
  }
};


$("#btn-ok").click(async (e) => {
  e.preventDefault();
  await eliminarRegistro();
});



function eliminar(id, nombre, apellido){
  
  $('#registro').text('¿Seguro que desea eliminar el registro de '+nombre+' '+apellido+'?');
  $('#id-person').val(id);
}