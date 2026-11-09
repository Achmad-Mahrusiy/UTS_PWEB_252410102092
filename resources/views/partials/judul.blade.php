<section class="judul">
    @isset($label)
        <p class="label">{{ $label }}</p>
    @endisset
    <h1>{{ $judul }} <span>{{ $aksen }}</span> {{ $akhir ?? '' }}</h1>
    <p class="deskripsi">{{ $deskripsi }}</p>
</section>
