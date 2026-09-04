@props(['title', 'class'])

<div class="info-group {{ $class ?? '' }}">
    <h5 class="group-title">{{ $title }}</h5>
    <div class="infos-container">
        {!! $slot !!}
    </div>
</div>
