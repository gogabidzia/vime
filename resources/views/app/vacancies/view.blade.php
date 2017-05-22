@extends('layouts.app')
@section('title')
	კომპანიის გვერდი - VIME
@stop

@section('content')
	<div class="row">
		<div class="col-md-2">
			search
		</div>
		<div class="col-md-8">
			<div class="vacancyHeader">
				<div class="vacancy-inner">
						<div class="title red">
							{{ $vacancy->position }}
						</div>
						<div class="hr">
							
						</div>
				</div>
			</div>
			<div class="vacancy-item">
				<div class="text">
					{{ $vacancy->description }}
				</div>
				<div class="params">
					<a href="#"><i class="fa fa-building" aria-hidden="true"></i> "{{ $vacancy->user->name }}"</a> <span class="spacer"> | </span> 
					<i class="fa fa-calendar" aria-hidden="true"></i>
					{{ date('Y.m.d', strtotime($vacancy->date_from)) }} - {{ date('Y.m.d', strtotime($vacancy->date_to)) }}
				</div>
				@if(!Auth::user()->company)
					<button class="btn greenBtn sendResume pull-right">
					<i class="fa fa-paper-plane" aria-hidden="true"></i>
					რეზიუმეს გაგზავნა</button>
					<div class="clearfix"></div>
				@endif
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>


<div id="sendModal" class="modal sm fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	რეზიუმეს გაგზავნა
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
			@if(session('uploadStatus'))
				<div class="alert alert-success">
					{{ session('uploadStatus') }}
				</div>
			@endif
			<div class="row">
				<h4 class="text-center">აირჩიეთ ვიდეო</h4>
		        @foreach(Auth::user()->videos as $video)
		        	<div class="col-md-4">
		        		<div class="sendVideo" data-id="{{$video->id}}">
		        			<video src="/videos/{{$video->link}}"></video>
		        		</div>
		        	</div>
		        @endforeach
	        </div>
	        <button class="btn greenBtn tableCentered">
		        <i class="fa fa-paper-plane" aria-hidden="true"></i>
		        გაგზავნა
	        </button>
			<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

@stop

@section('js')
	<script type="text/javascript">
		$('.sendResume').click(function(){
			$('#sendModal').modal();
		});
		$('.sendVideo').click(function(){
			$('.sendVideo').removeClass("active");
			$(this).addClass('active');
		})
	</script>
@stop