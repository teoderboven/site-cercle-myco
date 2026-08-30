@extends('layouts.default')

@section('title', '[Blank page]')

@section('description', '[Blank page]')

@pushonce('styles')
	{{-- stylesheets --}}
@endpushonce

@pushonce('scripts')
	{{-- scripts --}}
@endpushonce

@pushonce('additions') {{-- head other tags | optionnal --}}
	{{-- meta, link --}}
@endpushonce

@section('main-content')
	{{-- hello there --}}
@endsection