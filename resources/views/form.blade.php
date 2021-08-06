<!DOCTYPE html>
<html>
<head>
	<title>Form</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<form method="POST" action="{{ URL('formSubmit') }}">
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	 <input type="text" style="width: 500px;" name="" value="{{ csrf_token() }}">
	<input type="submit" name="">
</form>
</body>
</html>