@extends('filme._base')

@section('conteudo')
<p>Apagar filme</p>
<p>Tem certeza que deseja apagar o filme?</p>
<p style="border:1px solid green">{{ $filme->titulo }}</p>

<form method="post" action="{{ route('filme.delete', $filme->id) }}">
    @csrf
    @method('delete')
    <input type="submit" value="Sim, apagar!">
</form>

<a href="{{ route('filme.index') }}">Não, voltar</a>
@endsection