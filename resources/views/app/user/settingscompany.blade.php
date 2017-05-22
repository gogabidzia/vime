@extends('layouts.app')

@section('title')
	პარამეტრები - Vime
@stop

@section('content')
	<div class="row">
		<div class="col-md-2">
		@include('partials.companysidebar')
		</div>
		<div class="col-md-8">
			<h3 class="text-center">ანგარიშის პარამეტრები</h3>
			<br>
			<h4 class="text-center">პაროლის განახლება</h4>
			<form id="changePass" action="/profile/updatepassword" method="post" class="myFormControl">
				{{csrf_field()}}
				<div class="alert alert-danger errors" style="display: none;"></div>
				<div class="form-group">
					<input class="form-control" type="password" name="password" placeholder="ახალი პაროლი"></input>
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password_confirmation" placeholder="გაიმეორეთ პაროლი"></input>
				</div>
				<div class="pull-right">
					<button type="submit" class="authBtn">შეცვლა</button>
				</div>
				<div class="clearfix"></div>
			</form>
			<h4 class="text-center">ლოგოს ატვირთვა</h4>
			@if(count($errors->all()) > 0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
					{{ $error }}
				@endforeach
			</div>
			@endif
			<form id="upload_logo" action="/profile/uploadlogo" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="file" name="logo">

				<div class="pull-right">
					<button type="submit" class="authBtn">ატვირთვა</button>
				</div>

			</form>
		</div>
		<div class="col-md-2">
			
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript">
		$(function(){
			function logErrors(data){
                $('#changePass .errors').html(data.message);
                $('#changePass .errors').show();
            }
			$("#changePass").submit(function(e){
                e.preventDefault();
                $('#changePass .errors').html('');
                $('#changePass .errors').hide();
                var postData = $('#changePass').serialize();
                $.post('/profile/updatepassword', postData).fail(function(data){
                    logErrors(data.responseJSON);
                }).done(function(){
                    location.replace('/profile');
                });
            });
		});
	</script>
@stop