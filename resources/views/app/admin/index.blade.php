@extends('layouts.admin')
@section('content')
<h3 class="text-center">ახალი ვაკანსიები</h3>
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
<h3 class="text-center">ახალი ივენთები</h3>
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
<h3 class="text-center">მომხმარებლები</h3>
<table class="table table-bordered">
	<thead>
		<td>სურათი</td>
		<td>Email</td>
		<td>სახელი</td>
		<td>გვარი</td>
		<td>ტელეფონი</td>
		<td></td>
	</thead>
	<tbody>
		@foreach($users as $user)
			<tr>
				<td>
				<img src="{{$user->logo}}" width="90">
				</td>
				<td>{{$user->email}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->surname}}</td>
				<td>{{$user->phone}}</td>
				<td class="text-center"><a class="remove" href="/admin/removeuser/{{$user->id}}">წაშლა</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
<h3 class="text-center">კომპანიები</h3>
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