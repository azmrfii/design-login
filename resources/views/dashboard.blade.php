@guest
    @if (Route::has('login'))
        <a class="nav-link" href="{{ route('login') }}">login</a>
    @endif
@else
{{ Auth::user()->username }} : {{ Auth::user()->level }}
<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
 {{ __('Logout') }}
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
 @csrf
</form>
@endguest