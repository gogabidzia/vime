@extends('layouts.app')

@section('title')

სიახლეები - VIME

@endsection

@section('content')
<style type="text/css">
	

body{margin-top:20px;}

/* Latest News */
.latest-news-box {
    background-color: #fff;
	border-radius: 4px;
	border: 1px solid #ddd;
	overflow: hidden;
}

.item .content {
	padding: 15px;
	height: 250px;
}

.item {
	position: relative;
	width: 100%;
	height: 100%;
	cursor: pointer;
}

.item h2 {
	color: #4c4c4c;
	font-size: 18px;
}

.item p {
	font-size: 12px;
	line-height: 22px;
	margin: 10px 0;
}

.item p.date {
	font-size: 11px;
	font-weight: 600;
	color: #868686;
	opacity: .8;
	margin: 0;
}

.item .comments {
	position: absolute;
	bottom: 15px;
	right: 15px;
}

.latest-news-box .item .btn {
	position: absolute;
	bottom: 15px;
	left: 15px;
}

.latest-news-box .item img {
	width: 100%;
	height: 250px;
}

.img-overflow {
	background: #32b8da;
    background: -webkit-linear-gradient(left, #32b8da 0%, #5cceeb 42%, #32dac3 85%);
    background: -o-linear-gradient(left, #32b8da 0%, #5cceeb 42%, #32dac3 85%);
    background: linear-gradient(to right, #32b8da 0%, #5cceeb 42%, #32dac3 85%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#32b8da', endColorstr='#32dac3',GradientType=1 );
	width: 100%;
	height: 100%;
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
}

.item:hover .img-overflow {
	opacity: .8;
  	-webkit-transition: all 0.5s ease-out;
  	   -moz-transition: all 0.5s ease-out;
  	     -o-transition: all 0.5s ease-out;
  	        transition: all 0.5s ease-out;

}

.item .arrow-left {
  	width: 0;
  	height: 0;
  	border-top: 10px solid transparent;
  	border-bottom: 10px solid transparent;

	border-right: 10px solid #fff;
	position: absolute;
	top: 15px;
	right: 0;
}

.item .arrow-right {
  	width: 0;
  	height: 0;
  	border-top: 10px solid transparent;
  	border-bottom: 10px solid transparent;

	border-left: 10px solid #fff;
	position: absolute;
	top: 15px;
	left: 0;

}

img {
    max-width: 100%;
}

.nopadding {
    padding: 0 !important;
}

.btn.blue, a.btn.blue {
    background: #46bea1;
    border-color: #32b8da;
}
.black{
	color: black;
}

</style>
<div class="row">
		
			<div class="vacancies" >
				<div class="vacancyHeader">
					<div class="vacancy-inner">
							<div class="title green" >
								სიახლეები
							</div>
						</div>
					</div>
					
				
<div class="container">
    <div class="latest-news-box">
    	<!-- Row -->
    	<div class="row nomargin">
    		@foreach($items as $item)
    		@if($item->position=='left')
    		<div class="col-md-6 nopadding">
    			<div class="item item-left">
    				<div class="col-md-6 nopadding hidden-xs">
    					<img src="{{ $item->img }}" alt="News Image">
    					<span class="img-overflow"></span>
    					<div class="arrow-left"></div>
    				</div>
    
    				<div class="col-md-6 nopadding">
    					<div class="content">
    						<p class="date">{{ date('l jS F Y', strtotime($item->created_at)) }}</p>
    						<h2>{{ $item->title }}</h2>
    						<p>{{ substr(strip_tags($item->text),0,15) }}</p>
    						<a href="/news/{{ $item->id }}" class="btn blue small black">მეტი.....</a>
    					</div>
    				</div>
    			</div>
    		</div>
    		@else
    		<div class="col-md-6 nopadding">
    			<div class="item item-right">
    				<div class="col-md-6 nopadding">
    					<div class="content">
    						<p class="date">{{ date('l jS F Y', strtotime($item->created_at)) }}</p>
    						<h2>{{ $item->title }}</h2>
    						<p>{{ substr(strip_tags($item->text),0,15) }}</p>
    						<a href="/news/{{ $item->id }}" class="btn blue small black">მეტი.....</a>
    					</div>
    				</div>
    
    				<div class="col-md-6 nopadding hidden-xs">
    					<img src="{{ $item->img }}" alt="News Image">
    					<span class="img-overflow"></span>
    					<div class="arrow-right"></div>
    				</div>
    			</div>
    		</div>
    		@endif
    		@endforeach
    	</div> 
    </div>
</div>	
			</div>
		
		
		</div>
	</div>
</div>


@endsection

<!-- 
@foreach($items as $item)
						<h2 class="card-title">{!! $item->title !!}</h2>
							 <div class="card mb-4">
            <img src="{!! $item->img !!}" class="img-rounded" alt="Cinque Terre" width="250" height="200">
            <div class="card-body">
              
              <p class="card-text" >{!! $item->text !!}</p>
              <a href="/news/{{ $item->id }}" class="btn btn-primary">კითხვის გაგრძელება &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              {{ $item->created_at }}
            </div>
          </div>
					@endforeach

	-->