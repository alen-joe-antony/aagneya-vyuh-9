<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title>Access 403</title>


	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,900" rel="stylesheet">


	<link type="text/css" rel="stylesheet" href="{{ URL::to('css/errors/unauthorized.css') }}" />



</head>

<body>

	<div id="access">
		<div class="access">
			<div class="access403">
				<h3>Access not granted</h3>
				<h1><span>4</span><span>0</span><span>3</span></h1>
			</div>
			<h2>you shall not pass</h2>
			<a href="{{ url('/') }}">Back to home</a>
		</div>
	</div>

</body>

</html>
