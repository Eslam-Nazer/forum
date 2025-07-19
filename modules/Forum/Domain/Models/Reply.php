<?php

namespace Modules\Forum\Domain\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Forum\Database\Factories\ReplyFactory;

class Reply extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
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
}
