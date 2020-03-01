<!DOCTYPE html>
<html>
<head>
	<title>Countdown Vyuh</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">


	<link href="https://fonts.googleapis.com/css?family=ZCOOL+QingKe+HuangYou" rel="stylesheet">


	<link rel="stylesheet" type="text/css" href="{{ URL::to('css/countdown/style.css') }}">

</head>
<body>

	<div class="image" style="background-image: url({{ URL::to('images/resources/countdown/image.jpg') }});">
		<div class="center">

			<h1>COMING SOON</h1>

			<hr>

			<p id="count" style="font-size: 40px"></p>

		</div>
    </div>

    <!-- javacript -->
    <script type="text/javascript">
        var fixed_time = @JSON($fixed_time);
		var date = new Date(fixed_time).getTime();
		var datefunction = setInterval(function() {
			var now = new Date().getTime();

			var dist = date - now;

			var days = Math.floor(dist / (1000*60*60*24));
			var hours = Math.floor((dist % (1000*60*60*24))/ (1000*60*60));
			var minutes = Math.floor((dist %(1000*60*60))/ (1000*60));
			var seconds = Math.floor((dist %(1000*60))/1000);

			document.getElementById("count").innerHTML = days + "d " + hours + "h  " + minutes + "m " + seconds + "s ";



			if(dist < 0){
                clearInterval(datefunction);
                location.reload(true);
			}

		}, 1000);
	</script>


</body>
</html>
