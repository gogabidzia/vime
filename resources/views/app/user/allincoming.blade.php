@extends('layouts.app')
@section('title')
	ვაკანსიები - VIME
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
							<div class="title red">
								შემოსული ვიზუმეები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				<div class="items standart">
					<div class="row">
					@foreach($incoming as $resume)
						<div class="col-md-12">
							<div class="item-resume">
								<div class="image pull-left">
									<img src="{{ $resume->user->logo }}">
								</div>
								<div class="titlevac pull-left">
									<div class="title">
										{{ $resume->user->name }} {{ $resume->user->surname }}
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
			</div>
			<div class="tableCentered">
				{{$incoming->links()}}
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
            $('.showVideo').click(function(){
				$('#videoModal .video').html('<video src="/videos/'+$(this).attr('data-video')+'" controls></video>');
				$('#videoModal').modal();
			});
		});
	</script>
@stop