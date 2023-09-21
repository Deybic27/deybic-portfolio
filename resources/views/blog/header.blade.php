<head>
    <link rel="icon" href="{{ asset('image/favicon.png') }}">
    <title>{{ $post['title'] }}</title>
    <!-- Scripts -->
    @vite(['resources/scss/templates/post-landing.scss', 'resources/icons/css/all.min.css'])
</head>
<header>
    <div class="logoHeader">
        <a href="/">
            <img src="{{ asset('image/portfolio/imgPerfil.jpg') }}" alt="">
        </a>
    </div>
    <div class="container">
        <nav class="container__menu">
            <ul class="container__menu__items">
            </li>
                @foreach ($headers as $header)
                <li class="container__menu__items item">
                    {{ $header['category']['name'] }}
                    <ul class="container__menu__items item subitems">
                        @foreach ($header['category']['posts'] as $post)
                        <li class="container__menu__items item subitems_item"><a class="subitems_item_link" href="/blog/{{ $post['id'] }}">{{ $post['title'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>