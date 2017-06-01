@extends('layouts.app')
@section('title')
	Facecontrol - Vime
@stop
@section('content')
<div id="content">
	<div class="row">
		<div class="col-md-2">
			@include('partials.search')
		</div>

		<div class="col-md-8">
			<div class="vacancies">
				<!-- VIPS END -->
				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title green">
								ივენთები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				<div class="items standart">
					<div class="row">
						@foreach($events as $event)
						<div class="col-md-12">
							<div class="item">
								<div class="row">
									<div class="icon pull-left">
										<img src="{{ $event->user->logo }}">
									</div>
									<div class="pull-left marginleft">
										<div class="title">
											<a href="/vacancies/all/{{$event->id}}">
												{{ $event->position }}
											</a>
										</div>
										<div class="company_name">
											"{{ $event->user->name }}"
										</div>
									</div>
									<div class="pull-right marginright">
										<div class="dates">
										</div>
										<div class="location">
											
										</div>
									</div>
									<div class="clearfix"></div>
								</div>								
							</div>
						</div>
						@endforeach
					</div>
					<div class="tableCentered">
						{{$events->links()}}
					</div>
				</div>

			</div>	
		</div>

		<div class="col-md-2">
			@include('partials.advertisement')
		</div>
	</div>	
</div>
@stop
