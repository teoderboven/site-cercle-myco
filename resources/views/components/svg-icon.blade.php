@props(['path'])

@php
    $symbolId = 'icon-' . Str::slug(pathinfo($path, PATHINFO_FILENAME));
    $viewBox = App\Services\SvgHelper::getViewBox($path);
@endphp

@pushonce('svgSymbols', $symbolId)
    @svgSymbol($path, $symbolId)
@endpushonce

<svg {{ $attributes->class(['icon'])->merge(['viewBox' => $viewBox]) }}>
    <use href="#{{ $symbolId }}"></use>
</svg>
