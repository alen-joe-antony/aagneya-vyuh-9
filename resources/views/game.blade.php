<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title>Question Page</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/game/style.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>
<body>

    <div class="coins">
        <h3 id='coins_val'></h3>
    <script>
        $(document).ready(function() {
            var url = "{{URL('game')}}";
            var txt = 'Coins: ';
            $.ajax({
                url: "/game/coins",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    txt += dataResult;
                    coins_val.innerText = txt;
                }
            });
        });
    </script>
    </div>

    @isset($proximity['proximity'])
	<div class="wrapper">
		<div class="proxy-wrap">
			<div class="proxymeter">

				<div class="side">
                    <div class="bar">
                        <h4>PROXIMITY : </h4>
                    </div>
                    <div class="front">
                        <h4>{{ $proximity['proximity'] ?? '' }} %</h4>
                    </div>
				</div>
				<div class="side back">
					<div class="bar">
                    </div>

				</div>
				<div class="side top">
					<div class="bar">
                    </div>

				</div>
				<div class="side bottom">
					<div class="bar">
                    </div>

				</div>
				<div class="side left"></div>
			</div>
		</div>
    </div>
    @endisset

    @isset($proximity['proximity_error'])
    <div class="wrapper" style="color:aqua">
    <h4>ERROR : OUT OF COINS</h4>
    </div>
    @endisset

	 @if (@isset($q_img_url))
	 <div class="question">
        <img src="{{ $q_img_url }}"/>
	 </div>

   @if (count($errors) > 0)
   <div class="wrapper" style="color:red">
    <ul>
    @foreach($errors->all() as $error)
     <li>{{ $error }}</li>
    @endforeach
    </ul>
   </div>
  @endif

  <form method="post" action="{{ url('/game/submitAnswer') }}">
    {{ csrf_field() }}
    <div>
     <input type="text" name="answer" placeholder="Your Answer" class="answerBox"/>
</div>

<div class="answerBoxBtn">
     <input type="submit" name="proxymeter" class="button" value="Proxymeter" />
     <input type="submit" name="submit" class="button" value="Submit" />
    </div>
    </form>

    @elseif (@isset($data))
    <div class="question">
    <img src="{{ $data['url'] }}"/>
    </div>

    <form method="get" action="{{ url('/game') }}">
     <br>
     @if($data['answer'] == 'correct')
     <div class="answerBox">
         <input type="submit" name="next" class="button" value="Next" />
     </div>
     @else
     <div class="answerBox">
         <input type="submit" name="retry" class="button" value="Retry" />
     </div>
     @endif
     </form>
    @else

    <a href="{{ url('/game/question') }}">
        <div class="reveal">Reveal Question
        </div>
    </img>
    </a>
    @endif

</body>
</html>
