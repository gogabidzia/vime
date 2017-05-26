@extends('layouts.app')
@section('title')
	{{ $vacancy->position }} - VIME
@stop

@section('content')
	<div class="row">
		<div class="col-md-2">
			@include('partials.search')
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
			@if(session('bidStatus'))
				<div class="alert alert-danger">
					{{ session('bidStatus') }}
				</div>
			@endif
				<div class="text">
					{{ $vacancy->description }}
				</div>
				<div class="params">
					<a href="#"><i class="fa fa-building" aria-hidden="true"></i> "{{ $vacancy->user->name }}"</a> <span class="spacer"> | </span> 
					<i class="fa fa-calendar" aria-hidden="true"></i>
					{{ date('Y.m.d', strtotime($vacancy->date_from)) }} - {{ date('Y.m.d', strtotime($vacancy->date_to)) }}
					<span class="spacer"> | </span>
					<i class="fa fa-globe"> {{ $vacancy->location }}</i>
				</div>
				@if(!Auth::user()->company)
					<a href="/vacancies/save/{{$vacancy->id}}">
						<button class="btn redBtn pull-left">
							<i class="fa fa-floppy-o" aria-hidden="true"></i>
							შენახვა
						</button>
					</a>
					<button class="btn greenBtn sendResume pull-right">
					<i class="fa fa-paper-plane" aria-hidden="true"></i>
					რეზიუმეს გაგზავნა</button>
					<div class="clearfix"></div>
				@endif
			</div>
		</div>
		<div class="col-md-2">
			@include('partials.advertisement')
		</div>
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
			<form id="bidResume" method="post" action="/vacancies/bid/">
				{{csrf_field()}}
				<div class="row">
					<h4 class="text-center">აირჩიეთ ვიდეო</h4>
			        <?php $i=0; ?>
			        @foreach(Auth::user()->videos()->orderBy('created_at','desc')->get() as $video)
			        <?php $i++; ?>
			        	<div class="col-md-4">
			        		<div class="sendVideo" data-id="{{$video->id}}">
			        			<video src="/videos/{{$video->link}}"></video>
			        		</div>
			        	</div>
			        @if($i%3==0)
			        	<div class="clearfix"></div>
			        @endif
			        @endforeach
		        </div>
		        <input type="hidden" name="id" value="{{$vacancy->id}}">
		        <input type="hidden" name="video_id">
		        <button class="btn greenBtn tableCentered">
			        <i class="fa fa-paper-plane" aria-hidden="true"></i>
			        გაგზავნა
		        </button>
				<div class="clearfix"></div>
			</form>
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
			$('[name="video_id"]').val($(this).attr('data-id'));
		});
	</script>
@stop