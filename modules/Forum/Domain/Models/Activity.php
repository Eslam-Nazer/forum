<?php

namespace Modules\Forum\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Activity extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'subject_id',
        'subject_type',
        'type',
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }
}
