document.addEventListener("DOMContentLoaded", function(event) {
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
  function loadDataEditForm() {
    console.log(window.location.href)
    const params = new URLSearchParams(window.location.href)
    console.log(params.getAll("p").toString(),'post')
    const idPost = params.getAll("p").toString()
    if (idPost) {
      fetch('/api/V1/post/'+idPost)
        .then(response => response.json())
        .then(function(data){
          console.log(data)
  
          document.querySelector("#editPost").style = "display: block";
          document.querySelector("#newPost").style = "display: none";
          document.querySelector("#editPost form").action = "/posts/"+data["id"];
          document.querySelector("#editPost form #title").value = data["title"];
          document.querySelector("#editPost form #description").value = data["description"];

          document.querySelector('#editPost form .ck')?.remove();
          ClassicEditor
          .create(document.querySelector('#editPost form #description'))
          .then(editor => window.editor = editor)
          .catch( error => {
              console.error( error );
          });
          document.querySelector("#editPost form img").src = data["urlImage"];
          document.querySelector("#editPost form #category").value = data["post_category_id"];
        });
    } else {
      document.querySelector("#editPost").style = "display: none";
      document.querySelector("#newPost").style = "display: block";
      document.querySelector('#newPost form .ck')?.remove();
      ClassicEditor
      .create(document.querySelector('#newPost form #description'))
      .then(editor => console.log(editor))
      .catch( error => {
          console.error( error );
      });
    }
    console.log(params.getAll("c").toString(),'category')
    const idCategory = params.getAll("c").toString()
    if (idCategory) {
      fetch('/api/V1/post-category/'+idCategory)
        .then(response => response.json())
        .then(function(data){
          console.log(data, 'data category')

          document.querySelector("#editCategory").style = "display: block";
          document.querySelector("#newCategory").style = "display: none";
          document.querySelector("#editCategory form").action = "/post-categories/"+data["id"];
          document.querySelector("#form_delete_category").action = "/post-categories/"+data["id"];
          document.querySelector("#editCategory form #name").value = data["name"];
          document.querySelectorAll(".modal-body strong").forEach(element => {
            element.innerHTML = data["name"];
          });
          
        });
    }else{
      document.querySelector("#editCategory").style = "display: none";
      document.querySelector("#newCategory").style = "display: block";
    }
    document.querySelector("#loaderPage").style = "visibility:hidden;";
  }

  // Seleccionas los elementos y lo guardas en una variable
  const a = document.querySelectorAll("a");
  console.log(a);
  // Para la variable "a" le añadimos la funcion "forEach" así "a.forEach"
  a.forEach(element => {
    element.addEventListener("click", function() {
      document.querySelector("#loaderPage").style = "visibility:visible;";
      setTimeout(loadDataEditForm,1000);
    });
  });
});