import './render-content-portfolio';

function rotatingText(val){
    const valSpan = $('span.content-rotating-text').text();
    for (let index = 0; index < val.length; index++) {
        const element = val[index];
        if(element == valSpan){
            const cont = index+1;
            if (val[cont]) {
                $('span.content-rotating-text').text(val[cont]);
                break;
            }else{
                $('span.content-rotating-text').text(val[0]);
                break;
            }
        }
    }
}
$(document).ready(function() {

    const val = $('span.content-rotating-text').text();
    var arrayVal = val.split(',');
    $('span.content-rotating-text').text(arrayVal[0]);
    setInterval(()=>{
        rotatingText(arrayVal)
    }, 3000);
    
    var hide = 2;
    var show = 1;

    var hidep,showp;

    $("a#next").click(function(event) {
        event.preventDefault();
        if ($("#post"+hide).is(':hidden') && hide<=7) {
            $("#post"+show).addClass("hidden");
            $("#post"+hide).removeClass("hidden");
            hidep=hide;
            showp=show;
            if (hide<=6) {
                hide+=1;
                show+=1;
            }            
        }
    });

    $("a#previous").click(function(event) {
        event.preventDefault();
        if ($("#post"+showp).is(':hidden') && hidep<=7) {
            $("#post"+hidep).addClass("hidden");
            $("#post"+showp).removeClass("hidden");
            hide=hidep;
            show=showp;
            hidep-=1;
            showp-=1;
        }
    });

    
    $("a#show-menu").click(function(event) {
        event.preventDefault();
        if ($("header.desktop-header.close.show-menu-desktop").length) {
            $("header.desktop-header").removeClass("show-menu-desktop");
            $("header.mobile-header").removeClass("show-menu-mobile");
            $("main").removeClass("show-main");
        }else if($("header.desktop-header.close").length){
            $("header.desktop-header").addClass("show-menu-desktop");
            $("header.mobile-header").addClass("show-menu-mobile");
            $("main").addClass("show-main");
        }
    });
});

document.querySelector('#contact-form').addEventListener("submit", (e) => {
    e.preventDefault();
    const elementName = e.target.querySelector('#name');
    const elementEmail = e.target.querySelector('#email');
    const elementSubject = e.target.querySelector('#subject');
    const elementMessage = e.target.querySelector('#message');
    
    // Validar formulario
    e.target.querySelectorAll('.error')?.forEach(element => element.remove());
    let error = false;
    let focus = true;
    var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
    const elementError = document.createElement('div');
    elementError.classList.add('error');
    elementError.textContent = "Campo obligatorio";

    if (elementName.value.length == 0) {
        let elementErrorNew = elementError.cloneNode(true);
        elementName.parentElement.appendChild(elementErrorNew);
        error = true;
        if (focus) {
            elementName.focus();
            focus = false;
        }
    }
    if (elementEmail.value.length == 0) {
        let elementErrorNew = elementError.cloneNode(true);
        elementEmail.parentElement.appendChild(elementErrorNew);
        error = true;
        if (focus) {
            elementEmail.focus();
            focus = false;
        }
    }
    if (elementEmail.value.length > 0 && !validEmail.test(elementEmail.value)) {
        let elementErrorNew = elementError.cloneNode(true);
        elementErrorNew.textContent = "Correo electrónico inválido";
        elementEmail.parentElement.appendChild(elementErrorNew);
        error = true;
        if (focus) {
            elementEmail.focus();
            focus = false;
        }
    }
    if (elementSubject.value.length == 0) {
        let elementErrorNew = elementError.cloneNode(true);
        elementSubject.parentElement.appendChild(elementErrorNew);
        error = true;
        if (focus) {
            elementSubject.focus();
            focus = false;
        }
    }
    if (elementMessage.value.length == 0) {
        let elementErrorNew = elementError.cloneNode(true);
        elementMessage.parentElement.appendChild(elementErrorNew);
        error = true;
        if (focus) {
            elementMessage.focus();
            focus = false;
        }
    }
    if (error == true) {
        return;
    }
    var formdata = new FormData();
    formdata.append("fromName", elementName.value);
    formdata.append("fromEmail", elementEmail.value);
    formdata.append("subject", elementSubject.value);
    formdata.append("text", elementMessage.value);

    var requestOptions = {
    method: 'POST',
    body: formdata,
    redirect: 'follow'
    };

    fetch("/api/portfolio/V1/send-email-contact", requestOptions)
    .then(response => {
        if (response.status == 200) {
            let elementErrorNew = elementError.cloneNode(true);
            elementErrorNew.classList.remove('error');
            elementErrorNew.classList.add('ok');
            elementErrorNew.textContent = "Mensaje enviado";
            e.target.appendChild(elementErrorNew);

            elementName.value = "";
            elementEmail.value = "";
            elementSubject.value = "";
            elementMessage.value = "";
            setTimeout(() => {
                elementErrorNew.remove();
            }, 3000);
            return response.text();
        }
        let elementErrorNew = elementError.cloneNode(true);
        elementErrorNew.textContent = "Servicio no disponible";
        e.target.appendChild(elementErrorNew);
        return response.text();
    })
});