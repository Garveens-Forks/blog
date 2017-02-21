@extends('layouts.app')

@section('header')
<li><a href='javascript:;' class='new-category'>New Category</a></li>

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Category list
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>ID</th><th>Name</th>
                            <th>
                            </th>
                        </tr>
                        @foreach ($categories as $category)
                            <tr class='article'>
                                <td>
                                    {{ $category->id }}
                                </td>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id='modal-new' class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <form id='form-new'>
              <div class="modal-body">
                    <input id='name' class='form-control'>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary">
              </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script type='text/javascript'>
    window.onload = function() {
        var $ = jQuery;
        $('.new-category').click(function() {
            $('#modal-new').modal('show');
        })
        $('#form-new').submit(function() {
            var name = $('#name').val();
            if (!name) {
                alert('Name must not empty');
                return false;
            }
            $.ajax({
                url: '{{ url('admin/category/store') }}',
                data: {
                    'name': name,
                    '_token': window.Laravel.csrfToken
                },
                method: 'post',
                success: function(data) {
                    if (data.ok) {
                        alert('Save success');
                        window.location.reload();
                    } else {
                        alert('Save failed');
                    }
                },
                error: function() {
                    alert('Save failed by xhr');
                }

            })

            return false
        })
    }
    </script>
</div>


@endsection

