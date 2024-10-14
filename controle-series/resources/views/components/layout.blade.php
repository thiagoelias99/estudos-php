<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Controle de Séries</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="div container-fluid">
            <a class="navbar-brand" href="{{route("series.index")}}">
                Home
            </a>
            @auth
            <a href="{{ route('logout') }}" class="btn btn-dark">Sair</a>
            @endauth
            @guest
            <a href="{{ route('login') }}" class="btn btn-dark">Entrar</a>
            @endguest
        </div>
    </nav>



    <div class="container">
        <h1>{{ $title }}</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @isset($message)
            <div class="alert alert-success">{{ $message }}</div>
        @endisset
        {{ $slot }}
    </div>
</body>

</html>
