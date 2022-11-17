const alertRegistro = (proceso) => {
    setTimeout(function () {
      $.ajax(
        {
          url: "http://localhost/proyectodwsl/modules/universidad/controllers/UniversidadController.php",
          type: "POST",
          data: {
            envio: "alertRegistro",
            proceso: proceso
          },
          success: function (res) {
            $("#alert").html(res);
          },
        },
        1000
      );
    });
  };

