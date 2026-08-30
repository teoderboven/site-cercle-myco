{{-- 
use:
@include('partials.image', [
	'src' => '/images/path/to/image',
	'alt' => 'Alt text',
	'caption' => 'Image title',
	'author' => 'Daniel',
	'darkAuthor' => true // the author name is displayed in dark, light else
]) --}}

@pushonce('styles')
	<link rel="stylesheet" href="/assets/common/css/images.css">
@endpushonce

@pushonce('scripts')
	<script src="/assets/common/js/images.js"></script>
@endpushonce

<figure class="image viewable">
	<figcaption class="top">
		<div>{{ $caption }}</div>
	</figcaption>
	<img src="{{ $src }}" alt="{{$alt}}" loading="lazy">
@isset($author)
	<span class="credit {{ $darkAuthor ? 'dark' : 'light' }}">Photo : {{ $author }}</span>
@endisset
</figure>