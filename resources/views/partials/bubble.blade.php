<?php 
use App\News;
$item = News::where('bubbled', true)->get();
 ?>

<div id="bubble" style="padding-top: 30px; color: white;">
	@foreach($item as $news)
	<a href="/news/{{$news->id}}">
		<h4 class="text-center">
			{{$news->title}}
		</h4>
		<h5 style="margin-top: 30px;" class="text-center">
			{{$news->text}}
		</h5>
	</a>	
	@endforeach

</div>
