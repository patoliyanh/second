<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;


class UserHttpTest extends TestCase
{


    /** @test */

    public function test_creates_a_user_with_valid_data()
    {

        $data = [
            'name' => 'john doe',
            'email' => 'john2@gmail.com',
            'password' =>'secret123',
        ];
        $response = $this->postJson('api/register', $data);
        $response->assertStatus(201);

        $response->assertJson([
            'message' => 'User registered successfully',
            'user' => [
                'name' => 'john doe',
                'email' => 'john2@gmail.com',
            ],
        ]);

        // Optionally assert that a token exists
        $response->assertJsonStructure([
            'message',
            'token',
            'user' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ]
        ]);
    }

    /** @test */
    public function test_fails_if_required_fields_are_missing()
    {
        $response = $this->postJson('/api/register', []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    /** @test */
    // public function test_fails_if_email_is_not_unique()
    // {
    //     User::factory()->create(['email' => 'duplicate@gmail.com']);
    //     $response = $this->postJson('/api/register', [
    //         'name' => 'Jane Doe',
    //         'email' => 'duplicate@gmail.com',
    //         'password' => 'password123',
    //     ]);
    //     $response->assertStatus(422);
    //     $response->assertJsonValidationErrors(['email']);
    // }
}
