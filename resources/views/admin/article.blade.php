@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/article/' . ($article ? "update/{$article->id}" : 'store')) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input name='subject' class='form-control' value="{{ $article ? $article->subject : '' }}" />
                </div>
                <div class="form-group">
                    <textarea name='content' class='form-control' rows="20">{{ $article ? $article->content : '' }}</textarea>
                </div>
                <div class="form-group">
                    <select name='category_id' class='form-control'>
                        @foreach ($categories as $category)
                            <option value='{{ $category->id }}' {{ $article ? ($article->categories[0]->id == $category->id ? 'selected' : '') : '' }}  >{{ $category->name }}</option>
                            }
                        @endforeach
                    </select>
                    <input type='submit' value='Submit' class='btn btn-success' />
                </div>

            </form>
        </div>
    </div>
</div>



@endsection