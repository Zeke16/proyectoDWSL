const inputs = document.querySelectorAll("input");
inputs.forEach((item) => {
  item.style.borderColor = "gray";
  item.addEventListener("focus", () => {
    item.style.borderColor = "#13551f";
    item.style.boxShadow = "0px 0px 1px 1px #13551f";
  });
  item.addEventListener("blur", () => {
    item.style.borderColor = "gray";
    item.style.boxShadow = "";
  });
});

const selec = document.querySelectorAll("select");
selec.forEach((item) => {
  item.style.borderColor = "gray";
  item.addEventListener("focus", () => {
    item.style.borderColor = "gray";
    item.style.boxShadow = "0px 0px 1px 1px #fff";
  });
});

const textarea = document.querySelector("textarea");
textarea.style.borderColor = "gray";
textarea.addEventListener("focus", () => {
  textarea.style.borderColor = "#13551f";
  textarea.style.boxShadow = "0px 0px 1px 1px #13551f";
});
textarea.addEventListener("blur", () => {
  textarea.style.borderColor = "gray";
  textarea.style.boxShadow = "";
});

const back = document.querySelector("#btnRegresar");
back.addEventListener("click", () => {
  history.back();
});

const selectDep = document.getElementById("id_departamento");

selectDep.addEventListener("change", () => {
  const mun = selectDep.value;
  console.log(mun);
  setTimeout(function () {
    $.ajax(
      {
        url: "http://localhost/proyectodwsl/controllers/HomeController.php",
        type: "POST",
        data: {
          envio: mun,
        },
        dataType: "json",
        success: function (res) {
          const len = res.length;
          console.log(res);
          $("#id_municipio").empty();
          $("#id_municipio").removeAttr("disabled");
          for (let i = 0; i < len; i++) {
            let id = res[i]["id_municipio"];
            let name = res[i]["nombre"];

            $("#id_municipio").append(
              '<option value="' + id + '">' + name + "</option>"
            );
          }
        },
      },
      1000
    );
  });
});
