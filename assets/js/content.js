const content = document.getElementById('cards-content')
console.log(content)

window.addEventListener("resize", ()=>{
    if(window.innerWidth <= 768){
        content.classList.remove("d-flex")
    }else if(window.innerWidth > 768){
        content.classList.add("d-flex")
    }
})