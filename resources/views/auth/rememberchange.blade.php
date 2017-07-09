<!DOCTYPE html>
<html>
<head>
	<title>
		პაროლის აღდგენა - Vime
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
		<div class="panel-body"><h4>პაროლის შეცვლა</h4></div>
		<div class="panel-footer">
			<form action="/changepass" method="post" class="myFormControl">
				<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="ახალი პაროლი">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" name="password_confirmation" placeholder="დაადასტურეთ ახალი პაროლი">
				</div>
				<input type="hidden" name="id" value="{{$id}}">
				<input type="hidden" name="token" value="{{$token}}">
				<button class="btn authBtn" type="submit">შეცვლა</button>
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