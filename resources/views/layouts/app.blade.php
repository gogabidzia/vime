<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title')
	</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
@include('partials.menu')

@yield('content')

@include('partials.footer')




<div id="loginModal" class="modal fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	შესვლა
        </h3>
      </div>
      <div class="modal-body">
      <div class="alert alert-danger modalLoginError" style="display: none;">
      	ელ-ფოსტა ან პაროლი არასწორია. 
      </div>
        <form action="/login" method="post" class="myFormControl modalLogin">
	        <div class="form-group">
	            <input class="form-control" name="email" placeholder="ელ.ფოსტა"></input>
	        </div>
	        <div class="form-group">
	            <input type="password" class="form-control" name="password" placeholder="პაროლი"></input>
	        </div>
	        {{csrf_field()}}
	        <div class="pull-right">
	            <button class="btn authBtn" type="submit" name="">შესვლა</button> 
	        </div>
	        <div class="pull-left">
	            <a href="#" class="forgot_password">პაროლის გახსენება</a>
	        </div>
	        <div class="clearfix"></div>
	    </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/locales/bootstrap-datepicker.ka.min.js"></script>

<script type="text/javascript">
	$('#search form select[name="type"]').change(function(){
		if($(this).val()=='facecontrol'){
			$('.fcFormGroup').hide();
		}
		else{
			$('.fcFormGroup').show();
		}
	});
</script>
@yield('js')

<script type="text/javascript">
	$('#loginButton').click(function(){
		$('#loginModal').modal();
	});
	$('.modalLogin').submit(function(e){
		e.preventDefault();
		$('.modalLoginError').hide();
		var postData = $('.modalLogin').serialize();
		$.post('/login', postData).fail(function(data){
			$('.modalLoginError').show();
		}).done(function(){
			location.replace('/');
		});
	});
	$('.showNotifVideo').click(function(){
			$('#notificationModal .video').html('<video src="/videos/'+$(this).attr('data-video')+'" controls></video>');
			$('#notificationModal').modal();
	});
	@if(Auth::check() && Auth::user()->company)
	var notificationcount = {{ count(Auth::user()->notifications) }};
	@endif
	$('.notificationBtn').click(function(){
		if(notificationcount>0){
			$.get('/readnotifications');
		}
	});

</script>
</body>
</html>