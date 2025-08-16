<?php

namespace Modules\Forum\Domain\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Forum\Database\Factories\ThreadFactory;

class Thread extends Model
{
    use HasFactory;

    /**
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::addGlobalScope('repliesCount', static function ($query) {
            $query->withCount('replies');
        });
    }

    /**
     * @var string
     */
    protected $table = 'threads';

    /**
     * @var list<string>
     */
    protected $with = ['creator', 'channel'];

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'channel_id',
        'title',
        'body',
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

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }
}
