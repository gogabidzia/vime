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
								მიმდინარე ვაკანსიები
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
										<img src="/img/company.png">
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
											თბილისი
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
		<div class="col-md-2"></div>
	</div>

<div id="addModal" class="modal fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	დამატება
        </h3>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger errors" style="display: none;">
      	
      </div>
        <form id="addVacancy" action="/vacancies/add" method="post" class="myFormControl">
	        <div class="form-group">
	            <input class="form-control" name="position" placeholder="თანამდებობა"></input>
	        </div>
	        <div class="form-group">
	            <textarea type="text" class="form-control" name="description" placeholder="აღწერა"></textarea>
	        </div>
	        <div class="row">
	        	<div class="form-group col-sm-6">
	        		<input name="date_from" class="form-control" placeholder="თარიღი(დან)"></input>
	        	</div>
	        	<div class="form-group col-sm-6">
	        		<input name="date_to" class="form-control" placeholder="თარიღი(მდე)"></input>
	        	</div>
	        </div>
	        {{csrf_field()}}
	        <div class="pull-right">
	            <button class="btn authBtn" type="submit" name="">დამატება</button> 
	        </div>
	        <div class="clearfix"></div>
	    </form>
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
		});
	</script>
@stop