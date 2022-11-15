const content = document.getElementById("main");
const nav = document.querySelector("nav");
content.style.backgroundColor = "White";
window.addEventListener("load", () => {
  const input = document.getElementById("a");

  input.addEventListener("click", () => {
    if (!input.classList.contains("off")) {
      content.style.backgroundColor = "gray";
      nav.style.backgroundColor = "gray"
    } else if (input.classList.contains("off")) {
      content.style.backgroundColor = "White";
      nav.style.backgroundColor = "White";
    }
  });
});