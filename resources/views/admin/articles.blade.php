@extends('layouts.app')

@section('header')
<li><a href='{{ url('/admin/article/create') }}'>New Article</a></li>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Article list</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>ID</th><th>Subject</th><th>Status</th><th>Category</th><th>Comments</th>
                            <th>
                            </th>
                        </tr>
                        @foreach ($articles as $article)
                            <tr class='article'>
                                <td>
                                    {{ $article->id }}
                                </td>
                                <td>
                                    <a href='{{ url("/article/{$article->id}") }}'>{{ $article->subject }}</a>
                                </td>
                                <td>
                                    {{ $article->status }}
                                </td>
                                <td>
                                    {{ $article->categories[0]->name }}
                                </td>
                                <td>
                                    {{ $article->comments_count }}
                                </td>
                                <td>
                                    <a class='btn btn-primary' href='{{ url("admin/article/edit/{$article->id}") }}'>Edit</a>
                                    <!-- TODO: javascript it -->
                                    <form method='post' action='{{ url("admin/article/destroy/{$article->id}") }}' onsubmit='return confirm("Are you sure?")'>
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

<script>
$('.article').click(function(){
    console.log(1)
})
</script>


@endsection
