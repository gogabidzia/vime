@extends('layouts.app')
@section('title')
	შენახული ვაკანსიები და ივენთები - VIME
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
								შენახული ვაკანსიები და ივენთები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				<div class="items standart">
					<div class="row">
					@foreach($saved as $save)
						<div class="col-md-12">
							<div class="item">
								<div class="row">
									<div class="icon pull-left">
										<img src="{{$save->vacancy->user->logo}}">
									</div>
									<div class="pull-left marginleft">
										<div class="title">
											<a href="/vacancies/all/{{$save->vacancy->id}}">
												{{ $save->vacancy->position }}
											</a>
										</div>
										<div class="company_name">
											"{{$save->vacancy->user->name}}"
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
				{{$saved->links()}}
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