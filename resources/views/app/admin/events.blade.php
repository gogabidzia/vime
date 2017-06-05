@extends('layouts.admin')
@section('content')
<h3 class="text-center">ახალი ივენთები</h3>
<form action="" method="post">
	<div class="form-group col-md-3">
		<input class="form-control" type="text" name="position" placeholder="პოზიცია">
	</div>
	<div class="form-group col-md-3">
		<input class="form-control" type="text" name="description" placeholder="აღწერა">
	</div>
	<div class="form-group col-md-3">
		<input class="form-control" type="text" name="location" placeholder="ლოკაცია">
	</div>
	<div class="form-group col-md-3">
		<button class="btn btn-success" style="width: 100%;">ძიება</button>
	</div>
	{{csrf_field()}}
</form>
<table class="table table-bordered">
	<thead>
		<td>სათაური</td>
		<td>კომპანია</td>
		<td>ლოკაცია</td>
		<td></td>
	</thead>
	<tbody>
		@foreach($events as $event)
			<tr>
				<td>
				<a target="_blank" href="/vacancies/all/{{$event->id}}">{{$event->position}}
				</a>
				</td>
				<td>{{$event->user->name}}</td>
				<td>{{$event->location}}</td>
				<td class="text-center"><a class="remove" href="/admin/removevacancy/{{$event->id}}">წაშლა</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
<div class="tableCentered" style="margin-top: 30px;">
	{{ $events->links() }}
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