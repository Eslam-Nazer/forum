<?php

namespace Modules\Forum\Domain\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    protected $appends = ['is_favorite', 'path_to', 'is_best', 'can'];

    /**
     * @var string[]
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
     * Return path function as attribute
     *
     * @return Attribute
     */
    public function pathTo(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->path()
        );
    }

    /**
     * Prepare body attribute to store mentions users as anchor tag
     *
     * @return Attribute
     */
    protected function body(): Attribute
    {
        return Attribute::make(
            set: static function ($body) {
                return preg_replace('/@([\w\-]+)/', '<a class="text-blue-400" href="/$1/profile">$0</a>', $body);
            }
        );
    }

    /**
     * Check this reply is the thread owner make it the best or not
     *
     * @return Attribute
     */
    public function isBest(): Attribute
    {
        return Attribute::get(fn() => $this->thread->best_reply_id === $this->id);
    }

    /**
     * Actions that the owner can take in this reply
     *
     * @returns Attribute
     */
    protected function can(): Attribute
    {
        return Attribute::get(fn() => auth()->check() ? [
            'update' => auth()->user()->can('update', $this),
            'delete' => auth()->user()->can('delete', $this),
        ] : false);
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
        return $this->thread()
                ->without('replies')
                ->first()
                ?->path() . "#reply-" . $this->id;
    }

    /**
     * Check a reply published now or after minute
     *
     * @return bool
     */
    public function wasJustPublished(): bool
    {
        return $this->created_at->greaterThan(now()->subSeconds(15));
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
}
