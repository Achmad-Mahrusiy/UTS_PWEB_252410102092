@props(['gunung'])

<img {{ $attributes->merge(['class' => 'foto']) }} src="{{ asset('images/' . $gunung['foto']) }}" alt="Foto Gunung {{ $gunung['nama'] }}" width="520" height="520">
