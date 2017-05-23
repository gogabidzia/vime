@extends('layouts.app')
@section('title')
	ძებნა - Vime
@stop
@section('content')
@include('partials.headerbanner')
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
								განცხადებები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				<div class="items standart">
					<div class="row">
						@foreach($vacancies as $vacancy)
						<div class="col-md-12">
							<div class="item">
								<div class="row">
									<div class="icon pull-left">
										<img src="{{ $vacancy->user->logo }}">
									</div>
									<div class="pull-left marginleft">
										<div class="title">
											<a href="/vacancies/all/{{$vacancy->id}}">
												{{ $vacancy->position }}
											</a>
										</div>
										<div class="company_name">
											"{{ $vacancy->user->name }}"
										</div>
									</div>
									<div class="pull-right marginright">
										<div class="dates">
											{{ date('Y.m.d', strtotime($vacancy->date_from)) }} - {{ date('Y.m.d', strtotime($vacancy->date_to)) }}
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
				</div>

			</div>	
		</div>

		<div class="col-md-2">
			@include('partials.advertisement')
		</div>
	</div>	
</div>
@stop