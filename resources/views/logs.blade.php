<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/logs/style.css') }}">
    </head>
    <body>
        <h1>Logs</h1>
        <br>
        <br>
        <table id="logsTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
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
        </thead>
        <tbody>
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
        </tbody>
        </table>
        <script>
            $(document).ready(function () {
                $('#logsTable').DataTable();
                $('.dataTables_length').addClass('bs-select');
            });
            </script>
    </body>
</html>
