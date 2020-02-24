<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <style>
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
              -webkit-appearance: none;
              margin: 0;
            }

            /* Firefox */
            input[type=number] {
              -moz-appearance:textfield;
            }
            </style>
    </head>
    <body>
        <h1> User Profile </h1>
        <br>
        <h4>Name: {{ $user_entry->name }}</h4>
        <h4>Username: {{ $user_entry->username }}</h4>
        <h4>Email: {{ $user_entry->email }}</h4>
        <h4>Login Provider: {{ $user_entry->provider }}</h4>
        <img src="{{ url($user_entry->profile_pic_url) }}">
        <h4>Institution: {{ $user_entry->institution }}</h4>
        <h4>User Type: {{ $user_entry->user_type}}</h4>
        <h4>Account Status: {{ $user_entry->status }}</h4>
        <h4>Account Created At: {{ $user_entry->created_at }}</h4>
        <h4>Account Updated At: {{ $user_entry->updated_at }}</h4>
        <h4>Levels Cleared: {{ $user_level_entry->current_level - 1 }}</h4>
        <h4>Coins: {{ $user_level_entry->coins }}</h4>

        <button class="btn btn-primary" id="stats_table_toggle_btn">
            View Question Solving Stats of
            <span class="badge badge-light">{{ $user_entry->name }}</span>
        </button>

        <table class="table table-hover" id="stats">
            <tr>
              <th>Level</th>
              <th>Start Time</th>
              <th>Finish Time</th>
              <th>Time Taken</th>
              <th>No. of Attempts</th>
            </tr>
            @foreach($solved_question_entry as $key => $data)
            <tr>
              <td>{{$data->question_no}}</td>
              <td>{{$data->start_time}}</td>
              <td>{{$data->finish_time}}</td>
              <td>{{$data->time_taken}}</td>
              <td>{{$data->attempts}}</td>
            </tr>
            @endforeach
        </table>

        <button class="btn btn-primary" id="attempts_table_toggle_btn">
            View Answers tried by
            <span class="badge badge-light">{{ $user_entry->name }}</span>
        </button>

        <table class="table table-hover" id="attempts">
            <tr>
              <th>Sl No</th>
              <th>Level</th>
              <th>Attempt</th>
              <th>Timestamp</th>
              <th>Mode</th>
              <th>Proxymeter State</th>
            </tr>
            @foreach($solved_question_entry as $key => $data)
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            @endforeach
        </table>
        <br>
        <br>
        <form class="form-inline" method="post" action="{{ url('/admin/actions/change_user_type/'.$user_entry->username) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="user_type">Choose user type:</label>
                <select id="user_type" name="user_type" class="form-control">
                  <option value="player">Player</option>
                  <option value="tester">Tester</option>
                  <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <form class="form-inline" method="post" action="{{ url('/admin/actions/coins_giveaway/'.$user_entry->username) }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="num_coins">Enter coins to giveaway</label>
                <input type="number" class="form-control" id="num_coins" placeholder="number" name="num_coins">
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>

          @if ($user_entry->status == "active")
          <a href="{{ url('/admin/actions/block_user/'.$user_entry->username) }}" class="btn btn-danger" role="button">Block User</a>
          @elseif ($user_entry->status == "blocked")
          <a href="{{ url('/admin/actions/block_user/'.$user_entry->username) }}" class="btn btn-success" role="button">Activate User</a>
          @endif
          <br>

    </body>
    <script>
        document.getElementById('stats').style.display='none';
        document.getElementById('attempts').style.display='none';


        $('#stats_table_toggle_btn').on('click', function(event) {
            var x = document.getElementById('stats');
            if (x.style.display === "none") {
                x.style.display = "table";
            }
            else {
                x.style.display = "none";
            }
        });

        $('#attempts_table_toggle_btn').on('click', function(event) {
            var x = document.getElementById('attempts');
            if (x.style.display === "none") {
                x.style.display = "table";
            }
            else {
                x.style.display = "none";
            }
        });


    </script>
</html>
