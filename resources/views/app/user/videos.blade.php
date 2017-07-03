@extends('layouts.app')

@section('title')
	ჩემი ვიდეოები - Vime
@stop

@section('content')
	<div class="row">
		<div class="col-md-2">
		@include('partials.usersidebar')
		</div>
		<div class="col-md-8">
			<h3 class="text-center">ჩემი ვიდეოები</h3>
			@if(session('uploadStatus'))
				<div class="alert alert-success">
					{{ session('uploadStatus') }}
				</div>
			@endif
			<div class="videos">
				<h3 class="text-center">ვიზუმეები</h3>
				<div class="row">
					@foreach($videos as $video)
						<div class="col-md-4">
							<div class="video">
							<a href="/videos/remove/{{$video->id}}" class="removeVideo">&times;</a>
								<video src="/videos/{{ $video->link }}" controls></video>
							</div>
						</div>
					@endforeach
				</div>
				<h3 class="text-center hidden" style="color: #FF8B7E;">Facecontrol</h3>
				<div class="row hidden">
					@foreach($fvideos as $video)
						<div class="col-md-4">
							<div class="video">
							<a href="/videos/remove/{{$video->id}}" class="removeVideo">&times;</a>
								<video src="/videos/{{ $video->link }}" controls></video>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-md-2">
			@include('partials.advertisement')
		</div>
	</div>
@stop

@section('js')
	<script type="text/javascript">
		$('.removeVideo').click(function(ev){
			ev.preventDefault();
			if(confirm("ნამდვილად გსურთ მონიშნული ვიდეოს წაშლა?")){
				location.replace($(this).attr('href'));
			}
		});
	</script>
@stop