@extends('layouts.app')
@section('title')
	@if(isset($pageType))
		ივენთები - VIME
	@else
		ვაკანსიები - VIME
	@endif
@stop

@section('content')
	<div class="row">
		<div class="col-md-2">
			@include('partials.companysidebar')
		</div>
		<div class="col-md-8">
		<div class="tableCentered addvacancy_div">
			<a href="#" class="toggleInstruction">ინსტრუქცია</a>
			<button class="btn addBtn"><i class="fa fa-arrow-up" aria-hidden="true"></i>დამატება</button>
		</div>
			<div class="vacancies">
				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title green">
							@if(isset($pageType))
								მიმდინარე ივენთები
							@else
								მიმდინარე ვაკანსიები
							@endif
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
							<a href="/vacancies/remove/{{$vacancy->id}}" class="removeVacancy">&times;</a>
								<div class="row">
									<div class="icon pull-left">
										<img src="{{ $vacancy->user->getLogo() }}">
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
									@if($vacancy->type !=='facecontrol')
										<div class="dates">
											{{ date('Y.m.d', strtotime($vacancy->date_from)) }} - {{ date('Y.m.d', strtotime($vacancy->date_to)) }}
										</div>
									@endif
										<div class="location">
											{{$vacancy->location}}
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
			<div class="tableCentered">
				{{$vacancies->links()}}
			</div>
		</div>
		<div class="col-md-2">
			@include('partials.advertisement')
		</div>
	</div>
@include('partials.addmodal');
@stop

@section('js')
	<script type="text/javascript">
		$(function(){


			$('.logo_upload').click(function(){
				$('.uploadInput').click();
			});

			$('.addBtn').click(function(){ $("#addModal").modal() });

			function logErrors(data){
                $('.errors').html(data.message);
                $('.errors').show();
            }
			$("#addVacancy").submit(function(e){
                e.preventDefault();
                $('#addModal .errors').html('');
                $('#addModal .errors').hide();
                var postData = $('#addVacancy').serialize();
                $.post('/vacancies/add', postData).fail(function(data){
                    logErrors(data.responseJSON);
                }).done(function(){
                    location.replace('/profile');
                });
            });
			var dateParams = {
            	language:'ka',
            	format: 'yyyy-mm-dd',
            	todayHighlight: true
            }

            $('[name="date_from"]').datepicker(dateParams);
            $('[name="date_to"]').datepicker(dateParams);
            $('.removeVacancy').click(function(ev){
            	ev.preventDefault();
            	if(confirm("ნამდვილად გსურთ მონიშნული ვაკანსიის წაშლა?")){
            		location.replace($(this).attr('href'));
            	}
            });
		});
	</script>
@stop