<div class="userParam">
	<div class="avatar">
		<img src="{{Auth::user()->logo}}">
	</div>
	<h4 class="username">
		{{ Auth::user()->name }} {{ Auth::user()->surname }}
		<span class="edit">
			<i class="fa fa-pencil" aria-hidden="true"></i>
		</span>
	</h4>
	<div class="param">
		ნომერი : {{ Auth::user()->phone }}
	</div>
	<div class="param">
		ელ.ფოსტა : {{ Auth::user()->email }}
	</div>
	<div class="param">
		ვაკანსიები : 1
	</div>
	<div class="param">
		რეზიუმეები : 4
	</div>
</div>