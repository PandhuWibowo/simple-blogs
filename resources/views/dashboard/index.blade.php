<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <h1>{{ Session::get('name') }}</h1>
    <h2>{{ Session::get('email') }}</h2>
    <a href="{{ url('signin/auth/signout') }}">Keluar</a>
</body>
</html>