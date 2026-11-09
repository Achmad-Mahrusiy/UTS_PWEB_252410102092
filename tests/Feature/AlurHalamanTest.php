<?php

namespace Tests\Feature;

use Tests\TestCase;

class AlurHalamanTest extends TestCase
{
    public function test_form_login_mengirim_username_ke_dashboard(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('action="'.route('dashboard').'"', false)
            ->assertSee('name="username"', false);
    }

    public function test_tulisan_trailmate_menuju_dashboard(): void
    {
        $this->get('/profile?username=pendaki01')
            ->assertSee('class="merek" href="'.route('dashboard', ['username' => 'pendaki01']).'"', false);
        $this->get('/')
            ->assertSee('class="merek" href="'.route('dashboard').'"', false);
    }

    public function test_username_tampil_di_dashboard_dan_profile(): void
    {
        $this->get('/dashboard?username=pendaki01')->assertOk()->assertSeeText('Halo, pendaki01');
        $this->get('/profile?username=pendaki01')->assertOk()->assertSee('pendaki01');
    }

    public function test_navbar_meneruskan_username_ke_semua_halaman(): void
    {
        $this->get('/pengelolaan?username=pendaki01')
            ->assertOk()
            ->assertSee(route('dashboard', ['username' => 'pendaki01']), false)
            ->assertSee(route('profile', ['username' => 'pendaki01']), false);
    }

    public function test_seluruh_data_gunung_dari_controller_ditampilkan(): void
    {
        $this->get('/pengelolaan?username=pendaki01')
            ->assertOk()
            ->assertSeeInOrder(['Semeru', 'Arjuno', 'Raung', 'Ijen', 'Bromo'])
            ->assertSee('3.676 mdpl');
    }

    public function test_dashboard_menampilkan_data_olahan_controller(): void
    {
        $this->get('/dashboard?username=pendaki01')
            ->assertOk()
            ->assertSeeText('Gunung Semeru')
            ->assertSeeText('Pendakian dimulai dari Ranu Pani.')
            ->assertSeeText('Ijen dan Bromo bisa didaki')
            ->assertSeeText('cek status jalur')
            ->assertSee(route('pengelolaan', ['username' => 'pendaki01']).'#semeru', false);

        $this->get('/pengelolaan?username=pendaki01')->assertSee('id="semeru"', false);
    }

    public function test_foto_tiap_gunung_tersedia(): void
    {
        $response = $this->get('/pengelolaan?username=pendaki01');

        foreach (['semeru.png', 'arjuno.png', 'raung.png', 'ijen.webp', 'bromo.webp'] as $foto) {
            $response->assertSee('images/'.$foto, false);
            $this->assertFileExists(public_path('images/'.$foto));
        }
    }

    public function test_username_tidak_valid_menjadi_tamu(): void
    {
        $this->get('/dashboard?username[]=x')->assertOk()->assertSeeText('Halo, Tamu');
        $this->get('/dashboard?username=')->assertOk()->assertSeeText('Halo, Tamu');
    }

    public function test_username_dicetak_aman(): void
    {
        $this->get('/profile?username=<script>')->assertOk()->assertDontSee('<script>', false);
    }
}
