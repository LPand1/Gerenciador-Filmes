@extends('filme._base')

@section('conteudo')
    <p>Bem-vindo ao Gerenciador de Filmes!</p>

    @auth
        @if (auth()->user()->is_admin)
            <p><a href="{{ route('filme.create') }}">Adicionar filme</a></p>
            <p><a href="{{ route('filme.trash') }}">🚮 Lixeira</a></p>
        @endif
    @endauth

    <hr>

    @if (session('mensagem'))
        <div>👍 {{ session('mensagem') }}</div>
    @endif

    {{-- Filtro --}}
    <form method="get" action="{{ route('filme.index') }}">
        <label for="ano">Ano:</label>
        <select name="ano" id="ano">
            <option value="">Todos</option>
            @foreach ($anos as $ano)
                <option value="{{ $ano }}" @selected(request('ano') == $ano)>{{ $ano }}</option>
            @endforeach
        </select>

        <label for="categoria_id">Categoria:</label>
        <select name="categoria_id" id="categoria_id">
            <option value="">Todas</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected(request('categoria_id') == $categoria->id)>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>

        <button type="submit">Filtrar</button>
        <a href="{{ route('filme.index') }}">Limpar filtro</a>
    </form>

    <hr>

    {{-- Galeria --}}
    @forelse ($filmes as $filme)
        <div style="border:1px solid; padding:2px; width:200px; display:inline-block; margin:5px;">
            <a href="{{ route('filme.show', $filme->id) }}" style="text-decoration:none; color:inherit;">
                <strong>{{ $filme->titulo }}</strong>
                <br><br>
                @if ($filme->imagem_capa)
                    <img src="{{ asset('storage/'.$filme->imagem_capa) }}" width="200">
                    <br><br>
                @endif
                Ano: {{ $filme->ano }}
                <br>
                Categoria: {{ $filme->categoria->nome ?? '—' }}
            </a>

            @auth
                @if (auth()->user()->is_admin)
                    <br>
                    <a href="{{ route('filme.edit', $filme->id) }}">📝</a>
                    <a href="{{ route('filme.delete', $filme->id) }}">❌</a>
                @endif
            @endauth
        </div>
    @empty
        <p>Nenhum filme encontrado.</p>
    @endforelse
@endsection