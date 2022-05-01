<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name='csrf_token' content="{{ csrf_token() }}">
    <title>Login</title>
    <style>
        .error {
            color: red;
            font-size: 14px;

        }

        span {
            color: red;
            font-size: :14px;
        }

        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(45deg, greenyellow, dodgerblue);
            font-family: "Sansita Swashed", cursive;
        }

        .center {
            position: relative;
            padding: 50px 50px;
            background: #fff;
            border-radius: 10px;
        }

        .center h1 {
            font-size: 2em;
            border-left: 5px solid dodgerblue;
            padding: 10px;
            color: #000;
            letter-spacing: 5px;
            margin-bottom: 60px;
            font-weight: bold;
            padding-left: 10px;
        }

        .center .inputbox {
            position: relative;
            width: 300px;
            height: 50px;
            margin-bottom: 50px;
        }

        .center .inputbox input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            border: 2px solid #000;
            outline: none;
            background: none;
            padding: 10px;
            border-radius: 10px;
            font-size: 1.2em;
        }

        .center .inputbox:last-child {
            margin-bottom: 0;
        }

        .center .inputbox span {
            position: absolute;
            top: 14px;
            left: 20px;
            font-size: 1em;
            transition: 0.6s;
            font-family: sans-serif;
        }

        .center .inputbox input:focus~span,
        .center .inputbox input:valid~span {
            transform: translateX(-13px) translateY(-35px);
            font-size: 1em;
        }

        .center .inputbox [type="submit"] {
            width: 50%;
            background: dodgerblue;
            color: #fff;
            border: #fff;
        }

        .center .inputbox:hover [type="submit"] {
            background: linear-gradient(45deg, greenyellow, dodgerblue);
        }

    </style>
</head>

<body>
    <div class="center">
        

        <form id="formId" action="{{ route('login') }}" method="POST">
            @csrf
            <label for="name"> Enter your name:</label>
            <div class="inputbox">

                <input type="text" name="name" id="name" value="{{ old('name') }}"><br>
            </div>
            @error('name')
                <span>{{ $message }}</span><br>
            @enderror
            <label for="password">Enter your password:</label>
            <div class="inputbox">

                <input type="password" name="password" id="password"><br>
            </div>
            @error('password')
                <span>{{ $message }}</span><br>
            @enderror

          
            <div class="inputbox">
                <input type="submit" value="Login" id="login">
            </div>
        </form>
        <a href="{{ route('showRegistrationForm') }}">Dont have an account? Register here</a>

    </div>


</body>
<script src="{{ URL('js/sweet-alert.js') }}"></script>

@if (session()->has('error'))
<script>
    swal({
        title: "{{ session()->get('error') }}",
        icon: "{{ session()->get('sweetAlertIcon') }}",
        button: "Ok",
    });
</script>
    
@endif
</html>
