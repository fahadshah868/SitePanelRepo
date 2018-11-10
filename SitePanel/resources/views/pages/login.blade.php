<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div class="body-main-container">
        <nav class="login-top-navbar"><a href="/">Site Panel</a></nav>
        <form action="/authenticate" method="POST">
            @csrf
            <div class="login-form">
                <div class="login-fields-heading">User Name:</div>
                <input type="text" class="form-control" placeholder="user name"/>
                <div class="login-fields-heading">Password:</div>
                <input type="password" class="form-control" placeholder="password"/>
                <input type="submit" value="Login" id="loginbutton"/>
            </div>
        </form>
    </div>
</body>
</html>