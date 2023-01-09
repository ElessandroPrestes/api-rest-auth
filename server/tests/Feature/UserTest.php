<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_listed_successfully()
    {
        Sanctum::actingAs(
            $user  =  User::factory()->create([
                "id" => "1",
                "name" => "Admin",
                "email" => "admin@marvel.com",
                "password" => "admin@123",
                "profile" => "Adminstrator"
            ]),
            ['*']
        );

        $user1 =  User::factory()->create([
            "id" => "2",
            "name" => "Odin Borson",
            "email" => "odin@marvel.com",
            "password" => "odin@123",
            "profile" => "Adminstrator"
        ]);

        $user2 =  User::factory()->create([
            "id" => "3",
            "name" => "Freyja Freyrdottir",
            "email" => "freyja@marvel.com",
            "password" => "freyja@123",
            "profile" => "User"
        ]);

        $this->getJson('/api/users')
            ->assertStatus(200)
            ->assertExactJson([
                "users" => [
                    [
                        "id" => $user->id,
                        "name" => $user->name,
                        "email" => $user->email,
                        "profile" => $user->profile
                    ],
                    [
                        "id" => $user1->id,
                        "name" => $user1->name,
                        "email" => $user1->email,
                        "profile" => $user1->profile
                    ],
                    [
                        "id" => $user2->id,
                        "name" => $user2->name,
                        "email" => $user2->email,
                        "profile" => $user2->profile
                    ]
                ],
                'message' => 'Retrieved Successfully'
            ]);
    }
}
