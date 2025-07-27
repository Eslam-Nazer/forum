<?php

namespace Modules\Forum\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Forum\Database\Factories\ChannelFactory;

class Channel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * @return ChannelFactory
     */
    protected static function newFactory(): ChannelFactory
    {
         return ChannelFactory::new();
    }

    /**
     * @return HasMany
     */
    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class);
    }
}
