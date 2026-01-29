<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiswaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_route_returns_success()
    {
        $response = $this->get('/siswa');
        $response->assertStatus(302); // Redirect to login if not authenticated
    }

    public function test_store_validation()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/siswa/store', []);
        $response->assertSessionHasErrors(['nama', 'kelas', 'jurusan', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'foto']);
    }

    // Tambahkan pengujian lain sesuai kebutuhan, misal: update, delete, dll.
}
