<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Histórias Perdidas')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin:0; padding:0;
            font-family: Arial, sans-serif;
            background: url('@yield('bg-url','https://i.imgur.com/Xn3zXUQ.png')') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            position: relative;
            height: 60px;
        }

        main {
            flex: 1;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            padding:40px 20px;
            box-sizing:border-box;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: rgba(255,255,255,0.8);
            font-weight: bold;
            cursor: pointer;
        }

        footer:hover {
            text-decoration: underline;
        }

        h1 {
            font-size:3em;
            margin:0 0 10px;
            color:#333;
            text-align:center;
        }

        p.subtitle {
            font-size:1.3em;
            margin:0 0 40px;
            color:#555;
            text-align:center;
            max-width:700px;
            line-height:1.4;
        }

        button, input[type="submit"] {
            background-color: #A33617;
            color: #FFFFFF;
            border: 2px solid #A33617;
            padding: 15px 0;
            font-size: 1.2em;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover, input[type="submit"]:hover {
            background-color: #FFFFFF;
            color: #A33617;
        }

        input[type="text"], input[type="email"], input[type="password"],
        input[type="date"], textarea {
            width:100%;
            padding:12px;
            font-size:1em;
            border:2px solid #A33617;
            border-radius:6px;
            box-sizing:border-box;
            margin-bottom:20px;
        }

        .login-btn {
            position:absolute;
            top:20px;
            right:20px;
            padding:12px 20px;
        }

        .menu-buttons {
            display:flex;
            flex-direction:column;
            gap:25px;
            width:350px;
            margin-top:20px;
        }

        .menu-buttons a {
            text-decoration:none;
            text-align:center;
            padding:18px 0;
            font-size:1.4em;
            color:#FFFFFF;
            background-color:#A33617;
            border:2px solid #A33617;
            border-radius:8px;
            transition: all 0.3s ease;
        }

        .menu-buttons a:hover {
            background-color:#FFFFFF;
            color:#A33617;
        }
    </style>
</head>
<body>
    <header>
        @auth
            <a href="{{ route('perfil') }}"><button class="login-btn">Perfil</button></a>
        @else
            <a href="{{ route('login.show') }}"><button class="login-btn">Login</button></a>
        @endauth
    </header>

    <main>@yield('content')</main>

    <footer onclick="window.location='{{ route('menu') }}'">
        Histórias Perdidas
    </footer>
</body>
</html>