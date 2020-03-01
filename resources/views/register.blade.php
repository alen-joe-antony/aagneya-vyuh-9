<!DOCTYPE html>
<html lang="en">
<head>
	<title>email Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<link href="https://fonts.googleapis.com/css?family=ZCOOL+KuaiLe" rel="stylesheet">


	<link rel="stylesheet" type="text/css" href="{{ URL::to('css/register/register.css') }}">
</head>
<body>

    <br />
    @if (count($errors) > 0)
        <div class="alert alert-danger">
         <ul>
         @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
         @endforeach
         </ul>
        </div>
    @endif
    <br>

	<div class="container">

		<h1>Enter details</h1>

		<form name="registration_form" method="post" action="{{ url('/auth/register') }}">
                {{ csrf_field() }}
			<div>
                <input type="hidden" name="provider" value='{{$provider}}'/>
            </div>

			<div>
				<input type="hidden" name="id" value='{{$id}}'/>
			</div>

			<div class="text">
				<input type="text" name="name" placeholder="Name" value="{{$name}}">
			</div>

			<div class="text">
				<input type="text" name="username" placeholder="Username" value="">
			</div>

			<div class="text">
				<input type="text" name="institution" placeholder="College" value="">
			</div>

			<div style="display: none">
                <input type="checkbox" name="home_participant" value=1>
            </div>


			<div class="btn">
				<input type="submit" name="submit" value="Proceed">
			</div>


		</form>


	</div>

</body>
</html>
