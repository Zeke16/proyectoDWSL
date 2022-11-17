const content = document.getElementById("main");
const nav = document.querySelector("nav");
const aside = document.querySelector('aside');
const jumbo = document.querySelector('.jumbotron')

content.style.backgroundColor = "#f7f7f7";

window.addEventListener("load", () => {
  const input = document.getElementById("a");

  input.addEventListener("click", () => {
    if (!input.classList.contains("off")) {
      content.style.backgroundColor = "#292b2c";
      nav.style.backgroundColor = "#292b2c"
      aside.style.backgroundColor = "#292b2c"
      jumbo.style.backgroundColor = "#292b2c"
      jumbo.classList.add("text-white");
    } else if (input.classList.contains("off")) {
      content.style.backgroundColor = "";
      nav.style.backgroundColor = "";
      aside.style.backgroundColor = ""
      jumbo.style.backgroundColor = ""
      jumbo.classList.remove("text-white");
    }
  });
});