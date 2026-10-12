@pushonce('assets')
    @stack('home-carousel-preload')
@endpushonce

<div id="homeCarousel">
    <div class="carousel-wrapper">
        <div class="carousel-border left"></div>
        <div class="carousel-content">
            <ul class="carousel-track">
                {{ $slot }}
            </ul>
        </div>
        <div class="carousel-border right"></div>
    </div>
    <div class="dots">
        @for($i = 1; $i <= $context->getCount(); $i++)
            @php
                $title = "Slide $i du carousel";
            @endphp
            <button class="dot {{ $i === 1 ? 'active' : '' }}" title="{{ $title }}" aria-label="{{ $title }}"></button>
        @endfor
    </div>
</div>