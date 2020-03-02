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
                <h3>uh oh! There was an</h3>
                <h1><span>ERROR</span></h1>
            </div>
            <h3>Cannot change the user type of current user</h3>
            <h2>Login as another admin user to proceed</h2>
            <a href="{{ url('/auth/logout') }}">Log Out</a>
            <a href="{{ url('/') }}">Back to home</a>
		</div>
	</div>

</body>

</html>
