<?php

namespace Modules\Forum\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Forum\Database\Factories\ThreadSubscriptionFactory;

class ThreadSubscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'thread_id',
    ];

    // protected static function newFactory(): ThreadSubscriptionFactory
    // {
    //     // return ThreadSubscriptionFactory::new();
    // }
}
