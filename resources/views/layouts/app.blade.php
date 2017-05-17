<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title')
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
@include('partials.menu')

@yield('content')

@include('partials.footer')




<div id="loginModal" class="modal fade" role="dialog">
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

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
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
</script>
</body>
</html>