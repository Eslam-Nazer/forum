<?php

namespace Modules\Forum\Domain\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;

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
        'created_at'
    ];

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }

    public static function feed(User $user, int $take = 50): Collection
    {
        return static::query()
            ->where('user_id', $user->id)
            ->latest()
            ->with('subject')
            ->take($take)
            ->get()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d');
            });
    }
}
