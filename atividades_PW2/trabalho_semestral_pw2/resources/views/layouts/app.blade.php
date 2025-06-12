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
            background: url('{{ asset('images/fundo1.png') }}') no-repeat center top;
            background-size: 2000px 1000px;
            background-attachment: fixed;

             } 
        header { height:0; }

        main {
            flex:1;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            padding:40px 20px;
            box-sizing:border-box;
        }
        h1, h2, h3 { color:#3E2723; }

        button.btn-acao,
        input[type="submit"].btn-acao,
        a.btn-acao {
            display: inline-block;
            background-color: #A33617;
            color: #FFFFFF;
            border: 2px solid #A33617;
            padding: 15px 0;
            font-size: 1.2em;
            text-align: center;
            text-decoration: none;
            width: auto;
            min-width: 120px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button.btn-acao:hover,
        input[type="submit"].btn-acao:hover,
        a.btn-acao:hover {
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
        }

        footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            text-align: center;
            color: white;
            padding: 20px 0;
            background-color: #A33617;
            font-weight: bold;
            cursor: pointer;
            z-index: 1000;      
        }

        footer:hover 
        {
            text-decoration: underline;
        }

    </style>
</head>
<body style="display:flex; flex-direction:column; min-height:100vh;">
    <header>
        @auth
            <a href="{{ route('perfil') }}"><button class="btn-acao login-btn">Perfil</button></a>
        @else
            <a href="{{ route('login.show') }}"><button class="btn-acao login-btn">Login</button></a>
        @endauth
    </header>

    <main>@yield('content')</main>

    <footer onclick="location.href='{{ route('menu') }}'">
        Histórias Perdidas
    </footer>
</body>
</html>
