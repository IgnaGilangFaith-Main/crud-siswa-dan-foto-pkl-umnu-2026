<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_akun_page_requires_authentication()
    {
        $response = $this->get('/akun');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_akun_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/akun');
        $response->assertStatus(200);
        $response->assertSee($user->name);
    }
}
