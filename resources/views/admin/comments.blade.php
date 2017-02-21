@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Comment list</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>ID</th><th>Content</th>
                            <th>
                            </th>
                        </tr>
                        @foreach ($comments as $comment)
                            <tr class='comment'>
                                <td>
                                    {{ $comment->id }}
                                </td>
                                <td>
                                    <a href='{{ url("/article/{$comment->article->id}") }}'>{{ $comment->content }}</a>
                                </td>
                                <td>
                                    <a class='btn btn-primary' href='{{ url("admin/comment/edit/{$comment->id}") }}'>Edit</a>
                                    <!-- TODO: javascript it -->
                                    <form method='post' action='{{ url("admin/comment/destroy/{$comment->id}") }}' onsubmit='return confirm("Are you sure?")'>
                                        {{ csrf_field() }}
                                        <input type='submit' value='Delete' class='btn btn-danger'>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
