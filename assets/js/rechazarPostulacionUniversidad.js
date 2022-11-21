const postButtonsRechazar = document.querySelectorAll("#postulacionRechazar");

postButtonsRechazar.forEach((item) => {
  item.addEventListener("click", () => {
    if (item.dataset.idEstudiante && item.dataset.proyecto) {
      let aceptarPostulacion = confirm(
        "Estas seguro de rechazar a este estudiante?"
      );

      if (aceptarPostulacion) {
        $.ajax({
          url: "../controllers/UniversidadController.php",
          type: "POST",
          data: {
            id_estudiante_aplicar: item.dataset.idEstudiante,
            id_proyecto_aplicar: item.dataset.proyecto,
            envio: "rechazarPostulante",
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