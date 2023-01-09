<?php

namespace Tests\Feature\AUTH;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_is_logged_out()
    {
        $user  =  User::factory()->create([
            'email' => 'thanos@marvel.com',
            'password' => bcrypt('eusouinevitavel')
        ]);

        $token = Str::random(60);
        $headers = [
            'Authorization' => 'Bearer' . $token,
            'Accept' => 'application/json'
        ];

        $this->get('/api/products', [], $headers)->assertStatus(200);
        $this->post('/api/logout', [], $headers)->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->apiToken);
    }
}
