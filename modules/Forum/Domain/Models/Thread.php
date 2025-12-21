<?php

namespace Modules\Forum\Domain\Models;

use App\Events\ThreadHasNewReply;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Forum\Domain\Traits\Favoritable;
use Modules\Forum\Domain\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Forum\Database\Factories\ThreadFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Forum\Infrastructure\Cache\Visits;
use Modules\Forum\Infrastructure\Policies\Thread\ThreadPolicy;

/**
 * @property Carbon|null $created_at
 * @property Attribute|null $is_subscribed_to
 * @property string|null $id
 * @property string|null $title
 * @property string|null $body
 * @property Channel|null $channel
 * @property Collection<Reply>|null $replies
 * @property User|null $creator
 * @property bool|null $is_favorite
 */
#[UsePolicy(ThreadPolicy::class)]
class Thread extends Model
{
    use HasFactory, RecordsActivity, Favoritable;

    protected static function booted(): void
    {
        static::addGlobalScope('repliesCount', static function ($query) {
            $query->withCount(['favorites']);
        });

        static::deleting(static function (self $thread): void {
            $thread->replies->each(function (Reply $reply) {
                $reply->delete();
            });
        });

        static::created(static function (self $thread): void {
            $thread->update(['slug' => Str::slug($thread->title)]);
        });
    }

    /**
     * @var string
     */
    protected $table = 'threads';

    /**
     * @var string[]
     */
    protected $appends = ['is_favorite', 'is_subscribed_to', 'has_updates_for', 'path_to', 'can'];

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'channel_id',
        'best_reply_id',
        'title',
        'slug',
        'body',
        'type',
        'replies_count',
        'best_reply_id'
    ];

    /**
     * @return ThreadFactory
     */
    protected static function newFactory(): ThreadFactory
    {
        return ThreadFactory::new();
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
     * Summary of isSubscribedTo
     * @param string|int|null $userid
     * @return Attribute
     */
    public function isSubscribedTo(string|int|null $userid = null): Attribute
    {
        return Attribute::make(
            get: fn() => $this->subscriptions()
                ->where('user_id', '=', $userid ?: auth()->guard()->id())
                ->exists()
        );
    }

    /**
     * Show cont of visits in this thread
     * @return Attribute
     */
    public function visitsCount(): Attribute
    {
        return Attribute::get(fn(): int => $this->visits()->count());
    }

    /**
     * Prepare threads slug and with consideration it is unique
     * @return Attribute
     */
    protected function slug(): Attribute
    {
        return Attribute::make(set: function ($value) {
            $slug = Str::slug($value);

            if (static::query()->whereSlug($slug)->exists()) {
                $slug = "{$slug}-" . $this->id;
            }
            return $slug;
        });
    }

    /**
     * know if user authorize to make action for this thread
     * @return Attribute
     */
    protected function can(): Attribute
    {
        return Attribute::get(fn() => auth()->check() ? [
            'update' => auth()->user()->can('update', $this),
            'delete' => auth()->user()->can('delete', $this),
        ] : false);
    }

    /**
     * If user visit this thread
     * @return Attribute
     */
    public function hasUpdatesFor(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->updated_at > cache(auth()->user()->visitedThreadCacheKey($this))
        );
    }

    /**
     * Relation between thread and his replies
     * @return HasMany<Reply>
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class)
            ->withCount('favorites')
            ->with('owner');
    }

    /**
     * Relation between thread and user who create this thread
     * @return BelongsTo<User, self>
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * Relation between thread and channel
     * @return BelongsTo<Channel, self>
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Summary of subscription
     * @return HasMany<ThreadSubscription>
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    /**
     * Handle creating reply to thread
     * @param array $replyBody
     * @return Reply
     */
    public function addReply(array $replyBody): Reply
    {
        $reply = $this->replies()->create($replyBody);

        event(new ThreadHasNewReply($reply));

        return $reply;
    }

    /**
     * Prepare path to thread
     * @return string
     */
    public function path(): string
    {
        if (!$this->slug) {
            return '';
        }
        return "/threads/" . $this->channel->slug . "/" . $this->slug;
    }

    /**
     * Summary of subscribe
     * @param string|int|null $userid
     * @return void
     */
    public function subscribe(string|int|null $userid = null): void
    {
        $userid = $userid ?: auth()->guard()->id();
        $query = $this->subscriptions();
        if (!$query->where('user_id', $userid)->exists()) {
            $query->create(['user_id' => $userid]);
        }
    }

    /**
     * Summary of unsubscribe
     * @param string|int|null $userid
     * @return bool
     */
    public function unsubscribe(string|int|null $userid = null): bool
    {
        $subscription = $this->subscriptions()
            ->where('user_id', '=', $userid ?: auth()->guard()->id())
            ->first();

        if ($subscription) {
            return $subscription->delete();
        }

        abort(404);
    }

    /**
     * Handle visits class which handle redis cache
     * @return Visits
     */
    public function visits(): Visits
    {
        return new Visits($this);
    }
}
