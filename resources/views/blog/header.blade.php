<head>
    <link rel="icon" href="{{ asset('image/favicon.png') }}">
    <title>{{ $post['title'] }}</title>
    <!-- Metatag -->
    <meta name="keywords" content="{{ $post['title'] }}">
    <meta name="author" content="{{ $post['author'] }}" />
    <meta name="description" content="{{ $post['description'] }}">
    <!-- Scripts -->
    @vite(['resources/scss/templates/post-landing.scss', 'resources/icons/css/all.min.css', 'resources/js/post-landing.js'])
</head>
<header>
    <div class="logoHeader">
        <a href="/">
            <img src="{{ asset('image/logodr.png') }}" alt="">
        </a>
    </div>
    <div class="container">
        <nav class="container__menu">
            <div class="logoHeader">
                <a href="/">
                    <img src="{{ asset('image/logodr.png') }}" alt="">
                </a>
                <i class="fa-solid fa-x"></i>
            </div>
            <ul class="container__menu__items">
            </li>
                @foreach ($headers as $header)
                    @if (count($header['category']['posts']))
                        <li class="container__menu__items item">
                            <div class="item_title">{{ $header['category']['name'] }}</div>
                            <ul class="container__menu__items item subitems">
                                @foreach ($header['category']['posts'] as $post)
                                <li class="container__menu__items item subitems_item"><a class="subitems_item_link" href="/blog/{{ $post['id'] }}">{{ $post['title'] }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <nav class="container__mobile">
            <i class="fa-solid fa-bars"></i>
        </nav>
    </div>
</header>