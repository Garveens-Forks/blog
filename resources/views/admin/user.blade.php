@extends('layouts.app')


@section('content')
<div class="container">
	<form method="post" action='{{ url('admin/user/update') }}'  enctype='multipart/form-data'>
		{{ csrf_field() }}
		<input type='file' name='avatar' class='form-control'>
		<input type='submit' class='form-control'>
	</form>
</div>
@endsection