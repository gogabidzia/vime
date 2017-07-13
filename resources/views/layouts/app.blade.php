<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title')
	</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=1920">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="/css/owl.carousel.min.css">
	<link rel="stylesheet" type="text/css" href="/css/owl.theme.default.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
	@include('partials.menu')
<div id="main_wrapper"  style="background: #f1f1f1">
	@yield('content')
	@include('partials.footer')
</div>
	@include('partials.paralax')
	@include('partials.bubble')

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
			<a tabindex="-1" style="width: 100%; margin-bottom: 15px; font-size: 17px;" href="/facebook/login" class="btn btn-primary text-center"><i class="fa fa-facebook-official"></i> Facebook ავტორიზაცია</a>
			<div class="clearfix"></div>
	        {{csrf_field()}}
	        <div class="pull-right">
	            <button class="btn authBtn" type="submit" name="">შესვლა</button> 
	        </div>
	        <div class="pull-left">
	            <a href="/remember" class="forgot_password">პაროლის გახსენება</a>
	        </div>
	        <div class="clearfix"></div>
	    </form>
	    <a href="/register" class="tableCentered">რეგისტრაცია</a>
      </div>
    </div>
  </div>
</div>


<div id="contactModal" class="modal fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	კონტაქტი
        </h3>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger contErr" style="display: none">
      		
      	</div>
      	<form id="contactForm" action="/contact" method="post" class="myFormControl">
	      	<div class="row">
	      		<div class="form-group col-xs-6">
	      			<input class="form-control" type="text" name="name" placeholder="სახელი">
	      		</div>
	      		<div class="form-group col-xs-6">
	      			<input class="form-control" type="text" name="phone" placeholder="ტელეფონი">
	      		</div>
	      	</div>
	      	<div class="form-group">
	      		<input class="form-control" type="text" name="email" placeholder="ელ.ფოსტა">
	      	</div>
	      	<div class="form-group">
      			<textarea class="form-control" type="text" name="text" placeholder="ტექსტი"></textarea>
      		</div>
      		{{csrf_field()}}
      		<div class="form-group">
      			<button class="btn authBtn pull-right">
      				გაგზავნა
      			</button>
      			<div class="clearfix"></div>
      		</div>
      	</form>
      	<hr>
  		<div class="pull-left">
  			საკონტაქტო ტელეფონები <br>
  			+995-557-66-06-91
  		</div>
  		<div class="pull-right">
  			ელფოსტა <br>
  			vimesume@gmail.com
  		</div>
  		<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<div id="instructionsModal" class="modal fade loginModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center">
        	ინსტრუქცია
        </h3>
      </div>
      <div class="modal-body">
      	<iframe width="100%" height="315" src="https://www.youtube.com/embed/6A7r3SAxH68" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>

@include('partials.advmodal')

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/locales/bootstrap-datepicker.ka.min.js"></script>
<script type="text/javascript" src="/js/owl.carousel.min.js"></script>
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
	$('.toggleContactModal').click(function(ev){
		ev.preventDefault();
		$('#contactModal').modal();
	});
	$('.toggleInstructionsModal').click(function(ev){
		ev.preventDefault();
		$('#instructionsModal').modal();
	});
	$('.toggleAdvModal').click(function(ev){
		ev.preventDefault();
		$('#advModal').modal();
	});
	function logAnyErrors(data, classname){
        $(classname).html(data.message);
        $(classname).show();
    }
    $("#contactForm").submit(function(e){
        e.preventDefault();
        $('#contactModal .contErr').html('');
        $('#contactModal .contErr').hide();
        var postData = $('#contactForm').serialize();
        $.post('/contact', postData).fail(function(data){
            logAnyErrors(data.responseJSON, '#contactModal .contErr');
        }).done(function(){
            // location.replace('/');
            $('#contactModal .modal-body').html('<h3 class="text-center">წერილი წარმატებით გაიგზავნა!</h3>');
            setTimeout(function(){
            	location.replace('/');
            },3000);

        });
    });

	$('#header .owl-carousel').owlCarousel({
		items:1,
		loop:true,
		nav:true,
		// autoplay:true,
	});
	function abs(a){
		return a>=0?a:-a;
	}
	var initialY = -400;
	var sin = 0;
	var inter = setInterval(function(){
		sin+=0.01;
		initialY+=0.2;
		if(initialY>=370){
			$('#bubble').fadeOut();
			clearInterval(inter);
		}
		$('#bubble').css({
			'transform':'scale('+(1+0.1*abs(Math.sin(sin)))+')'
		});;2
		$('#bubble').css('bottom', initialY);
	},1);
	$('#bubble').click(function(){
		clearInterval(inter);
		$('#bubble').fadeOut();
		$('#bubblemodal').modal();
	});
</script>
</body>
</html>