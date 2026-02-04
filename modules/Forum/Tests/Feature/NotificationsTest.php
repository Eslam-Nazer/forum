<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Support\Facades\Bus;
use Modules\Forum\Domain\Models\Reply;
use Tests\TestCase;
use App\Models\User;
use Database\Factories\DatabaseNotificationFactory;
use Modules\Forum\Domain\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

class NotificationsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        $this->signIn();
    }

    public function test_a_notification_is_prepared_when_a_subscribed_thread_receives_a_new_reply_that_is_not_by_the_current_user(): void
    {
        Bus::fake();
        $user = Auth::user();


        $thread = create(Thread::class);
        $thread->subscribe();

        $this->assertCount(0, $user->notifications);

        $thread->addReply([
            'user_id' => $user->id,
            'body' => 'Some reply body',
        ]);

        $this->assertCount(0, $user->fresh()->notifications);

        $thread->addReply([
            'user_id' => create(User::class)->id,
            'body' => 'Some reply body',
        ]);

        $this->assertCount(1, $user->fresh()->notifications);
    }

    public function test_a_user_can_fetch_their_unread_notifications(): void
    {
        DatabaseNotificationFactory::new()->create([
            'type' => '\App\Notifications\ThreadWasUpdated',
        ]);

        $this->assertCount(
            1,
            $this->getJson("settings/profiles/notifications")->json()
        );
    }

    public function test_a_user_can_mark_a_notification_as_read(): void
    {

        DatabaseNotificationFactory::new()->create([
            'type' => '\App\Notifications\ThreadWasUpdated',
        ]);
        tap(Auth::user(), function (User $user) {
            $this->assertCount(1, $user->unreadNotifications);

            $this->delete("settings/profiles/notifications/{$user->unreadNotifications->first()->id}");

            $this->assertCount(0, $user->fresh()->unreadNotifications);
        });
    }

    public function test_a_user_can_mention_another_user_and_send_notification()
    {
        Bus::fake();
        $thread = create(Thread::class);
        $mUser = create(User::class, ['name' => 'testing user']);
        $mUser2 = create(User::class, ['name' => 'testing user 2']);

        tap(auth()->user(), function ($user) use ($thread, $mUser, $mUser2) {

            $this->post(route('replies.store', ['threadSlug' => $thread->slug,]), [
                'body' => "<a href='{$mUser->slug}/profile'>@" . $mUser->name . '</a>'.
                    ' ' . "<a href='{$mUser2->slug}/profile'>@" . $mUser2->name . '</a>'
            ])
            ->assertStatus(302);

            $this->assertCount(1, $mUser->fresh()->notifications);
        });
    }
}
