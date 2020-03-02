<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Vyuh Ranklist</title>

	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="{{ URL::to('css/leaderboard/rankstyle.css') }}">

</head>
<body style="background-image: url({{ URL::to('images/resources/leaderboard/back.png') }});">



	<div class="table">

		<h1>Vyuh Ranklist</h1>
		<table>
			<tbody>
				<tr>
					<th>Rank</th>
					<th>Your Name</th>
					<th>Your Guild</th>
					<th>Quests</th>
				</tr>

				@foreach($entry as $key => $data)
				<tr @if ($loop->first) class="first" @endif>
					<td>{{$key + 1}}</td>
					<td>{{$data->name}}</td>
					<td>{{ $data->institution }}</td>
					<td>{{$data->current_level - 1}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>



</body>
</html>
