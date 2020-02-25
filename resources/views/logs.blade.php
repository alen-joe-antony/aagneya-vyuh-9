<html>
    <body>
        <h1>Logs</h1>
        <br>
        <br>
        <table>
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
