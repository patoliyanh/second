<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

// Use Pest's way to apply traits
uses(TestCase::class);

it('creates a post with title, image, and description', function () {
    // Fake the public storage disk
    Storage::fake('public');

    $file = UploadedFile::fake()->image('post.jpg');

    $data = [
        'title' => 'My First Post',
        'description' => 'This is a test post.',
        'image' => $file,
    ];

    // Call your API endpoint
    $response = $this->withCookie('X-USER-SESSION','test-session-value')->postJson('/api/posts', $data);

    $response->assertStatus(201);
    $response->assertJsonFragment([

            'title' => 'My First Post',
            'description' => 'This is a test post.',
    ]);

    $imagePath = $response->json('post.image');

    // Assert the file exists in the fake storage
    Storage::disk('public')->assertExists($imagePath);
});
it('throw validation exception when image is missing',function(){
  $this->withoutExceptionHandling();
  expect(fn()=>$this->postJson('/api/posts',[
    'title'=>'bad post',
    'description'=>'missing image'
  ]))->toThrow(ValidationException::class);
});
