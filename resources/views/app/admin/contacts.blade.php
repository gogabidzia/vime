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
<style type="text/css">
	.table tr{
		cursor: pointer;
	}
</style>
<a href="/admin/removecontact/all" class="remove">
<button class="btn btn-warning" style="margin-bottom: 20px; margin-left:15px;">ყველა წერილის წაშლა</button>
</a>
<div class="col-md-12">
<table class="table table-bordered table-hover">
	<thead>
		<td>სახელი</td>
		<td>ტელეფონი</td>
		<td>ელ.ფოსტა</td>
		<td>ტექსტი</td>
		<td></td>
	</thead>
	<tbody>
		@foreach($contacts as $contact)
			<tr>
				<td>{{$contact->name}}</td>
				<td>{{$contact->phone}}</td>
				<td>{{$contact->email}}</td>
				<td data-fulltext="{{$contact->text}}">{{ str_limit($contact->text, 30, '...') }}</td>
				<td><a class="remove" href="/admin/removecontact/{{$contact->id}}">წაშლა</a></td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>
<div class="tableCentered" style="margin-top: 30px;">
	{{ $contacts->links() }}
</div>

<div id="contactModal" class="modal fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	წერილი
        </h3>
      </div>
      <div class="modal-body">
      <span class="name"></span>, <span class="phone"></span>, <span class="email"></span>
      <p class="text">
      	
      </p>
      </div>
    </div>
  </div>
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
		var modal = $('#contactModal');
		$('.table tr').click(function(){
			modal.modal();
			modal.find('.name').html($(this).find('td').eq(0).html());
			modal.find('.phone').html($(this).find('td').eq(1).html());
			modal.find('.email').html($(this).find('td').eq(2).html());
			modal.find('.text').html($(this).find('td').eq(3).attr("data-fulltext"));
		});
	</script>
@stop