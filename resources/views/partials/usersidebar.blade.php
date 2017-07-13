<div class="userParam">
	<div class="avatar">
		<img src="{{Auth::user()->getLogo()}}">
		<div style="margin-top: 20px;">
			<a href="/profile/removelogo">წაშლა</a>
			<a class="pull-right" href="/profile/settings">ატვირთვა</a>
		</div>
		<div class="clearfix"></div>
	</div>
	<h4 class="username">
		{{ Auth::user()->name }} {{ Auth::user()->surname }}
		<span class="edit">
		<a style="color: #95989A;" href="/profile/settings"><i class="fa fa-pencil" aria-hidden="true"></i></a>
		</span>
	</h4>
	<div class="param">
		ნომერი : {{ Auth::user()->phone }}
	</div>
	<div class="param">
		გაგზავნილი : {{ count(Auth::user()->bids)}}
	</div>
	<div class="param">
		ვიდეოები : {{ count(Auth::user()->videos) }}
	</div>
	<!-- <div class="subscribe_profile visible-md visible-lg">
		<img src="/img/subscribe.png" class="png">
		<h4>მიიღეთ განცხადებები მეილზე</h4>
		<button class="btn subscribeBtn"><a href="#">გამოწერა</a></button>
	</div> -->
</div>