<html>
    <body>
        <h1>Leaderboard</h1>
        <br>
        <br>
        <table>
        <tr>
          <th>Sl No</th>
          <th>Username</th>
          <th>Level Cleared</th>
        </tr>
        @foreach($entry as $key => $data)
        <tr>
          <td>{{$key + 1}}</td>
          <td>{{$data->username}}</td>
          <td>{{$data->current_level - 1}}</td>
        </tr>
        @endforeach
        </table>
    </body>
</html>
