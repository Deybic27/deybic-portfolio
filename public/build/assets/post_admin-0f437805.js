document.addEventListener("DOMContentLoaded",function(d){document.querySelector(".contenedor").onmouseover=function(){document.querySelectorAll(".btnFloat").forEach(o=>{o.classList.add("animacionVer")})},document.querySelector(".contenedor").onmouseout=function(){document.querySelectorAll(".btnFloat").forEach(o=>{o.classList.remove("animacionVer")})};function s(){var i;console.log(window.location.href);const o=new URLSearchParams(window.location.href);console.log(o.getAll("p").toString(),"post");const n=o.getAll("p").toString();n?fetch("/api/V1/post/"+n).then(e=>e.json()).then(function(e){var t;console.log(e),document.querySelector("#editPost").style="display: block",document.querySelector("#newPost").style="display: none",document.querySelector("#editPost form").action="/posts/"+e.id,document.querySelector("#editPost form #title").value=e.title,document.querySelector("#editPost form #description").value=e.description,(t=document.querySelector("#editPost form .ck"))==null||t.remove(),ClassicEditor.create(document.querySelector("#editPost form #description")).then(r=>window.editor=r).catch(r=>{console.error(r)}),document.querySelector("#editPost form img").src=e.urlImage,document.querySelector("#editPost form #category").value=e.post_category_id}):(document.querySelector("#editPost").style="display: none",document.querySelector("#newPost").style="display: block",(i=document.querySelector("#newPost form .ck"))==null||i.remove(),ClassicEditor.create(document.querySelector("#newPost form #description")).then(e=>console.log(e)).catch(e=>{console.error(e)})),console.log(o.getAll("c").toString(),"category");const l=o.getAll("c").toString();l?fetch("/api/V1/post-category/"+l).then(e=>e.json()).then(function(e){console.log(e,"data category"),document.querySelector("#editCategory").style="display: block",document.querySelector("#newCategory").style="display: none",document.querySelector("#editCategory form").action="/post-categories/"+e.id,document.querySelector("#form_delete_category").action="/post-categories/"+e.id,document.querySelector("#editCategory form #name").value=e.name,document.querySelectorAll(".modal-body strong").forEach(t=>{t.innerHTML=e.name})}):(document.querySelector("#editCategory").style="display: none",document.querySelector("#newCategory").style="display: block"),document.querySelector("#loaderPage").style="visibility:hidden;"}const c=document.querySelectorAll("a");console.log(c),c.forEach(o=>{o.addEventListener("click",function(){document.querySelector("#loaderPage").style="visibility:visible;",setTimeout(s,1e3)})})});
