<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Filmes</title>
</head>
<body>
    <h1>Gerenciador de Filmes</h1>
    <hr>
    @yield('conteudo')

    @auth
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Sair ({{ auth()->user()->name }})</button>
        </form>
    @endauth
</body>
</html>