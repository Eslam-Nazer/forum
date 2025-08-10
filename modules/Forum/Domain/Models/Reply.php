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
     * @return Model
     */
    public function favorite(): Model
    {
        return $this->favorites()
            ->create([
                'user_id' => auth()->id(),
                'favorite_id' => $this->id,
                'favorite_type' => get_class($this)
            ]);
    }
}
