@props(['title', 'class'])

<div class="info-group {{ $class ?? '' }}">
    <h5 class="group-title">{{ $title }}</h5>
    <ul class="infos-container">
        {!! $slot !!}
    </ul>
</div>
