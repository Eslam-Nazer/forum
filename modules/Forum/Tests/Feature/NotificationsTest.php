<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Support\Facades\Bus;
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
}
