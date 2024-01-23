<?php

namespace Tests\Unit\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic unit test example.
     */
    public function testGetUsers(): void
    {
        User::factory()->count(10)->create();

        $response = $this->getJson('/api/users');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    '*' => [
                        'id',
                        'name',
                        'city',
                        'images_count',
                        'created_at',
                    ],
                ],
            );
    }

    public function testGetUsersOrder(): void
    {
        User::factory()->count(10)->create();
        
        $response = $this->getJson('/api/users');

        $users = $response->json();

        $sorted = collect($users)->sortByDesc('images_count')->values()->all();

        $this->assertEquals($users, $sorted, "The users are not ordered by 'images_count' in descending order.");
    }

    public function testGetUsersEmpty(): void
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
        $response->assertJson([]);
    }


    public function testCreateUserSuccessfully(): void
    {
        $userData = [
            'name' => 'John Doe',
            'city' => 'New York',
            'image' => 'image.jpg',
        ];

        $response = $this->postJson('/api/users', $userData);

        $response->assertStatus(200)
                ->assertJsonStructure([
                    'id',
                    'name',
                    'city',
                    'images' => [
                        '*' => [
                            'id',
                            'image',
                        ],
                    ],
                ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'city' => 'New York',
        ]);
        
        $this->assertDatabaseHas('user_images', [
            'image' => 'image.jpg',
        ]);
    }
}
