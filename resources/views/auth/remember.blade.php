<!DOCTYPE html>
<html>
<head>
	<title>
		პაროლის გახსენება - Vime
	</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="container" style="margin-top: 150px;">
	<div class="panel panel-default">
		<div class="panel-body"><h4>პაროლის გახსენება</h4></div>
		<div class="panel-footer">
    	@if(session('status'))
    	<div class="alert alert-danger">
			<ul>
				<li>{{session('status')}}</li>
			</ul>
		</div>
		@endif
		@if($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
			<form action="" method="post" class="myFormControl">
				{{csrf_field()}}
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="ელ.ფოსტა">
				</div>
				<button type="submit" class="btn authBtn pull-right">გაგზავნა</button>
				<div class="clearfix"></div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>