<footer>
    <div class="init">
        <div class="footer__info">
            <div class="footer__info_logo">
                <div class="footer__info_logo_img">
                    <img src="{{ asset('image/portfolio/imgPerfil.jpg') }}" alt="">
                </div>
                <div class="footer__info_logo_description">
                    Deybic Rojas, nacido en la Ciudad de Cúcuta, Norte de Santander, Colombia el 14 de Agosto de 1997.
                </div>
            </div>
        </div>
        <div class="footer__menus">
            <nav class="footer__menus_menu-1">
                <div class="footer__menus_menu-1_title">Acerca de nosotros</div>
                <ul class="footer__menus_menu-1_list">
                    @foreach ($headers as $header)
                        <!-- {{ $header['category']['name'] }} -->
                            @foreach ($header['category']['posts'] as $post)
                            <li class="footer__menus_menu-1_list_item"><a href="/blog/{{ $post['id'] }}">{{ $post['title'] }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </nav>
            <nav class="footer__menus_menu-2">
                <div class="footer__menus_menu-2_title">Acerca de nosotros</div>
                <ul class="footer__menus_menu-2_list">
                    <li class="footer__menus_menu-2_list_item"><a href="/">Portafolio de Deybic Rojas</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <p class="footer__copyright">&#169 deybicjrojas 2022 | Publicaciones para el portafolio de Deybic Rojas</p>
</footer>