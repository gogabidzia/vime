@extends('layouts.app')
@section('title')
	{{ $item->title }} - VIME
@stop

@section('content')
	<div class="row">
		<div class="col-md-2">
			@include('partials.search')
		</div>
		<div class="col-md-8">
			<div class="vacancyHeader">
				<div class="vacancy-inner">
						<div class="title red">
						{!! $item->title !!}
						</div>
						<div class="hr">
							
						</div>
				</div>
			</div>
			<div class="vacancy-item">
				<div class="text">
					<!-- <img src="{!! $item->img !!}" class="img-rounded" alt="Cinque Terre" width="300" height="200"> -->
					{!! $item->text !!}
				</div>
			</div>
		</div>
		<div class="col-md-2">
			@include('partials.advertisement')
		</div>
	</div>
@stop

@section('js')
@stop