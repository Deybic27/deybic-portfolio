document.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".container__mobile i").addEventListener("click", () => {
        // console.log(document.querySelector(".container__mobile i"));
        document.querySelector(".container__menu").classList.add("show")
    })
    document.querySelector(".logoHeader i").addEventListener("click", () => {
        // console.log(document.querySelector(".container__mobile i"));
        document.querySelector(".container__menu").classList.remove("show")
    })
    document.querySelectorAll(".container__menu__items .item").forEach((item) => {
        item.addEventListener("click", (e) => {
            // e.preventDefault()
            // console.log("click", e, e.target.querySelector(".subitems"));
            e.target.querySelector(".subitems")?.classList.add("show")
        })
    })
})