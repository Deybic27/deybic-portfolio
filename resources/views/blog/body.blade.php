<body>
    <section class="banner">
        <div class="banner__image">
            <!-- <img src="{{ asset('image/bannerHtml.jpg') }}" alt=""> -->
            {{ $post['media'] }}
        </div>
    </section>
    <section class="post">
        <div class="post_body">
            <div class="post_body__info">
                <div class="post_body__info_title">
                    <h1>{{ $post['title'] }}</h1>
                </div>
                <div class="post_body__info_content">
                    <ul>
                        <li>{{ $post['created_at'] }}</li>
                        <li>{{ $post['author'] }}</li>
                    </ul>
                </div>
                <ul class="post_body__info_social">
                    <li><i class="fa-brands fa-twitter"></i></li>
                    <li><i class="fa-brands fa-facebook"></i></li>
                </ul>
            </div>
            <div class="post_body__content">
                <div class="post_body__content_description">
                    <p>
                        {!! $post['description'] !!}
                    </p>
                </div>
            </div>
        </div>
    </section>
</body>