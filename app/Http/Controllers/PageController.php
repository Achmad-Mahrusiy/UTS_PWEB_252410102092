<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login()
    {
        $sampul = collect($this->dataGunung())->firstWhere('nama', 'Bromo');

        return view('login', compact('sampul'));
    }

    public function dashboard(Request $request)
    {
        $username = $this->username($request);
        $gunung = $this->dataGunung();
        $jumlah = count($gunung);
        $tertinggi = collect($gunung)->sortByDesc('ketinggian')->first();
        $sampul = collect($gunung)->firstWhere('nama', 'Arjuno');
        $singkat = collect($gunung)->where('durasi', '1 hari');
        $fakta = [
            ['judul' => 'Basecamp', 'ikon' => 'lokasi', 'isi' => 'Pendakian dimulai dari ' . $tertinggi['basecamp'] . '.'],
            ['judul' => 'Ketinggian', 'ikon' => 'gunung', 'isi' => number_format($tertinggi['ketinggian'], 0, ',', '.') . ' mdpl, tertinggi di daftar Trailmate.'],
            ['judul' => 'Durasi', 'ikon' => 'waktu', 'isi' => 'Rencanakan sekitar ' . $tertinggi['durasi'] . '.'],
            ['judul' => 'Tingkat kesulitan', 'ikon' => 'tingkat', 'isi' => 'Jalur ini tergolong ' . strtolower($tertinggi['kesulitan']) . '.'],
        ];
        $tip = 'Sebelum berangkat, cek status jalur dan aturan terbaru di kanal resmi pengelola. Jalur gunung bisa ditutup sewaktu-waktu karena cuaca atau aktivitas vulkanik.';

        return view('dashboard', compact('username', 'jumlah', 'gunung', 'tertinggi', 'sampul', 'singkat', 'fakta', 'tip'));
    }

    public function pengelolaan(Request $request)
    {
        $username = $this->username($request);
        $gunung = $this->dataGunung();

        return view('pengelolaan', compact('username', 'gunung'));
    }

    public function profile(Request $request)
    {
        $username = $this->username($request);
        $gunung = $this->dataGunung();
        $jumlah = count($gunung);
        $bermalam = count(array_filter($gunung, fn ($item) => $item['durasi'] !== '1 hari'));
        $sampul = collect($gunung)->firstWhere('nama', 'Raung');

        return view('profile', compact('username', 'jumlah', 'bermalam', 'sampul'));
    }

    private function username(Request $request)
    {
        $username = $request->query('username');

        // ?username[]=x menghasilkan array, dan array tidak bisa dicetak di Blade
        return is_string($username) ? $username : 'Tamu';
    }

    private function dataGunung()
    {
        return [
            ['nama' => 'Semeru', 'ketinggian' => 3676, 'basecamp' => 'Ranu Pani', 'durasi' => '3 hari 2 malam', 'kesulitan' => 'Berat', 'foto' => 'semeru.png'],
            ['nama' => 'Arjuno', 'ketinggian' => 3339, 'basecamp' => 'Tretes', 'durasi' => '2 hari 1 malam', 'kesulitan' => 'Sedang', 'foto' => 'arjuno.png'],
            ['nama' => 'Raung', 'ketinggian' => 3332, 'basecamp' => 'Kalibaru', 'durasi' => '3 hari 2 malam', 'kesulitan' => 'Berat', 'foto' => 'raung.png'],
            ['nama' => 'Ijen', 'ketinggian' => 2799, 'basecamp' => 'Paltuding', 'durasi' => '1 hari', 'kesulitan' => 'Mudah', 'foto' => 'ijen.webp'],
            ['nama' => 'Bromo', 'ketinggian' => 2329, 'basecamp' => 'Cemoro Lawang', 'durasi' => '1 hari', 'kesulitan' => 'Mudah', 'foto' => 'bromo.webp'],
        ];
    }
}
