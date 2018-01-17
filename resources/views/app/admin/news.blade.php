@extends('layouts.admin')
@section('content')
<h3 class="text-center">სიახლეები</h3>
<h4 class="text-center">დამატება</h4>
<div class="container">
	<form action="?" method="post">
	{{csrf_field()}}
		<div class="form-group">
			<input class="form-control" name="title" type="text" placeholder="სახელი"></input>
		</div>
		<div class="form-group">
			<textarea id="summernote" class="form-control" name="text" placeholder="აღწერა"></textarea>
		</div>
		<div class="form-group">
			<input class="form-control" name="img" type="text" placeholder="სურათის ლინკი"></input>
		</div>
		<div class="form-group">
			<input class="form-control" name="position" type="text" placeholder="პოზიცია"></input>
		</div>
		<div class="form-group">
			<button class="btn btn-primary">დამატება</button>
		</div>
	</form>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>სახელი</td>
			<td>აღწერა</td>
			<td></td>
			<td>მონიშვნა</td>
		</tr>
	</thead>
	<tbody>
		@foreach($news as $item)
		@if($item->bubbled)
			<tr style="background:#ededed">
		@else
			<tr>
		@endif
				<td>{{$item->title}}</td>
				<td>{{$item->text}}</td>
				<td><a href="/admin/news/remove/{{$item->id}}" class="remove">წაშლა</a></td>
				<td><a href="/admin/news/makebubble/{{$item->id}}">ბუშტის სიახლე</a></td>
			</tr>
		@endforeach
	</tbody>
</table>

@stop
@section('js')
	<script type="text/javascript">
		$(function(){
			$('a.remove').click(function(ev){
				ev.preventDefault();
				if(confirm('დაადასტურეთ')){
					location.replace($(this).attr('href'));
				}
			});
		});
		$('#summernote').summernote();
	</script>
@stop