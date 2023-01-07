<?php

namespace Tests\Feature\AUTH;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('api/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {

        Sanctum::actingAs(
            $user  =  User::factory()->create([
                'email' => 'thor@marvel.com',
                'password' => bcrypt($password = 'eusouinevitavel')
            ]),
            ['*']
        );

        $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);


        $this->assertAuthenticated();
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('api/login', [
            'email' => $user->email,
            'password' => 'marvel',
        ]);

        $this->assertGuest();
    }

    public function test_remember_me_functionality()
    {
        Sanctum::actingAs(
            $user  =  User::factory()->create([
                'id' => random_int(1, 100),
                'password' => bcrypt($password = 'eusouinevitavel')
            ]),
            ['*']
        );

        $this->post('/api/login', [
            'email' => $user->email,
            'password' => $password,
            'remember' => 'on',
        ]);

        $this->assertAuthenticatedAs($user);
    }
}
