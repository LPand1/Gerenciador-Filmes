@extends('filme/_base')

@section('conteudo')
    <p>Bem-Vindo ao Gerenciador de Filmes</p>
    <p><a href="{{ @route('filme.create') }}">+ Adicionar Filme</a></p>
    <p><a href="{{ @route('filme.trash') }}">Ver filmes apagados</a></p>

    @if (session('mensagem'))
        <div>{{ session('mensagem') }}</div>
    @endif()