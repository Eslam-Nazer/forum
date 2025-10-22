<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;

class ThreadWasUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected Thread $thread,
        protected Reply  $reply,
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->reply->owner->name . ' replied to ' . $this->thread->title,
            'link' => $this->reply->path(),
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        $notification = $notifiable->notifications()->find($this->id);
        return new BroadcastMessage([
            'created_at' => $notification->created_at,
            'data' => [
                'message' => $this->reply->owner->name . ' replied to ' . $this->thread->title,
                'link' => $this->reply->path(),
            ],
            'id' => $notification->id,
            'notifiable_id' => $notification->notifiable_id,
            'notifiable_type' => $notification->notifiable_type,
            'read_at' => $notification->read_at,
            'type' => $notification->type,
            'updated_at' => $notification->updated_at,
        ]);
    }
}
