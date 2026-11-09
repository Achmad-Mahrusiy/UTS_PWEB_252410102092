@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <div class="awal">
        <div class="hero">
            <div>
                @include('partials.judul', [
                    'judul' => 'Masuk ke',
                    'aksen' => 'Trailmate',
                    'akhir' => 'dan Mulai Mendaki',
                    'deskripsi' => 'Rencanakan pendakian gunung Jawa Timur.',
                ])

                <form class="kartu" action="{{ route('dashboard') }}" method="GET">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" maxlength="30" autocomplete="username" required autofocus>
                    <button type="submit">Masuk ke dashboard</button>
                </form>
            </div>

            <x-ilustrasi :gunung="$sampul" fetchpriority="high" />
        </div>

        <div class="panorama" style="--foto: url('{{ asset('images/' . $sampul['foto']) }}')"></div>
    </div>
@endsection
