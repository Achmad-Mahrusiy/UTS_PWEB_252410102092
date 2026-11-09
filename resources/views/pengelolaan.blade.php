@extends('layouts.app')

@section('title', 'Pengelolaan Gunung')

@section('content')
    <div class="isi">
        @include('partials.judul', [
            'label' => 'Jalur pendakian',
            'judul' => 'Pengelolaan',
            'aksen' => 'Gunung',
            'deskripsi' => 'Lima gunung Jawa Timur, urut dari yang tertinggi.',
        ])

        <div class="daftar">
            @foreach ($gunung as $item)
                <article class="gunung" id="{{ strtolower($item['nama']) }}">
                    <img class="gambar" src="{{ asset('images/' . $item['foto']) }}" alt="Foto Gunung {{ $item['nama'] }}" width="400" height="220" loading="lazy">

                    <div class="teks">
                        <div>
                            <p>Basecamp {{ $item['basecamp'] }}</p>
                            <h2>{{ $item['nama'] }}</h2>
                        </div>
                        <span class="tingkat tingkat-{{ strtolower($item['kesulitan']) }}">{{ $item['kesulitan'] }}</span>

                        <div class="meta">
                            <span>{{ $item['durasi'] }}</span>
                            <strong>{{ number_format($item['ketinggian'], 0, ',', '.') }} mdpl</strong>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
