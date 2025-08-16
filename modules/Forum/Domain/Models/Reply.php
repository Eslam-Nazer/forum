<?php

namespace Modules\Forum\Domain\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Forum\Database\Factories\ReplyFactory;

class Reply extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'replies';

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
     * @return MorphMany
     */
    public function favorites(): MorphMany
    {
        return $this->morphMany(Favorite::class, 'favorite');
    }

    /**
     * @param string $userId
     * @return Model|null
     */
    public function favorite(string $userId): Model|null
    {
        $attributes = ['user_id' => $userId];
        if (!$this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
        return null;
    }

    /**
     * @return bool
     */
    public function isFavorite(): bool
    {
        return (bool)$this->favorites
            ->where('user_id', '=', auth()->id())
            ->count();
    }
}
