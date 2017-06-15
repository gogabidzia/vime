<?php 
use App\News;
$item = News::where('bubbled', true)->get();
if(!isset($_COOKIE['bubble'])){
  setcookie('bubble', '1', time()+60*15);
}
 ?>
@if(count($item)>0 && !isset($_COOKIE['bubble']))
<div id="bubble" style="padding-top: 30px; color: white;">
	@foreach($item as $news)
		<h4 class="text-center">
			{{$news->title}}
		</h4>
		<h5 style="margin-top: 30px;" class="text-center">
			<?php echo $news->text; ?>
		</h5>
	@endforeach

</div>

<div id="bubblemodal" class="modal fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="moda;l-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	{{$item[0]->title}}
        </h3>
      </div>
      <div class="modal-body">
        	<?php echo $item[0]->text; ?>
      </div>
    </div>
  </div>
</div>
@endif