const alertRegistro = () => {
    setTimeout(function () {
      $.ajax(
        {
          url: "http://localhost/proyectodwsl/modules/universidad/controllers/UniversidadController.php",
          type: "POST",
          data: {
            envio: "alertRegistro",
          },
          success: function (res) {
            $("#alert").html(res);
          },
        },
        1000
      );
    });
  };
  