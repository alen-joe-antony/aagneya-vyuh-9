<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h1>Logs</h1>
        <br>
        <br>
        <table class="table table-hover">
        <tr>
          <th>Sl No</th>
          <th>Timestamp</th>
          <th>IP Address</th>
          <th>Username</th>
          <th>Name</th>
          <th>User Type</th>
          <th>Action Type</th>
          <th>Description</th>
        </tr>
        @foreach($logs as $key => $data)
        <tr>
          <td>{{$key + 1}}</td>
          <td>{{$data->timestamp}}</td>
          <td>{{ $data->ip }}</td>
          <td>{{$data->username}}</td>
          <td>{{$data->name}}</td>
          <td>{{$data->user_type}}</td>
          <td>{{$data->action_type}}</td>
          <td>{{$data->action_description}}</td>
        </tr>
        @endforeach
        </table>
    </body>
</html>
