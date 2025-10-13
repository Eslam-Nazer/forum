<?php

namespace Modules\Forum\Domain\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Http;
use Modules\Forum\Database\Factories\ThreadFactory;
use Modules\Forum\Domain\Traits\Favoritable;
use Modules\Forum\Domain\Traits\RecordsActivity;
use Modules\Forum\Infrastructure\Policies\Thread\ThreadPolicy;

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
    }

    /**
     * @var string
     */
    protected $table = 'threads';

    /**
     * @var list<string>
     */
    protected $with = ['creator', 'channel', 'favorites', 'replies'];

    /**
     * @var array<string
     */
    protected $appends = ['is_favorite'];

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'channel_id',
        'title',
        'body',
        'type',
        'replies_count',
    ];

    /**
     * @return ThreadFactory
     */
    protected static function newFactory(): ThreadFactory
    {
        return ThreadFactory::new();
    }

    /**
     * @return string
     */
    public function path(): string
    {
        if (!$this->id) {
            return '';
        }
        return "/threads/" . $this->channel->slug . "/" . $this->id;
    }

    /**
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class)
            ->withCount('favorites')
            ->with('owner');
    }

    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    /**
     * @param array $reply
     * @return void
     */
    public function addReply(array $reply): void
    {
        $this->replies()->create($reply);
    }

    /**
     * @return BelongsTo<Channel, Thread>
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }
}
