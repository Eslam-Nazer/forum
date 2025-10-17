<?php

namespace Modules\Forum\Domain\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notification;

// use Modules\Forum\Database\Factories\ThreadSubscriptionFactory;

class ThreadSubscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'thread_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Summary of notify
     * @param \Illuminate\Notifications\Notification $notification
     * @return void
     */
    public function notify(Notification $notification): void
    {
        $this->user->notify($notification);
    }
}
