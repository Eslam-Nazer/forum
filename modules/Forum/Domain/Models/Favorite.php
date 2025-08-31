<?php

namespace Modules\Forum\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Forum\Domain\Traits\RecordsActivity;

class Favorite extends Model
{
    use RecordsActivity;
    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'favorite_id',
        'favorite_type',
    ];

    public function favorite(): MorphTo
    {
        return $this->morphTo();
    }
}
