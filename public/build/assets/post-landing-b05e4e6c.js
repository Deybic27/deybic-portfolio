document.addEventListener("DOMContentLoaded",()=>{document.querySelector(".container__mobile i").addEventListener("click",()=>{document.querySelector(".container__menu").classList.add("show")}),document.querySelector(".logoHeader i").addEventListener("click",()=>{document.querySelector(".container__menu").classList.remove("show")}),document.querySelectorAll(".container__menu__items.item").forEach(e=>{var t;(t=e.querySelector(".item_title"))==null||t.addEventListener("click",o=>{o.target.nextElementSibling.classList.toggle("show"),document.querySelectorAll(".container__menu__items.item.subitems.show").forEach(n=>{e.contains(n)||n.classList.toggle("show")})})})});