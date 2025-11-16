<?php

namespace Modules\Forum\Domain\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Forum\Database\Factories\ReplyFactory;
use Modules\Forum\Domain\Traits\Favoritable;
use Modules\Forum\Domain\Traits\RecordsActivity;
use Modules\Forum\Infrastructure\Policies\Reply\ReplyPolicy;

/**
 * @property string|int $user_id
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Thread $thread
 */
#[UsePolicy(ReplyPolicy::class)]
class Reply extends Model
{
    use HasFactory, RecordsActivity, Favoritable;

    /**
     * @var string
     */
    protected $table = 'replies';

    /**
     * @var string[]
     */
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
     * Reply model factory
     *
     * @return ReplyFactory
     */
    protected static function newFactory(): ReplyFactory
    {
        return ReplyFactory::new();
    }

    /**
     * Users relation with reply (the owners)
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Thread relation with reply model
     *
     * @return BelongsTo<Thread, Reply>
     */
    public function thread(): BelongsTo
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }

    /**
     * Return reply path
     *
     * @return string
     */
    public function path(): string
    {
        return $this->thread->path() . "#reply-" . $this->id;
    }

    /**
     * Check a reply published now or after minute
     *
     * @return bool
     */
    public function wasJustPublished(): bool
    {
        return $this->created_at->greaterThan(now()->subMinute());
    }

    /**
     * Get mentioned users name
     *
     * @return array
     */
    public function mentionedUsers(): array
    {
        preg_match_all('/\@([\w\-]+)/', $this->body, $matches);

        return $matches[1];
    }

    protected function body(): Attribute
    {
        return Attribute::make(
            set: static function ($body) {
                return preg_replace('/@([\w\-]+)/', '<Button class="text-blue-400" href="/profile/$1">$0</Button>', $body);
            }
        );
    }
}
