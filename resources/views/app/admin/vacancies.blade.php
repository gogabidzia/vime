@extends('layouts.admin')
@section('content')
<h3 class="text-center">ახალი ვაკანსიები</h3>
<form action="" method="post">
	<div class="form-group col-md-3">
		<input class="form-control" type="text" name="position" placeholder="პოზიცია">
	</div>
	<div class="form-group col-md-3">
		<input class="form-control" type="text" name="date_from" placeholder="დან">
	</div>
	<div class="form-group col-md-3">
		<input class="form-control" type="text" name="date_to" placeholder="მდე">
	</div>
	<div class="form-group col-md-3">
		<button class="btn btn-success" style="width: 100%;">ძიება</button>
	</div>
	{{csrf_field()}}
</form>
<table class="table table-bordered">
	<thead>
		<td>თანამდებობა</td>
		<td>კომპანია</td>
		<td>დან</td>
		<td>მდე</td>
		<td></td>
	</thead>
	<tbody>
		@foreach($vacancies as $vacancy)
			<tr>
				<td>
				<a target="_blank" href="/vacancies/all/{{$vacancy->id}}">{{$vacancy->position}}
				</a>
				</td>
				<td>{{$vacancy->user->name}}</td>
				<td>{{$vacancy->date_from}}</td>
				<td>{{$vacancy->date_to}}</td>
				<td class="text-center"><a class="remove" href="/admin/removevacancy/{{$vacancy->id}}">წაშლა</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
<div class="tableCentered" style="margin-top: 30px;">
	{{ $vacancies->links() }}
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
		var dateParams = {
        	language:'ka',
        	format: 'yyyy-mm-dd',
        	todayHighlight: true
        }
        $('[name="date_from"]').datepicker(dateParams);
        $('[name="date_to"]').datepicker(dateParams);
	</script>
@stop