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
     * @var string
     */
    protected $table = 'threads';
    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
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
         return '/threads/' . $this->id;
     }

    /**
     * @return HasMany
     */
     public function replies(): HasMany
     {
         return $this->hasMany(Reply::class);
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
}
