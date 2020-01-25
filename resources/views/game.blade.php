<!DOCTYPE html>
<html>
 <head>
  <title>Simple Login System in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container box">
   <h3 align="center">Simple Login System in Laravel</h3><br />

   @if(isset(Auth::user()->email))
    <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->name }}</strong>
     <br />
     <a href="{{ url('/login/logout') }}">Logout</a>
    </div>
   @else
    <script>window.location = "/login";</script>
   @endif

   <br />
   @if (@isset($q_img_url))
   <img src="{{ $q_img_url }}" width="512" />

   <form method="post" action="{{ url('/game/submitAnswer') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <label>Enter the Answer</label>
     <input type="text" name="answer" class="form-control" />
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
        <input type="submit" name="proxymeter" class="btn btn-primary" value="Proxymeter" />
    </div>
    </form>
   @elseif (@isset($data))
   <img src="{{ $data['url'] }}" width="512" />
   <form method="get" action="{{ url('/game') }}">
    <br>
    @if($data['answer'] == 'correct')
    <div class="form-group">
        <input type="submit" name="next" class="btn btn-primary" value="Next" />
    </div>
    @else
    <div class="form-group">
        <input type="submit" name="retry" class="btn btn-primary" value="Retry" />
    </div>
    @endif
    </form>
   @else
   <a href="{{ url('/game/question') }}">Reveal Question</a>
   @endif
  </div>
 </body>
</html>
