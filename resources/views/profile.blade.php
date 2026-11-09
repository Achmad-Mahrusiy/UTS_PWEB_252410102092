@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="hero hero-balik">
        <x-ilustrasi :gunung="$sampul" fetchpriority="high" />

        <div>
            @include('partials.judul', [
                'label' => 'Akun',
                'judul' => 'Profil',
                'aksen' => 'Pendaki',
                'deskripsi' => 'Data akun dan rencana pendakianmu.',
            ])

            <div class="profil">
                <div class="inisial" aria-hidden="true">{{ mb_strtoupper(mb_substr($username, 0, 1)) }}</div>
                <div class="nama-profil">
                    <p>Username</p>
                    <p class="angka">{{ $username }}</p>
                </div>
                <ul class="rincian">
                    <li><span>Gunung di daftar</span> <strong>{{ $jumlah }}</strong></li>
                    <li><span>Perlu bermalam</span> <strong>{{ $bermalam }}</strong></li>
                </ul>
            </div>

            <a class="tombol-garis" href="{{ route('pengelolaan', ['username' => $username]) }}">Lihat Daftar Gunung</a>
        </div>
    </div>
@endsection
