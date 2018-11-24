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
    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <div class="body-main-container">
        <nav class="login-top-navbar"><a href="/">Site Panel</a></nav>
        <form action="/authenticate" method="POST" id="loginform">
            @csrf
            <div class="login-form">
                @if(Session::has('errormessage'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{Session::get('errormessage')}}</strong>
                </div>
                @endif
                <div class="login-fields-heading">User Name:</div>
                <input type="text" class="form-control" name="username" placeholder="user name"/>
                <div class="login-fields-heading">Password:</div>
                <input type="password" class="form-control" name="password" placeholder="password"/>
                <input type="submit" value="Login" id="loginbutton"/>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $("#loginform").validate({
                rules:{
                    username: "required",
                    password: "required"
                },
                messages:{
                    username: "please enter user name",
                    password: "please enter password"
                }
            });
        });
    </script>
</body>
</html>