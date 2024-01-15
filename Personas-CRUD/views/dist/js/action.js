const url = "../controllers/mainController.php";

const sweetAlert = (title, text, icon) => {
  return Swal.fire({
    title: `${title}`,
    text: `${text}`,
    icon: `${icon}`,
    showConfirmButton: false,
    timer: 2000,
    allowOutsideClick: false,
    heightAuto: false,
  });
};


// Proceso para el regitro de nuevos datos

const registrar = async () => {
  
  const { ok, mensaje } = await fetch(`${url}?operacion=registrar`, {
    method: "POST",
    body: new FormData($("#form-register")[0]),
  }).then((res) => res.json());

  if (ok) {
    $('#form-register').trigger("reset");
    return sweetAlert("¡Exito!", mensaje, "success");
    
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
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
    return sweetAlert("¡Exito!", mensaje, "success");
    
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
    
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
    
    
  return sweetAlert("¡Exito!", mensaje, "success");
    
  } else {
    return sweetAlert("¡Error!", mensaje, "error");
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