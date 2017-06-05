@extends('layouts.admin')
@section('content')

<h3 class="text-center">კომპანიები</h3>
<form action="" method="post">
	<div class="form-group col-md-3">
		<input class="form-control" type="text" name="name" placeholder="სახელი">
	</div>
	<div class="form-group col-md-3">
		<input class="form-control" type="text" name="email" placeholder="ელ.ფოსტა">
	</div>
	<div class="form-group col-md-3">
		<input class="form-control" type="text" name="phone" placeholder="ტელეფონი">
	</div>
	<div class="form-group col-md-3">
		<button class="btn btn-success" style="width: 100%;">ძიება</button>
	</div>
	{{csrf_field()}}
</form>
<table class="table table-bordered">
	<thead>
		<td>სურათი</td>
		<td>Email</td>
		<td>კომპანიის სახელი</td>
		<td>ტელეფონი</td>
		<td></td>
	</thead>
	<tbody>
		@foreach($companies as $user)
			<tr>
				<td>
				<img src="{{$user->logo}}" width="90">
				</td>
				<td>{{$user->email}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->phone}}</td>
				<td class="text-center"><a class="remove" href="/admin/removeuser/{{$user->id}}">წაშლა</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
<div class="tableCentered" style="margin-top: 30px;">
	{{ $companies->links() }}
</div>
@stop
@section('js')
	<script type="text/javascript">
		$('.remove').click(function(ev){
			ev.preventDefault();
			if(confirm("დაადასტურეთ")){
				location.replace($(this).attr('href'));
			}
		});
	</script>
@stop