{{-- 
import /assets/common/css/image.css & /assets/common/js/image.js to use images 

use:
@include('partials.image', [
	'src' => '/images/path/to/image',
	'alt' => 'Alt text',
	'caption' => 'Image title',
	'author' => 'Daniel',
	'darkAuthor' => true // the author name is displayed in dark, light else
]) --}}
<figure class="image viewable">
	<figcaption class="top">
		<div>{{ $caption }}</div>
	</figcaption>
	<img src="{{ $src }}" alt="{{$alt}}" loading="lazy">
@isset($author)
	<span class="credit {{ $darkAuthor ? 'dark' : 'ligth' }}">Photo : {{ $author }}</span>
@endisset
</figure>