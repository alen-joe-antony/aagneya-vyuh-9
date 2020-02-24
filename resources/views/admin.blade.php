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
        <h1>ADMIN PAGE</h1>
        <br>
        <form class="form-inline" method="post" action="{{ url('/admin/actions/coins_giveaway_all') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="num_coins">Enter coins to giveaway to all users</label>
                <input type="number" class="form-control" id="num_coins" placeholder="number" name="num_coins">
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <a href="{{ url('/admin/view/logs') }}" class="btn btn-primary btn-lg" role="button">View Logs</a>
        <br>
        <br>
        <table class="table table-hover">
            <tr>
              <th>Sl No</th>
              <th>Name</th>
              <th>Username</th>
              <th>User Type</th>
              <th>Status</th>
              <th>Levels Cleared</th>
              <th>Coins</th>
              <th>Profile</th>
            </tr>
            @foreach($entry as $key => $data)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$data->name}}</td>
              <td>{{$data->username}}</td>
              <td>{{$data->user_type}}</td>
              <td>{{$data->status}}</td>
              <td>{{$data->current_level - 1}}</td>
              <td>{{$data->coins}}</td>
              <td>
                <a href="{{ url('/admin/view/profile/'.$data->username) }}" class="btn btn-primary" role="button">View Profile</a>
              </td>
            </tr>
            @endforeach
        </table>
    </body>
</html>
