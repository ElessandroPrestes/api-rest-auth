<?php

namespace Tests\Feature\AUTH;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/api/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $this->post('/api/register', [
            'name' => 'Thanos',
            'email' => 'thanos@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
    }
}
