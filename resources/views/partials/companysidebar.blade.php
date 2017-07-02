<div class="userParam visible-md visible-lg">
	<div class="avatar">
		<img src="{{ Auth::user()->logo }}">
	</div>
	<!-- <form action="/upload/companylogo" method="post">
		<div class="form-group">
            <div class="logo_upload">
                <button type="button" class="btn btn-success">
                    <i class="fa fa-photo" aria-hidden="true"></i> ლოგოს ატვირთვა
                </button>
            </div>
            <input class="uploadInput hidden" type="file" name="logo">
        </div>
	</form> -->
	<h4 class="username">
		{{ Auth::user()->name }} {{ Auth::user()->surname }}
		<!-- <span class="edit">
			<i class="fa fa-pencil" aria-hidden="true"></i>
		</span> -->
	</h4>
	<div class="param">
		ნომერი : {{ Auth::user()->phone }}
	</div>
	<div class="param">
		ვაკანსიები : {{ count(Auth::user()->vacancies()->where('type', 'vacancy')->get()) }}
	</div>
	<div class="param">
		ივენთები : {{ count(Auth::user()->vacancies()->where('type', 'facecontrol')->get()) }}
	</div>
	<div class="subscribe_profile visible-md visible-lg">
		<img src="/img/subscribe.png" class="png">
		<h4>მიიღეთ განცხადებები მეილზე</h4>
		<button class="btn subscribeBtn"><a href="#">გამოწერა</a></button>
	</div>
	
</div>