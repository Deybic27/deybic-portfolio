<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudio de desarrollo web</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- Scripts -->
    @vite(['resources/scss/templates/home.scss', 'resources/js/home.js'])
</head>
<body>
    <section class="banner_principal">
        <img class="banner_principal__background-image__all" src="{{asset('./../image/image-back-desk.png')}}" alt="">
        <div class="banner_principal__content text-align-center">
            <img class="banner_principal__content__decor" src="{{asset('./../image/image-decor-desk.png')}}" alt="">
            <h1>Estudio de desarrollo web</h1>
            <p>Su guía para alcanzar la cima del éxito digital</p>
            <hr class="banner_principal__content__line">
        </div>
    </section>
    <section class="container column-center">
        <div class="content padding-y-60 column-center gap-15">
            <h2>Mercadeo por Internet</h2>
            <p class="content__text">Obtenga una estrategia ganadora para promocionar su negocio en línea, incluidos SEO, publicidad y branding</p>
        </div>
    </section>
    <section class="container column-center">
        <img class="background-image__all" src="{{asset('./../image/image-man-desk.png')}}" alt="">
        <div class="content">
            <div class="items grid-column-3-start gap-50 padding-y-200">
                <article class="item column-center gap-25">
                    <p class="item__num"><span class="item__num__span">01</span></p>
                    <h2 class="">Encontrar</h2>
                    <p class="">Encontraremos clientes en su área que busquen sus servicios comerciales a través de nuestros sistemas de marketing específicos.</p>
                </article>
                <article class="item column-center gap-25">
                    <p class="item__num"><span class="item__num__span">02</span></p>
                    <h2 class="">Conectar</h2>
                    <p class="">Los conectaremos en tiempo real con su negocio a través de múltiples medios.</p>
                </article>
                <article class="item column-center gap-25">
                    <p class="item__num"><span class="item__num__span">03</span></p>
                    <h2 class="">Crecer</h2>
                    <p class="">Haremos crecer su negocio al respaldar su base de clientes en constante expansión y ayudarlo a administrar el crecimiento de su negocio.</p>
                </article>
            </div>
        </div>
    </section>
    <section class="container column-center overlay">
        <img class="overlay-image" src="{{asset('./../image/image-screen-types-desk.png')}}" alt="">
    </section>
    <section class="container column-center">
        <img class="background-image__all brightness-medium" src="{{asset('./../image/image-street-desk.png')}}" alt="">
        <div class="content padding-y-60 column-center">
            <h2 class="padding-y-15">Nuestros últimos proyectos</h2>
            <p class="content__text">Los problemas de marketing actuales son complejos, especializados y en constante cambio. ¿Quién puede mantenerse al día con las últimas tendencias y tecnologías? Podemos.</p>
        </div>
        <div class="projects row-center">
            <img class="project-image" src="{{asset('./../image/image-devices-desk.png')}}" alt="">
            <img class="project-image" src="{{asset('./../image/image-code-desk.png')}}" alt="">
            <img class="project-image" src="{{asset('./../image/image-devices1-desk.png')}}" alt="">
            <img class="project-image" src="{{asset('./../image/image-investmen-desk.png')}}" alt="">
            <img class="project-image" src="{{asset('./../image/image-devices2-desk.png')}}" alt="">
        </div>
        <div class="content padding-y-60">
            <a class="btn">ver más</a>
        </div>
    </section>
    <section class="container column-center">
        <div class="content padding-y-60 column-center gap-15">
            <h2 class="">¿Porque nosotros?</h2>
            <p class="content__text">Tus ingeniosas ideas. Nuestro desarrollo web de última generación</p>
            <div class="grid-column-2-start gap-15 padding-top-15">
                <article class="row-start gap-10">
                    <div>
                        <span class="material-symbols-outlined">settings</span>
                    </div>
                    <div class="column-start gap-15 text-align-start">
                        <h3 class="padding-top-15">Mejores Ideas</h3>
                        <p class="text-small">Tráiganos sus ideas más locas y con nuestra mentalidad creativa y nuestras herramientas las haremos realidad. Nuestro equipo le proporcionará un sitio único diseñado para sus necesidades específicas y lo ayudará a desarrollar una estrategia comercial en línea. para superar a sus competidores</p>
                    </div>
                </article>
                <article class="row-start gap-10">
                    <div>
                        <span class="material-symbols-outlined">group</span>
                    </div>
                    <div class="column-start gap-15 text-align-start">
                        <h3 class="padding-top-15">Soporte 24/7</h3>
                        <p class="text-small">Te ayudaremos a convertir a tus visitantes en clientes y aumentar tus ingresos</p>
                    </div>
                </article>
                <article class="row-start gap-10">
                    <div>
                        <span class="material-symbols-outlined">star</span>
                    </div>
                    <div class="column-start gap-15 text-align-start">
                        <h3 class="padding-top-15">Equipo profesional</h3>
                        <p class="text-small">Somos una empresa de desarrollo web profesional con un equipo de expertos en tecnología que siempre están al tanto de las últimas tendencias en desarrollo web, diseño web, SEO y marketing.</p>
                    </div>
                </article>
                <article class="row-start gap-10">
                    <div>
                        <span class="material-symbols-outlined">avg_pace</span>
                    </div>
                    <div class="column-start gap-15 text-align-start">
                        <h3 class="padding-top-15">Trabajo rapido</h3>
                        <p class="text-small">Estamos orientados a los resultados y nos apasiona cada uno de nuestros proyectos, y “OK” no es lo suficientemente bueno para nosotros.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <section class="container">
        <img class="background-image__all" src="{{asset('./../image/image-persons-desk.png')}}" alt="">
        <div class="content padding-y-60">
            <div class="phrase row-center gap-25">
                <div class="phrase__column column-center gap-25 text-align-start">
                    <h2 class="phrase__column__title">Experiencia en la industria + Equipo enfocado en láser =</h2>
                    <h1 class="phrase__column__title"><span class="phrase__column__title__span">ÉXITO</span></h1>
                </div>
                <div class="phrase__column column-center text-align-start">
                    <p class="text-small">Las empresas saben que un solo gerente de marketing a tiempo completo simplemente no puede realizar todas las funciones del marketing digital. Comrade Web Agency se posiciona como su socio de marketing digital: cubrimos todos los aspectos de su sitio web, marca, estrategia de marketing digital y análisis de datos, todo mientras somos dueños de nuestros resultados (clientes potenciales, llamadas, ventas, conversiones, tráfico dirigido, etc.).</p>
                </div>
                <div class="phrase__column column-center">
                    <img class="phrase__column__image" src="{{asset('./../image/image-devices-desk.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="content width-78">
            <!-- Swiper -->
            <div class="swiper swiperQuestion">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <article class="question column-center">
                            <div class="question__title">
                                <h4>Pregunte a nuestros clientes</h4>
                            </div>
                            <div class="question__content row-center gap-50">
                                <img class="question__content__image" src="{{asset('./../image/image-man1-desk.jpeg')}}" alt="">
                                <div class="column-start gap-25 text-align-start question__content__text">
                                    <p>Creative Studio es una agencia creativa de servicio completo que se especializa en diseño web personalizado, desarrollo web, UI / UX y desarrollo de software. Habiendo trabajado con casi todos los lenguajes tecnológicos (.NET, PHP, Laravel, Angular 1.0 / 2.0, etc.), comenzamos con sus objetivos comerciales y luego brindamos la solución escalable adecuada.</p>
                                    <p><span>Dani Yourk</span></p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="swiper-slide">
                        <article class="question column-center">
                            <div class="question__title">
                                <h4>Pregunte a nuestros clientes</h4>
                            </div>
                            <div class="question__content row-center gap-50">
                                <img class="question__content__image" src="{{asset('./../image/image-man1-desk.jpeg')}}" alt="">
                                <div class="column-start gap-25 text-align-start question__content__text">
                                    <p>Nuestra gama de servicios incluye marca completa, SEO, PPC, videos explicativos y marketing entrante. 
                                        Nuestros clientes van desde emprendedores hasta compañías Fortune 100 en una amplia gama de industrias. Nuestro equipo ha terminado Más de 15 años de experiencia en sus áreas de especialización.</p>
                                    <p><span>Mark Johnson</p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
    <footer class="container column-center footer">
        <p><a href="">Template</a> creado con <a href="">Nicepage</a>.</p>
    </footer>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
</body>
</html>