const postButtonsAceptar = document.querySelectorAll("#postulacionAceptar");
console.log(postButtonsAceptar)
postButtonsAceptar.forEach((item) => {
  item.addEventListener("click", () => {
    if (item.dataset.idEstudiante && item.dataset.proyecto) {
      let aceptarPostulacion = confirm(
        "Estas seguro de aceptar a este estudiante?"
      );

      if (aceptarPostulacion) {
        $.ajax({
          url: "../controllers/EmpresasController.php",
          type: "POST",
          data: {
            id_estudiante_aplicar: item.dataset.idEstudiante,
            id_proyecto_aplicar: item.dataset.proyecto,
            envio: "aceptarPostulante",
          },
          success: function (res) {
            let contenidoButton =
              "#content-button-" + item.dataset.idEstudiante;
            $(contenidoButton).empty();
            $(contenidoButton).html(res);
          },
        },1000);
      }
    }
  });
});

const finalizarProyecto = document.getElementById('finalizar-proyecto')
if(finalizarProyecto !== null){

finalizarProyecto.addEventListener("click", ()=>{
    let aceptar = confirm(
        "Estas seguro de finalizar este proyecto?"
      );
    if(aceptar){
    $.ajax({
        url: "../controllers/EmpresasController.php",
        type: "POST",
        data: {
          id_proyecto_finalizar: finalizarProyecto.dataset.idProyectoFin,
          envio: "finalizarProyecto",
        },
        success: function (res) {
          $('#status').empty();
          $('#status').html(res);
        },
      },1000);
    }
})
}