@props(['username' => null])

<header class="navbar">
    <a class="merek" href="{{ route('dashboard', ['username' => $username]) }}">Trail<span>mate</span></a>

    @if ($username)
        <nav>
            <a href="{{ route('dashboard', ['username' => $username]) }}" @if (request()->routeIs('dashboard')) aria-current="page" @endif>Dashboard</a>
            <a href="{{ route('profile', ['username' => $username]) }}" @if (request()->routeIs('profile')) aria-current="page" @endif>Profil</a>
            <a href="{{ route('pengelolaan', ['username' => $username]) }}" @if (request()->routeIs('pengelolaan')) aria-current="page" @endif>Pengelolaan</a>
        </nav>

        <a class="tombol-garis" href="{{ route('login') }}">Keluar</a>
    @endif
</header>
