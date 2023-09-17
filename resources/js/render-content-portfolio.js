window.addEventListener('load', () => {

    fetch('/api/V1/post')
    .then(response => response.json())
    .then(function(data){
        // console.log(data)
        
        data.forEach((post, index) => {
            const cont = index + 1;
            
            const element = document.querySelector('.content-all-blog');
            const elementCloned = element.cloneNode(true);
            elementCloned.id = 'post' + cont
            if (cont > 1) {
                elementCloned.classList.add('hidden');
            }   
            
            elementCloned.href = "blog/" + post.id
            elementCloned.querySelector(".content-blog-img img").src = post.urlImage;
            elementCloned.querySelector(".content-blog-info p b").textContent = post.title;
            elementCloned.querySelector(".content-blog-info p:nth-child(2)").textContent = post.date.split("T")[0];
            elementCloned.querySelector(".content-blog-info p:nth-child(3)").textContent = post.author.toUpperCase();
            
            // console.log('post', post.title, elementCloned.querySelector(".content-blog-info > p").innerHtml, elementCloned);
            element.parentElement.appendChild(elementCloned)
            if (index == 0) {
                element.remove();
            }
            elementCloned.parentElement.classList.remove('visibility-hidden');
        });
    });
});