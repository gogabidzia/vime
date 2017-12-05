@extends('layouts.app')

@section('content')

<div class="row">
		<div class="col-md-2">
			@include('partials.search')
		</div>
		

		<div class="col-md-8">
			<div class="vacancies">

				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title green">
								ბლოგი
							</div>
						</div>
					</div>
					<div class="items standart">
					<div class="row">
						@foreach($items as $item)
							 <div class="card mb-4">
            <img class="card-img-top" src="{!! $item->img !!}" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title">{!! $item->title !!}</h2>
              <p class="card-text">{!! $item->text !!}</p>
              <a href="#" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on January 1, 2017 by
              <a href="#">Start Bootstrap</a>
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

@endsection