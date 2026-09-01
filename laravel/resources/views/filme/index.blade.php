@extends('filme/_base')

@section('conteudo')
    <p>Bem-Vindo ao Gerenciador de Filmes</p>
    <p><a href="{{ @route('filme.create') }}">+ Adicionar Filme</a></p>
    <p><a href="{{ @route('filme.trash') }}">Lixeira</a></p>
    <hr>

    @if (session('mensagem'))
        <div>{{ session('mensagem') }}</div>
    @endif()

    @foreach($filmes as $filme)
        <div style="border:1px solid; padding:2px; width:200px; display:inline-block">
            <strong>{{ $filme->titulo }}</strong>
            <br><br>

            @if ($filme->imagem_capa)
                <img src="{{ asset('storage/'.$filme->imagem_capa) }}" width="200px">
                <br><br>
            @endif

            Ano: {{ $filme->ano }}
            <br>
            Categoria: {{ $filme->categoria }}
            <br><br>
            Criado: {{ $filme->created_at->diffForHumans() }}

            @if ($filme->created_at != $filme->updated_at)
                <br>    
                Editado: {{ $filme->updated_at->diffForHumans() }}
            @endif

            <br>
            <a href="{{ route('filme.edit', $filme->id) }}">🪶</a>
            <a href="{{ route('filme.delete', $filme->id) }}">❌</a>
        </div>
    @endforeach 
@endsection