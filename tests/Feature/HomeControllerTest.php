<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Selamat Datang');
    }

    public function test_pendaftaran_page_accessible()
    {
        $response = $this->get('/pendaftaran');
        $response->assertStatus(200);
        $response->assertSee('Form Pendaftaran');
    }

    public function test_dashboard_requires_authentication()
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }
}
