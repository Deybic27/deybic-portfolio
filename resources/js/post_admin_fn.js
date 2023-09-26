import * as api from "./post_admin_api"

export async function loadDataEditForm() {
  const params = new URLSearchParams(window.location.href)
  
  document.querySelectorAll(".alert.alert-danger")?.forEach((e) => e.remove())
  // Modal POST
  const idPost = params.getAll("p").toString()
  if (idPost && idPost != "new") {
    const editPost = document.querySelector("#editPost")
    const newPost = document.querySelector("#newPost")
    resetFormPost(editPost);
    resetFormPost(newPost);
    const data = await api.getDataPost(idPost)
    if (!data) {
      window.location.href = window.location.origin + window.location.pathname
    }
    insertDataPost(editPost, data)
    // Mostrar u ocultar formulario
    editPost.style = "display: block";
    newPost.style = "display: none";
  } else {
    const editPost = document.querySelector("#editPost")
    const newPost = document.querySelector("#newPost")
    resetFormPost(editPost);
    resetFormPost(newPost);
    editPost.style = "display: none";
    newPost.style = "display: block";
    document.querySelector('#newPost form .ck')?.remove();
    ClassicEditor
    .create(document.querySelector('#newPost form #description'))
    .catch( error => {
        console.error( error );
    });
  }

  // Modal CATEGORY
  const idCategory = params.getAll("c").toString()
  if (idCategory && idCategory != "new") {
    const data = await api.getDataCategory(idCategory)
    insertDataCategory(data)
    // Mostrar u ocultar formulario
    document.querySelector("#editCategory").style = "display: block";
    document.querySelector("#newCategory").style = "display: none";
  }else{
    document.querySelector("#editCategory").style = "display: none";
    document.querySelector("#newCategory").style = "display: block";
  }
  document.querySelector("#loaderPage").style = "visibility:hidden;";
}

// Functions for POSTS
export async function initModalPost() {
  const params = new URLSearchParams(window.location.href)
  const idPost = params.getAll("p").toString()
  if (idPost) {
    const editPost = document.querySelector("#editPost")
    const newPost = document.querySelector("#newPost")
    const dataPost = params.getAll("d").toString()
    let dataJson = []
    if (dataPost) {
      const dataDecode = decodeURIComponent(atob(dataPost)).replaceAll("+", " ")
      const dataSplit = dataDecode.split('\n')
      dataSplit.forEach((e) => {
        const dataPreJson = e.split('=')
        dataJson[dataPreJson[0]] = dataPreJson[1]
      })
    }

    const modalPost = document.querySelector("#modal-post");
    var modal = new bootstrap.Modal(modalPost)
    
    if (idPost === "new") {
      if (Object.keys(dataJson).length > 0) {
        insertDataPost(newPost, dataJson)
      }
      // Mostrar formulario de edición
      editPost.style = "display: none";
      newPost.style = "display: block";
    } else {
      const isExist = await api.getDataPost(idPost);
      if (!isExist) {
        window.location.href = window.location.origin + window.location.pathname
      }
      if (Object.keys(dataJson).length == 0) {
        dataJson = await api.getDataPost(idPost)
      }
      insertDataPost(editPost, dataJson)
      // Mostrar formulario de edición
      editPost.style = "display: block";
      newPost.style = "display: none";
    }

    // Mostrar modal
    modal.show()
  }
}

export function insertDataPost(parent, data) {
  if (data["id"]) parent.querySelector("form").action = "/posts/" + data["id"];
  parent.querySelector("form #title").value = data["title"];
  parent.querySelector("form #description").value = data["description"];

  parent.querySelector('form .ck')?.remove();
  ClassicEditor
  .create(parent.querySelector('form #description'))
  .then(editor => window.editor = editor)
  .catch( error => {
      console.error( error );
  });
  if (data["urlImage"]) parent.querySelector("form img").src = data["urlImage"];
  parent.querySelector("form #category").value = data["post_category_id"];
}

export function resetFormPost(parent) {
  // parent.querySelector("form").action = "";
  parent.querySelector("form #title").value = "";
  parent.querySelector("form #description").value = "";
  // parent.querySelector("form img").src = ""
  parent.querySelector("form #category").value = "";
}

// Functions for CATEGORIES
export async function initModalCategories() {
  const params = new URLSearchParams(window.location.href)
  const idCategory = params.getAll("c").toString()

  if (idCategory) {
    const modalCategory = document.querySelector("#modal-category");
    var modal = new bootstrap.Modal(modalCategory)
    console.log(idCategory);
    if (idCategory == "new") {
      document.querySelector("#editCategory").style = "display: none";
      document.querySelector("#newCategory").style = "display: block";
    } else {
      const data = await api.getDataCategory(idCategory)
      if (!data) {
        window.location.href = window.location.origin + window.location.pathname
      }
      insertDataCategory(data)
      document.querySelector("#editCategory").style = "display: block";
      document.querySelector("#newCategory").style = "display: none";
    }
    modal.show()
  }
}

export function insertDataCategory(data) {
  // Llenar los datos del post en el formulario
  document.querySelector("#editCategory form").action = "/post-categories/"+data["id"];
  document.querySelector("#form_delete_category").action = "/post-categories/"+data["id"];
  if (!document.querySelector("#editCategory form #name").value) {
    document.querySelector("#editCategory form #name").value = data["name"];
  }
  document.querySelectorAll(".modal-body strong").forEach(element => {
    element.innerHTML = data["name"];
  });
}