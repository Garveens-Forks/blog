@extends('layouts.app')
@section('content')
    <div class='container'>
    	@foreach ($articles as $article)
    		<a href='{{ url("article/{$article->id}") }}'>{{ $article->subject }}</a>
    	@endforeach
    </div>
@endsection