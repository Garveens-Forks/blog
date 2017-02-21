@extends('layouts.app')
@section('content')
    <div class='container'>
        <div>
    {{ $article->subject }}
    </div>
    <div>
        {{ $article->content }}
    </div>
</div>

@if (Auth::guest())
<a href='/login'>Login to comment</a>
@else
@foreach ($article->comments as $comment)
<div>
    <img style='max-width: 40px;max-height: 40px' src='{{ url('upload/' . $comment->user->avatar) }}'>{{ $comment->user->email }} : {{ $comment->content }}
</div>
@endforeach

<form method='post' action='/comment'>
{{ csrf_field() }}
<input type='hidden' name='article_id' value='{{ $article->id }}'>
<input name='content' class='form-control'>
<input type='submit' class='form-control' value='Comment'>
</form>

@endif



@endsection