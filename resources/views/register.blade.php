<html>
    <head>
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
        <script language="JavaScript">
            function disable_institution(status)
            {
                if(status) {
                    document.registration_form.institution.value = "GECB";
                    document.registration_form.home_participant.value = 1;
                }
                else {
                    document.registration_form.institution.value = "";
                    document.registration_form.home_participant.value = 0;
                }
                document.registration_form.institution.readOnly = status;
            }
        </script>
    </head>
    <body>
        <div class="container box">
            <br />
            @if (count($errors) > 0)
            <div class="alert alert-danger">
             <ul>
             @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
             @endforeach
             </ul>
            </div>
           @endif
            <br>
            <form name="registration_form" method="post" action="{{ url('/auth/register') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" name="provider" class="form-control" value='{{$provider}}'/>
                </div>

                <div class="form-group">
                    <input type="hidden" name="id" class="form-control" value='{{$id}}'/>
                </div>

                <div class="form-group">
                    <label>Enter Name</label>
                    <br>
                    <label>This name will be printed on the certificate issued</label>
                    <input type="text" name="name" class="form-control" value="{{$name}}" />
                </div>

                <div class="form-group">
                    <label>Enter Username</label>
                    <input type="text" name="username" class="form-control" />
                </div>

                <div class="form-group">
                    <input type="checkbox" name="home_participant" onclick="disable_institution(this.checked)"> Home Participant
                </div>

                <div class="form-group">
                    <label>Enter Institution</label>
                    <input type="text" name="institution" class="form-control" />
                </div>

                <div class="form-group">
                    <input type="submit" name="register" class="btn btn-primary" value="Register" />
                </div>
            </form>
        </div>
    </body>
</html>
