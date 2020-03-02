<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>User Blocked</title>


	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,900" rel="stylesheet">


	<link type="text/css" rel="stylesheet" href="{{ URL::to('css/errors/blocked.css') }}" />



</head>

<body>

	<div id="blocked">
		<div class="blocked">
			<div class="blockedin">
				<h3>uh oh! This web page is</h3>
				<h1><span>Blocked</span></h1>
			</div>
			<h2>you are unauthorised to enter here</h2>
			<a href="{{ url('/auth/logout') }}">Log Out</a>
		</div>
	</div>

</body>

</html>
