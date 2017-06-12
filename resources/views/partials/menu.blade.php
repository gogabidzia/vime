<?php 
	if(Auth::user() && Auth::user()->company){
		$notifications = Auth::user()->notifications()->orderBy('created_at','desc')->get();
	}
?>

<div id="menu">
	<div class="menu-absolute">
		<div class="logo">
			<a href="/">
				<img src="/img/logo.png">
			</a>
		</div>
		<div class="menu-right">
		@if(Auth::check())
			<div class="dropdown pull-right">
				<button class="btn menuBtn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i>
				</button>
				
				<ul class="dropdown-menu">
				@if(Auth::user()->type !== "admin")
					<li><a href="/profile">პროფილი</a></li>
					@if(!Auth::user()->company)
					<li><a href="/profile/videos">ჩემი ვიდეოები</a></li>
					@endif
					<li><a href="/profile/settings">ანგარიშის პარამეტრები</a></li>
					<li><a href="/logout">გასვლა</a></li>
				@else
					<li><a href="/admin">პანელი</a></li>
					<li><a href="/logout">გამოსვლა</a></li>
				@endif
				</ul>
			</div>
			@if(Auth::user()->company)
			<div class="dropdown company pull-right">
				<button class="btn menuBtn dropdown-toggle notificationBtn" type="button" data-toggle="dropdown"><i class="fa fa-bell notifications" aria-hidden="true"></i>
				@if(count($notifications)>0)
				<div class="count">{{count($notifications)}}</div>
				@endif
				</button>
				<div class="dropdown-menu" style="max-height: 400px;overflow-y: auto;overflow-x: hidden;">
				@if(isset($notifications))
				@foreach($notifications as $notification)
					<div class="item-resume notification">
						<div class="titlevac pull-left">
							<div class="title">
								{{ $notification->bid->user->name }} {{ $notification->bid->user->surname }}
							</div>
							<div class="vac">
								<a href="/vacancies/all/{{$notification->bid->vacancy->id}}">
								{{ $notification->bid->vacancy->position }}
								</a>
							</div>
						</div>
						<div class="pull-right">
							<div class="showNotifVideo" data-video="{{$notification->bid->video->link}}">
								<i class="fa fa-film" area-hidden="true"></i>
							</div>
						</div>
						<div class="clearfix"></div>	
					</div>
					@endforeach
					@endif
					@if(count($notifications)==0)
						ახალი შეტყობინება არ არის.
					@endif
				</div>
			</div>
			@endif
		@else
			<ul>
				<li class="pull-left leftFloated">
					<a href="/register">რეგისტრაცია</a>
				</li>
				<li class="pull-left leftFloated">
						<button class="btn menubtn subscribe" id="loginButton">შესვლა</button>
				</li>
			</ul>
		</div>
		@endif
	</div>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="/">მთავარი</a></li>
					<li><a class="toggleInstructionsModal" href="/instructions">ინსტრუქცია</a></li>
					<li>
					@if(Auth::check())
						<a href="/profile/?add=1">
							<button class="btn menubtn subscribe"><i class="fa fa-arrow-up" aria-hidden="true"></i>
	 						დამატება</button>
						</a>
					@else
						<a href="/subscribe">
							<button class="btn menubtn subscribe"><i class="fa fa-arrow-up" aria-hidden="true"></i>
	 						გამოწერა</button>
						</a>
					@endif
					</li>
					<li>
						<a href="/facecontrol">
							<button class="btn menubtn facecontrol">
	 						FACECONTROL</button>
						</a>
					</li>
					<li><a class="toggleContactModal" href="/contact">კონტაქტი</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
    </nav>
</div>

<div id="notificationModal" class="modal sm fade loginModal" role="dialog">
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
