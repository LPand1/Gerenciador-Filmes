@extends('filme._base')

@section('conteudo')
    <p>🚮 Lixeira do Gerenciador de Filmes!</p>
    <p><a href="{{ route('filme.index') }}">Voltar</a></p>
    <hr>

    @foreach ($filmes as $filme)
        <div style="border:1px solid; padding:2px; width:200px; display:inline-block; margin:5px;">
            <strong>{{ $filme->titulo }}</strong>
            <br><br>
            @if ($filme->imagem_capa)
                <img src="{{ asset('storage/'.$filme->imagem_capa) }}" width="200">
                <br><br>
            @endif
            Apagado: {{ $filme->deleted_at->diffForHumans() }}

            <br>
            <a href="{{ route('filme.trash.restore', $filme->id) }}">♻️ Restaurar</a>
            <br>
            <a href="{{ route('filme.trash.delete', $filme->id) }}">🔥 Apagar para sempre, para nunca mais ser recuperado</a>
        </div>
    @endforeach
@endsection