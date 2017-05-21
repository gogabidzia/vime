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
			<form action="/profile/update" method="post" class="myFormControl">
				
			</form>
		</div>
		<div class="col-md-2">
			
		</div>
	</div>
@stop