document.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".container__mobile i").addEventListener("click", () => {
        // console.log(document.querySelector(".container__mobile i"));
        document.querySelector(".container__menu").classList.add("show")
    })
    document.querySelector(".logoHeader i").addEventListener("click", () => {
        // console.log(document.querySelector(".container__mobile i"));
        document.querySelector(".container__menu").classList.remove("show")
    })
    document.querySelectorAll(".container__menu__items.item").forEach((item) => {
        item.querySelector(".item_title")?.addEventListener("click", (e) => {
            e.target.nextElementSibling.classList.toggle("show")
            document.querySelectorAll(".container__menu__items.item.subitems.show").forEach((s) => {if (!item.contains(s)) s.classList.toggle("show")})
        })
    })
})