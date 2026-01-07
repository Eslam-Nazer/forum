<?php

namespace Modules\Forum\Domain\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_path', 'confirmed', 'confirmation_token'
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
            'confirmed' => 'boolean',
        ];
    }

    /**
     * Handle avatar path to full path and return it
     *
     * @return Attribute
     */
    protected function avatarPath(): Attribute
    {
        return Attribute::get(fn($avatar_path) => asset('storage/' . $avatar_path));
    }

    /**
     * Relation between user and threads which own it
     *
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
     * Handle cache key which user visited threads
     *
     * @param Model $thread
     * @return string
     */
    public function visitedThreadCacheKey(Model $thread): string
    {
        return sprintf("users.%s.visits.%s", $this->id, $thread->id);
    }

    /**
     * Use to set cache how threads user visited
     *
     * @param Model $thread
     * @return void
     */
    public function read(Model $thread): void
    {
        cache()->forever($this?->visitedThreadCacheKey($thread), now());
    }

    /**
     * Relation has one between user and reply model to get only latest one
     *
     * @return HasOne
     */
    public function lastReply(): HasOne
    {
        return $this->hasOne(Reply::class)->latest();
    }

    /**
     * Activities which user has many for it
     *
     * @return HasMany
     */
    public function activities(): HasMany
    {
        return $this->HasMany(Activity::class, 'user_id');
    }
}
