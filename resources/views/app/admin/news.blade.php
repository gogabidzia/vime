@extends('layouts.admin')
@section('content')
<h3 class="text-center">სიახლეები</h3>
<h4 class="text-center">დამატება</h4>
<div class="container">
	<form action="?" enctype="multipart/form-data" method="post">
	{{csrf_field()}}
		<div class="form-group">
			<input class="form-control" name="title" type="text" placeholder="სახელი"></input>
		</div>
		<div class="form-group">
			<textarea id="summernote" class="form-control" name="text" placeholder="აღწერა"></textarea>
		</div>
		<div class="form-group">
			<input class="form-control" name="img" type="file" placeholder="სურათის ლინკი"></input>
		</div>
		<div class="form-group">
			<input type="radio" name="position" value="left"><label for="male">Left</label>
			<input type="radio" name="position" value="right"><label for="female">Right</label>
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
			<td>შეცვლა</td>
			<td>წაშლა</td>
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
				<td>{{ substr(strip_tags($item->text),0,15) }}</td>
				<td><a href="#" class="change">შეცვლა</a></td>
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