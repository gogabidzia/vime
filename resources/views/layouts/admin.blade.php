<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-datepicker.min.css">
</head>
<body>
@include('partials.admin.menu')



@yield('content')
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/locales/bootstrap-datepicker.ka.min.js"></script>
@yield('js')
</body>
</html>