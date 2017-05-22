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
					<li><a href="/profile">პროფილი</a></li>
					@if(!Auth::user()->company)
					<li><a href="/profile/videos">ჩემი ვიდეოები</a></li>
					@endif
					<li><a href="/profile/settings">ანგარიშის პარამეტრები</a></li>
					<li><a href="/logout">გასვლა</a></li>
				</ul>
			</div>
			<div class="dropdown pull-right">
				<button class="btn menuBtn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-bell notifications" aria-hidden="true"></i>
				</button>
				<div class="dropdown-menu">
					ახალი შეტყობინება არ არის.
				</div>
			</div>
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
					<li><a href="/instructions">ინსტრუქცია</a></li>
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
					<li><a href="/contact">კონტაქტი</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
    </nav>
</div>