const deleteE = document.querySelectorAll('[data-delete]');
console.log(deleteE)
deleteE.forEach((accion) => {
    accion.addEventListener("click", (event)=>{
        const opcion = confirm("Seguro de eliminar este registro?");
        if(!opcion){
            event.preventDefault()
        }
    })
})

const fechaInit = document.querySelectorAll('#fechaInit')
const fechaEsti = document.querySelectorAll('#fechaEsti')

fechaInit.addEventListener("change", ()=>{
    let date = new Date(fechaInit.value)
    date.setDate(date.getDate() + 2);
    let newDate = date;
    let dateLimit = newDate.getFullYear() + "-" + (newDate.getMonth() + 1) + "-" + newDate.getDate();
    console.log(dateLimit)
    fechaEsti.setAttribute("min", dateLimit)
})