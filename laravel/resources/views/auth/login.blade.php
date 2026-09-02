@extends('filme\_base')

@section('conteudo')

    <h1>Login</h1>

    @if ($errors->any())
        <div>
            @foreach($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">

        <label for="password">Senha</label>
        <input type="password" name="password" id="password">

        <button type="submit">Entrar</button>
    </form>

    <p>Não tem conta? <a href="{{ route('register') }}">Cadastre-se</a></p>

@endsection