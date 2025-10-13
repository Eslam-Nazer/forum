<?php

namespace Modules\Forum\Domain\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Forum\Database\Factories\ReplyFactory;
use Modules\Forum\Domain\Traits\Favoritable;
use Modules\Forum\Domain\Traits\RecordsActivity;
use Modules\Forum\Infrastructure\Policies\Reply\ReplyPolicy;

#[UsePolicy(ReplyPolicy::class)]
class Reply extends Model
{
    use HasFactory, RecordsActivity, Favoritable;

    /**
     * @var string
     */
    protected $table = 'replies';

    protected $appends = ['is_favorite'];

    /**
     * @var list<string>
     */
    protected $with = ['owner', 'favorites'];

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'thread_id',
        'body',
        'type',
    ];

    protected static function booted(): void
    {
        static::created(static function (self $reply): void {
            $reply->thread->increment('replies_count');
        });

        static::deleted(static function (self $reply): void {
            $reply->thread->decrement('replies_count');
        });
    }

    /**
     * @return ReplyFactory
     */
    protected static function newFactory(): ReplyFactory
    {
        return ReplyFactory::new();
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Summary of thread
     * @return BelongsTo<Thread, Reply>
     */
    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }
}
