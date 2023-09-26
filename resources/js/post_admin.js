import * as fn from "./post_admin_fn"

document.addEventListener("DOMContentLoaded", function(event) {
  fn.initModalPost()
  fn.initModalCategories()

  //código a ejecutar cuando el DOM está listo para recibir acciones
  document.querySelector('.contenedor').onmouseover = function() {
    document.querySelectorAll('.btnFloat').forEach(element => {
      element.classList.add('animacionVer');
    });
  }
  document.querySelector('.contenedor').onmouseout = function(){
    document.querySelectorAll('.btnFloat').forEach(element => {
      element.classList.remove('animacionVer');
    });
  }

  // Seleccionas los elementos y lo guardas en una variable
  const a = document.querySelectorAll("a");
  // Para la variable "a" le añadimos la funcion "forEach" así "a.forEach"
  a.forEach(element => {
    element.addEventListener("click", function() {
      document.querySelector("#loaderPage").style = "visibility:visible;";
      setTimeout(fn.loadDataEditForm,1000);
    });
  });
});