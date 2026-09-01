@auth
    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit">Sair ({{ auth()->user()->name }})</button>
    </form>
@else
    <a href="{{ route('login') }}">Login</a>
@endauth