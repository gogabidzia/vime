<div class="userParam">
	<div class="avatar">
		<img src="/img/logoicon.png">
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
		ელ.ფოსტა : {{ Auth::user()->email }}
	</div>
	<div class="param">
		ვაკანსიები : 1
	</div>
	<div class="param">
		რეზიუმეები : 4
	</div>

	<div class="subscribe_profile">
		<img src="/img/subscribe.png" class="png">
		<h4>მიიღეთ განცხადებები მეილზე</h4>
		<button class="btn subscribeBtn"><a href="#">გამოწერა</a></button>
	</div>
</div>