<html>
    <body>
        <h1>Leaderboard</h1>
        <br>
        <br>
        <table>
        <tr>
          <th>Sl No</th>
          <th>Username</th>
          <th>Institution</th>
          <th>Level Cleared</th>
        </tr>
        @foreach($entry as $key => $data)
        <tr>
          <td>{{$key + 1}}</td>
          <td>{{$data->username}}</td>
          <td>{{ $data->institution }}</td>
          <td>{{$data->current_level - 1}}</td>
        </tr>
        @endforeach
        </table>

        @isset($admin)
        <br>
        <br>
        <table>
        <tr>
          <th>Sl No</th>
          <th>Username</th>
          <th>Institution</th>
          <th>Level Cleared</th>
        </tr>
        @foreach($entry1 as $key => $data)
        <tr>
          <td>{{$key + 1}}</td>
          <td>{{$data->username}}</td>
          <td>{{ $data->institution }}</td>
          <td>{{$data->current_level - 1}}</td>
        </tr>
        @endforeach
        </table>
        @endisset
    </body>
</html>
