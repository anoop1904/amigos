<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>FirstAD</title>
</head>

<body style="background-color: #ffffff;">

<h1>User Enquiry Detail</h1>
<br/>
<table>
	<tr>
		<td>Name:</td>
		<td>{{ $content['name'] }}</td>
	</tr>
	<tr>
		<td>Email:</td>
		<td>{{ $content['email'] }}</td>
	</tr>
	<tr>
		<td>Phone:</td>
		<td>{{ $content['phone_number'] }}</td>
	</tr>

	<tr>
		<td>Service:</td>
		<td>{{ $content['message'] }}</td>
	</tr>

</table>
	

</body>
</html>