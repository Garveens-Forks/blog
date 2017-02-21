@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" role="form" method="POST" action="{{ url("admin/comment/update/{$comment->id}") }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name='content' class='form-control' rows="20">{{ $comment ? $comment->content : '' }}</textarea>
                </div>
                <div class="form-group">
                    <input type='submit' value='Submit' class='btn btn-success' />
                </div>

            </form>
        </div>
    </div>
</div>



@endsection