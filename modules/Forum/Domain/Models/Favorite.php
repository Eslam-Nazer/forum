<?php

namespace Modules\Forum\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'favorite_id',
        'favorite_type',
    ];
}
