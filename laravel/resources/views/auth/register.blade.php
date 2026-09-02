@extends('filme\_base')

@section('conteudo')

    <h1>Cadastro</h1>

    @if ($errors->any())
        <div>
            @foreach($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach 
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <label for="name">Nome</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">

        <label for="password">Senha</label>
        <input type="password" name="password" id="password">

        <label for="password_confirmation">Confirme a senha</label>
        <input type="password" name="password_confirmation" id="password_confirmation">

        <label>
        <input type="checkbox" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}>Cadastrar como administrador</label>

        <button type="submit">Cadastrar</button>
    </form>

    <p>Já tem conta? <a href="{{ route('login') }}">Fazer Login</a></p>

@endsection