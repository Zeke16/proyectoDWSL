//capturamos todos los botones de aplicar y no aplicar
let botonAplicar = document.querySelectorAll("#aplicar");
let botonNoAplicar = document.querySelectorAll("#noAplicar");

/**en cada boton de aplicar, agregamos el evento click y que ejecute la funcion aplicar,
 * esta funcion recibe por parametros 3 datos, el id del proyecto(idP), el id del usuario (id) y el proceso
 * a realizar (aplicar o no aplicar).

 * Los primeros 2 estan definidos a partir de los dataset en cada boton, el ultimo es escrito como un string
*/
botonAplicar.forEach((item) => {
  item.addEventListener("click", () => {
    aplicarU(item.dataset.idProyect, item.dataset.id, "aplicar");
  });
});

/**En cada boton de no aplicar se hace lo mismo que antes, usando siempre los dataset
 * dataset es un atributo en cada boton creado, estan hecho de tal manera que cada uno es diferente, 
 * usando el id del proyecto para diferenciarlos, y el id del usuario (estudiante) es pasado para realizar su
 * aplicacion a un proyecto como su retiro del mismo
 */
botonNoAplicar.forEach((item) => {
  item.addEventListener("click", () => {
    aplicarU(item.dataset.idProyect, item.dataset.id, "noAplicar");
  });
});

const aplicarU = function (idP, id, proceso) {
  $.ajax(
    {
      url: "http://localhost/proyectodwsl/modules/estudiantes/controllers/EstudiantesController.php",
      type: "POST",
      data: {
        idProyecto: idP,
        idEstudiante: id,
        proceso: proceso,
        entidad: "universidad"
      },
      success: function (res) {
        //Aca se establece el div destino junto al parametro idP, el cual contiene el identificador de cada div
        let contenido = "#apply-" + idP;

        //una pequeña animacion de entrada y salida de contenido para hacerlo mas dinamico
        setTimeout(() => {
          $(contenido).fadeOut(200);
        }, 200);
        setTimeout(() => {
          $(contenido).html(res);
          $(contenido).fadeIn(200);
        }, 400);
      },
    },
    1000
  );
};

let botonAplicarEmpresa = document.querySelectorAll("#aplicarEmpresa");
let botonNoAplicarEmpresa = document.querySelectorAll("#noAplicarEmpresa");

botonNoAplicarEmpresa.forEach((item) => {
    item.addEventListener("click", () => {
      aplicarEmp(item.dataset.idProyect, item.dataset.id, "noAplicar");
    });
  });

  botonAplicarEmpresa.forEach((item) => {
    item.addEventListener("click", () => {
        aplicarEmp(item.dataset.idProyect, item.dataset.id, "aplicar");
    });
  });

const aplicarEmp = function (idP, id, proceso) {
    $.ajax(
      {
        url: "http://localhost/proyectodwsl/modules/estudiantes/controllers/EstudiantesController.php",
        type: "POST",
        data: {
          idProyecto: idP,
          idEstudiante: id,
          proceso: proceso,
          entidad: "empresa"
        },
        success: function (res) {
          //Aca se establece el div destino junto al parametro idP, el cual contiene el identificador de cada div
          let contenido = "#apply-empresa-" + idP;
  
          //una pequeña animacion de entrada y salida de contenido para hacerlo mas dinamico
          setTimeout(() => {
            $(contenido).fadeOut(200);
          }, 200);
          setTimeout(() => {
            $(contenido).html(res);
            $(contenido).fadeIn(200);
          }, 400);
        },
      },
      1000
    );
  };
  