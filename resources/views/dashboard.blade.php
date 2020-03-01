<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">

 <title>Dashboard</title>

 <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">


 <link rel="stylesheet" type="text/css" href="{{ URL::to('css/dashboard/style.css') }}">

</head>
<body>


   <section style="padding: 100px 0;">

       <div class="container-fluid">
           <div class="container">
               <div class="row">

                   <div class="col-sm-4">
                       <div class="card text-center">
                           <div class="title">
                               <i class="far fa-chart-bar"></i>
                               <h2>Your Stats</h2>
                           </div>

                               <div class="text">
                                   <ul>
                                       {{-- <li>Your Vyuh Rank is <span class="rank">21</span></li> --}}
                                       <li><span class="coins">{{ $coins }}</span> coins remaining</li>
                                       {{-- <li>Accuracy is <span class="accuracy">56%</span></li> --}}
                                       <li><span class="levels">{{ $levels }}</span> levels completed</li>
                                       <li><span class="levels">{{ 30 - $levels }}</span> levels remaining</li>
                                   </ul>
                               </div>

                               <a href="{{ url('/game/leaderboard') }}" target="_blank">Vyuh Ranklist</a>


                       </div>
                   </div>


               <!-- second card -->

                   <div class="col-sm-4">
                       <div class="card text-center">
                           <div class="title">
                               <i class="fas fa-play-circle"></i>
                               <h2>Play More</h2>
                           </div>

                               <div class="text">
                                   <ul>
                                       <li>Hello, <span class="pname">{{ $username }}</span></li>
                                       <li><a class="logout" href="{{ url('/auth/logout') }}">Wanna Logout?</a></li>
                                       <li>Or are you ready?</li>
                                       <li>To play Vyuh 2k20</li>

                                   </ul>
                               </div>

                               <a href="{{ url('/game') }}">Let's Play</a>


                       </div>
                   </div>



               <!-- third card -->

                   <div class="col-sm-4">
                       <div class="card text-center">
                           <div class="title">
                               <i class="fas fa-hands-helping"></i>
                               <h2>Need help?</h2>
                           </div>

                               <div class="text">
                                   <ul>
                                       <li><a href="#" target="_blank">Read the rules</a></li>

                                       <li>You need clues huh?</li>
                                       <li>Guess it's not all easy</li>
                                       <li>Get you clues below</li>

                                   </ul>
                               </div>

                               <a href="#">Vyuh Clue</a>


                       </div>
                   </div>


                   <!-- end of row class -->
                   </div>
               <!-- end of container -->
           </div>
       </div>
   </section>

</body>
</html>
