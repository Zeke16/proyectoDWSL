const inputs = document.querySelectorAll("input");
inputs.forEach((item) => {
  item.style.borderColor = "gray";
  item.addEventListener("focus", () => {
    item.style.borderColor = "#e82785";
    item.style.boxShadow = "0px 0px 1px 1px #e82785";
  });
  item.addEventListener("blur", () => {
    item.style.borderColor = "gray";
    item.style.boxShadow = "";
  });
});

const selec = document.querySelector("select");
selec.style.borderColor = "gray";
selec.addEventListener("focus", () => {
  selec.style.borderColor = "gray";
  selec.style.boxShadow = "0px 0px 1px 1px #fff";
});

const textarea = document.querySelector("textarea");
textarea.style.borderColor = "gray";
textarea.addEventListener("focus", () => {
  textarea.style.borderColor = "#e82785";
  textarea.style.boxShadow = "0px 0px 1px 1px #e82785";
});
textarea.addEventListener("blur", () => {
  textarea.style.borderColor = "gray";
  textarea.style.boxShadow = "";
});

const back = document.querySelector("#btnRegresar");
back.addEventListener("click", () => {
  history.back();
});
