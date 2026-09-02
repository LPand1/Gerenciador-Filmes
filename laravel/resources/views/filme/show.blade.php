@extends('filme._base')

@section('conteudo')
    <a href="{{ route('filme.index') }}">⬅ Voltar</a>
    <hr>

    <h2>{{ $filme->titulo }}</h2>

    @if ($filme->imagem_capa)
        <img src="{{ asset('storage/'.$filme->imagem_capa) }}" width="300">
        <br><br>
    @endif

    <p><strong>Ano:</strong> {{ $filme->ano }}</p>
    <p><strong>Categoria:</strong> {{ $filme->categoria->nome ?? '—' }}</p>

    @if ($filme->sinopse)
        <p><strong>Sinopse:</strong> {{ $filme->sinopse }}</p>
    @endif

    @if ($filme->link_trailer)
        <p><strong>Trailer:</strong></p>

        @php
            // Tenta extrair o ID do vídeo do YouTube pra fazer embed
            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $filme->link_trailer, $matches);
            $videoId = $matches[1] ?? null;
        @endphp

        @if ($videoId)
            <iframe width="560" height="315"
                src="https://www.youtube.com/embed/{{ $videoId }}"
                frameborder="0"
                allowfullscreen>
            </iframe>
        @else
            <a href="{{ $filme->link_trailer }}" target="_blank">Assistir trailer</a>
        @endif
    @endif
@endsection