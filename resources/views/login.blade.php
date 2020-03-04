<!DOCTYPE html>
<html lang="en-IN">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Aagneya Vyuh 2019</title>

	<link rel="icon" type="image/gif" href="{{ URL::to('images/resources/login/logo.png') }}">
	<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ URL::to('css/login/homestyle.css') }}">
</head>
<body>


	<h1 class="element"></h1>
	<a class="begin" href="{{ url('/auth/redirect/google') }}">Login with Google</a>





	<!-- creating the typewriting text -->
	<script type="text/javascript" src="{{ URL::to('js/login/typed.js') }}"></script>
	<script type="text/javascript">
		var typed = new Typed('.element', {
  				strings: ["Hello there...", "Welcome to...", "VYUH 2020"],
  				typeSpeed: 70,
  				backSpeed: 70,
  				loop: true
			});

	</script>

	<div id="particles-js"></div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ URL::to('js/login/particles.js') }}"></script>
	<script type="text/javascript" src="{{ URL::to('js/login/app.js') }}"></script>

	<!-- creating the fade in effect of button -->
<script>
    $(document).ready(function() {
      $('.begin').hide().delay(5400).fadeIn(1000);});
    </script>

</html>
