<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_has_a_profile(): void
    {
        $this->signIn($user = User::factory()->create());
        $this->get("/settings/profile")
            ->assertStatus(200)
            ->assertSee($user->name)
            ->assertSee($user->email);
    }

    public function test_profiles_display_all_threads_created_by_the_associated_user(): void
    {
        $this->withoutVite();
        $this->signIn($user = User::factory()->create());
        $thread = create(Thread::class, ['user_id' => $user->id]);

        $this->get("/settings/threads")
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page) => $page->component('settings/Thread')
                ->has('threads', 1)
                ->where('threads.0.title', $thread->title)
                ->where('threads.0.body', $thread->body)
            );
    }
}
