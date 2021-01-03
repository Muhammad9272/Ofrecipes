<!DOCTYPE html>
<html>
<head>
    <title>{{$gs->web_name}}</title>
</head>
<body>

    <h1>{{ $details['title'] }}</h1>
    <p>Name : {{ $details['name'] }} <br>
       Email: {{ $details['from'] }}<br>
       Phone: {{ $details['phone'] }}<br>
       Subject: {{ $details['subject'] }}<br><br>
       Message: {{ $details['msg'] }}<br>


    </p>
   
</body>
</html>