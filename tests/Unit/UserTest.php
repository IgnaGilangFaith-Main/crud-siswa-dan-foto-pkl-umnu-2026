<?php

namespace Tests\Unit;


use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    public function test_fillable_fields()
    {
        $user = new User([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'secret',
        ]);

        $this->assertEquals('Admin', $user->name);
        $this->assertEquals('admin@example.com', $user->email);
        $this->assertTrue(Hash::check('secret', $user->password));
    }
}
