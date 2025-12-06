<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AvatarTest extends TestCase
{
    use DatabaseMigrations;

    public function test_only_members_can_add_avatar(): void
    {
        $this->withExceptionHandling();

        $this->postJson('api/users/1/avatar')
            ->assertStatus(401);
    }

    public function test_a_valid_avatar_must_be_provided(): void
    {
        $this->withExceptionHandling()->signIn();

        $this->postJson('api/users/' . auth()->id() . '/avatar', [
            'avatar' => 'not a valid avatar',
        ])->assertStatus(422);
    }

    public function test_a_user_may_add_an_avatar_to_their_profile(): void
    {
        $this->signIn();

        Storage::fake('public');

        $this->postJson('api/users/' . auth()->id() . '/avatar', [
           'avatar' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $this->assertEquals(asset('storage/avatars/' . $file->hashName()), auth()->user()->avatar_path);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }
}
