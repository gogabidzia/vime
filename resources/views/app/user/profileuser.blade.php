@extends('layouts.app')
@section('title')
	მომხმარებლის გვერდი - VIME
@stop

@section('content')
	<div class="row">
		<div class="col-md-2">
			@include('partials.usersidebar')
		</div>
		<div class="col-md-8">
		<div class="tableCentered addvacancy_div">
			<a href="#" class="toggleInstruction">ინსტრუქცია</a>
			<button class="btn addBtn"><i class="fa fa-arrow-up" aria-hidden="true"></i>ვიდეოს დამატება</button>
		</div>
			<div class="vacancies">
				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title red">
								გაგზავნილი რეზიუმეები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				<div class="items vips">
					<div class="row">
						<div class="col-md-4">
							<div class="item">
								<div class="row">
									<div class="col-md-4">
										<div class="icon">
											<img src="img/company.png">
										</div>
									</div>
									<div class="col-md-8">
										<div class="title">
											გაყიდვების მენეჯერი
										</div>
										<div class="company_name">
											"კომპანია"
										</div>
										<div class="absoluted">
											<div class="dates">
												00.00.00 - 00.00.00
											</div>
											<div class="location">
												თბილისი
											</div>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
				<!-- VIPS END -->
				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title green">
								შენახული ვაკანსიები
							</div>
							<div class="hr">
								
							</div>
					</div>
				</div>
				<div class="items standart">
					<div class="row">
						<div class="col-md-12">
							<div class="item">
								<div class="row">
									<div class="icon pull-left">
										<img src="img/company.png">
									</div>
									<div class="pull-left marginleft">
										<div class="title">
											გაყიდვების მენეჯერი
										</div>
										<div class="company_name">
											"კომპანია"
										</div>
									</div>
									<div class="pull-right marginright">
										<div class="dates">
											00.00.00 - 00.00.00
										</div>
										<div class="location">
											თბილისი
										</div>
									</div>
									<div class="clearfix"></div>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="col-md-2"></div>
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
        <form id="addVideo" action="/profile/uploadvideo" method="post" class="myFormControl" enctype='multipart/form-data'>
        	{{ csrf_field() }}
	        <div class="tableCentered">
        		<button type="button" class="btn greenBtn">რეზიუმე</button>
		    </div> 
    		<div class="selected text-center">
	        ფაილი არ არის არჩეული.
	        </div>
		    <input type="file" name="video" class="hidden">
		    <div class="tableCentered" style="margin-top: 30px;">
		    	<button type="submit" class="btn authBtn">დამატება</button>
		    </div>
	    </form>
      </div>
    </div>
  </div>
</div>

@stop
@section('js')
	<script type="text/javascript">
		$('.addBtn').click(function(){ $("#addModal").modal(); });
      	@if(count($errors->all()) > 0)
      		$("#addModal").modal();
      	@endif
		$('#addVideo .greenBtn').click(function(){
			$('[name="video"]').click();
		});
	
		$('[name="video"]').change(function(){
			$('#addVideo .selected').html($(this).val());
		});

		$('#addVideo').submit(function(){
			$('.addLoading').fadeIn();
		});
		<?php
			if(isset($_GET['add']) && $_GET['add']==1){
		?>
			$('#addModal').modal();
		<?php } ?>
	</script>
@stop