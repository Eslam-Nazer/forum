<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;

/**
 * @property HasOne $lastReply
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return HasMany
     */
    public function threads(): HasMany
    {
        return $this->hasMany(Thread::class, 'user_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class, 'user_id');
    }

    /**
     * @param Model $thread
     * @return string
     */
    public function visitedThreadCacheKey(Model $thread): string
    {
        return sprintf("users.%s.visits.%s", $this->id, $thread->id);
    }

    /**
     * @param Model $thread
     * @return void
     */
    public function read(Model $thread): void
    {
        cache()->forever($this->visitedThreadCacheKey($thread), now());
    }

    /**
     * @return HasOne
     */
    public function lastReply(): HasOne
    {
        return $this->hasOne(Reply::class)->latest();
    }
}
