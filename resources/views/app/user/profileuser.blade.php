@extends('layouts.app')
@section('title')
	მომხმარებლის გვერდი - VIME
@stop

@section('content')
	<div class="row">
		<div class="col-md-3">
			@include('partials.usersidebar')
		</div>
		<div class="col-md-7">
		<div class="tableCentered addvacancy_div">
			<a href="#" data-toggle="modal" data-target="#instructionsModal" class="toggleInstruction">ინსტრუქცია</a>
			<button class="btn addBtn"><i class="fa fa-arrow-up" aria-hidden="true"></i>ვიდეოს დამატება</button>
		</div>
			<div class="vacancies">
				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title red">
								გაგზავნილი ვიზუმეები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				@if(count($bids)>0)
					<a href="/profile/allbids">ყველას ნახვა</a>
				@else
					გაგზავნილი ვიზუმეები არ მოიძებნა
				@endif
				<div class="items vips">
					<div class="row">
					@foreach($bids as $bid)
						<div class="col-md-12">
							<div class="item-resume">
								<div class="image pull-left">
									<img src="{{ $bid->user->getLogo() }}">
								</div>
								<div class="titlevac pull-left">
									<div class="title">
										{{ $bid->user->name }} {{ $bid->user->surname }}
									</div>
									<div class="vac">
										<a href="/vacancies/all/{{$bid->vacancy->id}}">
										{{ $bid->vacancy->position }}
										</a>
									</div>
								</div>
								<div class="pull-right">
									<div class="showVideo" data-video="{{$bid->video->link}}">
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
																Facecontrol
															</div>
															<div class="hr">
																
															</div>
													</div>
												</div>
												@if(count($facecontrols)>0)
													<a href="/profile/allfc">ყველას ნახვა</a>
												@else
													გაგზავნილი ვიდეოები არ მოიძებნა
												@endif
												<div class="items vips">
													<div class="row">
													@foreach($facecontrols as $bid)
														<div class="col-md-12">
															<div class="item-resume">
																<div class="image pull-left">
																	<img src="{{ $bid->user->getLogo() }}">
																</div>
																<div class="titlevac pull-left">
																	<div class="title">
																		{{ $bid->user->name }} {{ $bid->user->surname }}
																	</div>
																	<div class="vac">
																		<a href="/vacancies/all/{{$bid->vacancy->id}}">
																		{{ $bid->vacancy->position }}
																		</a>
																	</div>
																	<div class="status">
																		სტატუსი : 
																	</div>
																	@if($bid->accepted)
																		<div class="accepted"></div>
																	@else
																		<div class="declined"></div>
																	@endif
																</div>
																<div class="pull-right">
																	<div class="showVideo" data-video="{{$bid->video->link}}">
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
								შენახული ვაკანსიები და ივენთები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				@if(count($saved)>0)
					<a href="/profile/allsaved" class="agreen">ყველას ნახვა</a>
				@else
					შენახული ვაკანსიები/ივენთები არ მოიძებნა
				@endif
				<div class="items standart">
					<div class="row">
					@foreach($saved as $save)
						<div class="col-md-12">
							<div class="item">
							<a href="/vacancies/removesaved/{{$save->id}}" class="removeVacancy">&times;</a>
								<div class="row">
									<div class="icon pull-left">
										<img src="{{$save->vacancy->user->getLogo()}}">
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
		</div>
		<div class="col-md-2">
			@include('partials.advertisement')
		</div>
	</div>

<div id="addModal" class="modal sm fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	ვიდეოს დამატება
        </h3>
      </div>
      <div class="modal-body">
	      <div class="addLoading">
	      	<div class="text-center pleasewait">გთხოვთ დაელოდოთ</div>
	      	<img src="/img/rolling.svg">
	      </div>
      		@if(count($errors->all()) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div class="row">
				<div class="col-md-12">
			        <form id="addVideo" action="/profile/uploadvideo" method="post" class="myFormControl" enctype='multipart/form-data'>
			        	{{ csrf_field() }}
				        <div class="tableCentered">
			        		<button type="button" class="btn greenBtn">ვიზუმე</button>
					    </div> 
			    		<div class="selected text-center">
				        ფაილი არ არის არჩეული.
				        </div>
					    <input type="file" name="video" class="visumeVideo hidden">
					    <div class="tableCentered" style="margin-top: 30px;">
					    	<button type="submit" class="btn authBtn">დამატება</button>
					    </div>
					    <input type="hidden" name="type" value="visume">
			    	</form>
			    </div>
			    <div class="col-md-6">
			    	<form id="addFacVideo" action="/profile/uploadvideo" method="post" class="myFormControl hidden" enctype='multipart/form-data'>
			        	{{ csrf_field() }}
				        <div class="tableCentered">
			        		<button type="button" class="btn redBtn" style="color:white;">Facecontrol</button>
					    </div> 
			    		<div class="selected text-center">
				        ფაილი არ არის არჩეული.
				        </div>
					    <input type="file" name="video" class="facecontrolVideo hidden">
					    <div class="tableCentered" style="margin-top: 30px;">
					    	<button type="submit" class="btn authBtn" style="background: #FF8B7E; color: white; border-color:#FF8B7E; ">დამატება</button>
					    </div>
					    <input type="hidden" name="type" value="facecontrol">
			    	</form>
			    </div>
	    	</div>
      </div>
    </div>
  </div>
</div>

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
			$('.addBtn').click(function(){ $("#addModal").modal(); });
	      	@if(count($errors->all()) > 0)
	      		$("#addModal").modal();
	      	@endif
			$('#addVideo .greenBtn').click(function(){
				$('.visumeVideo').click();
			});
			$('.visumeVideo').change(function(){
				$('#addVideo .selected').html($(this).val());
			});
			$('#addVideo').submit(function(){
				$('.addLoading').fadeIn();
			});

			$('#addFacVideo .redBtn').click(function(){
				$('.facecontrolVideo').click();
			});
			$('.facecontrolVideo').change(function(){
				$('#addFacVideo .selected').html($(this).val());
			});
			$('#addFacVideo').submit(function(){
				$('.addLoading').fadeIn();
			});

			$('.showVideo').click(function(){
				$('#videoModal .video').html('<video src="/videos/'+$(this).attr('data-video')+'" controls></video>');
				$('#videoModal').modal();
			});
			<?php
				if(isset($_GET['add']) && $_GET['add']==1){
			?>
				$('#addModal').modal();
			<?php } ?>
			
		});
	</script>
@stop