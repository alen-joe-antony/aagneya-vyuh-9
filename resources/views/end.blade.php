<!DOCTYPE html>
<html lang="en-IN">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Aagneya Vyuh 2019</title>

	<link rel="icon" type="image/gif" href="logo.png">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ URL::to('css/end/endstyle.css') }}">
</head>
<body>


	<h1 class="element"></h1>



	<!-- creating the typewriting text -->
	<script type="text/javascript" src="{{ URL::to('js/end/typed.js') }}"></script>
	<script type="text/javascript">
		var typed = new Typed('.element', {
  				strings: ["thanks for playing", "vyuh 2019"],
  				typeSpeed: 50,
  				backSpeed: 50,
  				loop: true
			});

	</script>

	<div id="particles-js"></div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ URL::to('js/end/particles.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('js/end/app.js') }}"></script>


</html>
