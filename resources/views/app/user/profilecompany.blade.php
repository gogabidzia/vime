@extends('layouts.app')
@section('title')
	კომპანიის გვერდი - VIME
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
								შემოსული ვიზუმეები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				@if(count($incomingvac)>0)
				<a href="/profile/incoming">ყველას ნახვა</a>
				@else
					ვიზუმეები არ მოიძებნა
				@endif
				<div class="items vips">
					<div class="row">
						@foreach($incomingvac as $resume)
						<div class="col-md-12">
							<div class="item-resume">
								<div class="image pull-left">
									<img src="{{ $resume->user->getLogo() }}">
								</div>
								<div class="titlevac pull-left">
									<div class="title">
										{{ $resume->user->name }} {{ $resume->user->surname }} - {{ $resume->user->phone }} - {{ $resume->user->email }}
									</div>
									<div class="vac">
										<a href="/vacancies/all/{{$resume->vacancy->id}}">
										{{ $resume->vacancy->position }}
										</a>
									</div>
								</div>
								<div class="pull-right">
									<div class="showVideo" data-video="{{$resume->video->link}}">
										<i class="fa fa-film" area-hidden="true"></i>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				<!-- VIPS END -->

				{{--<div class="vacancyHeader">
													<div class="vacancy-inner">
															<div class="title red">
																შემოსული ვიდეოები Facecontrol-ზე
															</div>
															<div class="hr">
																
															</div>
													</div>
												</div>
												@if(count($incomingfac)>0)
												<a href="/profile/allincomingfc">ყველას ნახვა</a>
												@else
													ვიდეოები არ მოიძებნა.
												@endif
												<div class="items vips">
													<div class="row">
														@foreach($incomingfac as $resume)
														<div class="col-md-12">
															<div class="item-resume">
																<div class="image pull-left">
																	<img src="{{ $resume->user->getLogo() }}">
																</div>
																<div class="titlevac pull-left">
																	<div class="title">
																		{{ $resume->user->name }} {{ $resume->user->surname }} - {{ $resume->user->phone }}
																	</div>
																	<div class="vac">
																		<a href="/vacancies/all/{{$resume->vacancy->id}}">
																		{{ $resume->vacancy->position }}
																		</a>
																	</div>
																	<div class="status">
																		სტატუსი : 
																	</div>
																	@if($resume->accepted)
																		<div class="accepted"></div>
																	@else
																		<div class="declined"></div>
																	@endif
																	<div class="response" style="float: left; margin-top: 12px; margin-left:10px;">
																		<a href="/declinebid/{{$resume->id}}">
																			<button class="btn redBtn">
																				უარი
																			</button>
																		</a>
																		<a href="/acceptbid/{{$resume->id}}">
																			<button class="btn greenBtn">
																				მიღება
																			</button>
																		</a>
																	</div>
																</div>
																<div class="pull-right">
																	<div class="showVideo" data-video="{{$resume->video->link}}">
																		<i class="fa fa-film" area-hidden="true"></i>
																	</div>
																</div>
																<div class="clearfix"></div>
															</div>
														</div>
														@endforeach
													</div>
												</div>--}}

				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title green">
								მიმდინარე ვაკანსიები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				<div class="items standart">
				@if(count($vacancies)>0)
				<a href="/profile/vacancies"  class="agreen">ყველას ნახვა</a>
				@else
					ვაკანსიები არ მოიძებნა.
				@endif
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
										<div class="dates">
											{{ date('Y.m.d', strtotime($vacancy->date_from)) }} - {{ date('Y.m.d', strtotime($vacancy->date_to)) }}
										</div>
										<div class="location">
											{{$vacancy->location}}
										</div>
										<a href="/profile/edit/{{$vacancy->id}}" class="btn btn-default btn-md label label-danger"><span>შეცვლა</span>
										</a>
									</div>
									<div class="clearfix"></div>
								</div>								
							</div>
						</div>
					@endforeach
					</div>
				</div>

				{{--<div class="vacancyHeader">
													<div class="vacancy-inner">
															<div class="title red">
																მიმდინარე ივენთები
															</div>
															<div class="hr">
																
															</div>
													</div>
												</div>
												<div class="items standart">
												<a href="/profile/events">ყველას ნახვა</a>
													<div class="row">
													@foreach($events as $vacancy)
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
												</div>--}}

			</div>	
		</div>
		<div class="col-md-2">
			@include('partials.advertisement')
		</div>
	</div>
@include('partials.addmodal');
<div id="videoModal" class="modal sm fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	ვიდეო
        </h3>
      </div>
      <div class="modal-body">
	      <div class="video">
	      	
	      </div>
      </div>
    </div>
  </div>
</div>

@stop

@section('js')
	<script type="text/javascript">
		$(function(){
			<?php 
				if(isset($_GET['add']) && isset($_GET['add'])=="1"){
			?>
				$("#addModal").modal();
			<?php } ?>
			$('.logo_upload').click(function(){
				$('.uploadInput').click();
			});

			$('.addBtn').click(function(){ $("#addModal").modal() });

			$('.switcher .vacancy').click(function(){
				$('.switcher button').removeClass('active');
				$('.switcher .vacancy').addClass('active');
				$('.eventform').hide();
				$('.vacancyform').fadeIn();
			});
			$('.switcher .event').click(function(){
				$('.switcher button').removeClass('active');
				$('.switcher .event').addClass('active');
				$('.vacancyform').hide();
				$('.eventform').fadeIn();
			});

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
            $("#addEvent").submit(function(e){
                e.preventDefault();
                $('#addModal .errors').html('');
                $('#addModal .errors').hide();
                var postData = $('#addEvent').serialize();
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



            $('.showVideo').click(function(){
				$('#videoModal .video').html('<video src="/videos/'+$(this).attr('data-video')+'" controls></video>');
				$('#videoModal').modal();
			});
		});
	</script>
@stop