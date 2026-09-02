@extends('filme/_base')

@section('conteudo')
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ isset($filme) ? route('filme.edit', $filme->id : route ('filme.create')) }}" enctype="multipart/form-data">
        @csrf
        @if (isset($filme))
            @method('PUT')
        @endif

        Título:
        <br>
        <input type="text" name="titulo" value="{{ old('titulo', $filme->titulo ?? '') }}">
        <br>
        <br>

        Sinopse:
        <br>
        <textarea name="sinopse">{{ old('sinopse', $filme->sinopse ?? '') }}</textarea>
        <br>
        <br>

        Ano:
        <br>
        <input type="number" name="ano" value="{{ old('ano', $filme->ano ?? '') }}">
        <br>
        <br>

        Categoria:
        <br>
        <select name="categoria_id">
            <option value="">Selecione...</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected(old('categoria_id', $filme->categoria_id ?? '') == $categoria->id)>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
        <br>
        <br>

        Imagem da capa: <input type="file" name="imagem_capa">
        <br>
        <br>

        Link do trailer (YouTube):
        <br>
        <input type="text" name="link_trailer" value="{{ old('link_trailer', $filme->link_trailer ?? '') }}">
        <br>
        <br>

        <input type="submit" value="Gravar">
    </form>

    <a href="{{ route('filme.index') }}">Cancelar</a>
@endsection