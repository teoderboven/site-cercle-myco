@props(['route', 'image', 'title'])

@pushonce('home-carousel-preload')
    <link rel="preload" as="image" href="{{ $image }}">
@endpushonce

<li>
    <article class="carousel-item">
        <a href="{{ $route }}" class="item-link" draggable="false" tabindex="-1">
            <img src="{{ $image }}" alt="{{ $title }}" draggable="false">
            <div class="content">
                <h2>{{ $title }}</h2>
            </div>
        </a>
    </article>
</li>