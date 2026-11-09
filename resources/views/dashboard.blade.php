@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="awal">
        <div class="hero">
            <div>
                @include('partials.judul', [
                    'judul' => 'Halo,',
                    'aksen' => $username,
                    'akhir' => 'Siap Mendaki Gunung Jawa Timur?',
                    'deskripsi' => 'Pilih gunung tujuanmu, lalu cek basecamp, durasi, dan tingkat kesulitannya sebelum berangkat.',
                ])

                <div class="aksi">
                    <a class="tombol" href="{{ route('pengelolaan', ['username' => $username]) }}">Lihat Daftar Gunung</a>
                    <a class="tautan" href="{{ route('profile', ['username' => $username]) }}">Profil Saya</a>
                </div>
            </div>

            <x-ilustrasi :gunung="$sampul" fetchpriority="high" />
        </div>

        <div class="panorama" style="--foto: url('{{ asset('images/' . $sampul['foto']) }}')"></div>
    </div>

    <section class="isi">
        <p class="label">Wisata alam</p>
        <h2>Siap Untuk<br>Mendaki?</h2>

        <div class="daftar">
            @foreach ($gunung as $item)
                <a class="gunung" href="{{ route('pengelolaan', ['username' => $username]) }}#{{ strtolower($item['nama']) }}">
                    <img class="gambar" src="{{ asset('images/' . $item['foto']) }}" alt="Foto Gunung {{ $item['nama'] }}" width="400" height="220" loading="lazy">

                    <div class="teks">
                        <div>
                            <p>Jalur pendakian</p>
                            <h3>{{ $item['nama'] }}</h3>
                        </div>
                        <svg class="panah" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 19 19 5M8 5h11v11"/></svg>
                    </div>
                </a>
            @endforeach
        </div>

        <a class="tombol-garis" href="{{ route('pengelolaan', ['username' => $username]) }}">Lihat Semua Gunung</a>
    </section>

    <section class="bagian bagian-balik">
        <x-ilustrasi :gunung="$singkat->first()" loading="lazy" />

        <div>
            <p class="label">Pendakian singkat</p>
            <h2>Cukup Satu Hari</h2>
            <p>Tidak punya banyak waktu? {{ $singkat->pluck('nama')->join(' dan ') }} bisa didaki dalam satu hari.</p>
            <a class="tombol-garis" href="{{ route('pengelolaan', ['username' => $username]) }}">Lihat Semua Jalur</a>
        </div>
    </section>

    <section class="kutipan">
        <p class="label">Tips pendakian</p>
        <p class="tip">{{ $tip }}</p>
    </section>

    <section class="bagian">
        <div>
            <p class="label">Puncak tertinggi</p>
            <h2>Gunung {{ $tertinggi['nama'] }}</h2>
            <p>Dari {{ $jumlah }} gunung di daftar Trailmate, {{ $tertinggi['nama'] }} adalah yang paling tinggi. Siapkan fisik dan waktu yang cukup sebelum memilih jalur ini.</p>
            <a class="tombol-garis" href="{{ route('pengelolaan', ['username' => $username]) }}#{{ strtolower($tertinggi['nama']) }}">Bandingkan Jalur</a>
        </div>

        <x-ilustrasi :gunung="$tertinggi" loading="lazy" />

        <ul class="fakta">
            @foreach ($fakta as $item)
                <li>
                    <img src="{{ asset('images/ikon/' . $item['ikon'] . '.svg') }}" alt="" width="28" height="28">
                    <h3>{{ $item['judul'] }}</h3>
                    <p>{{ $item['isi'] }}</p>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
