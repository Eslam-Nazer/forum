<?php

namespace Modules\Forum\Domain\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Forum\Domain\Models\Favorite as FavoriteModel;

trait Favorite
{
    public function favorites(): MorphMany
    {
        return $this->morphMany(FavoriteModel::class, 'favorite');
    }

    public function favorite(string $userId): Model|null
    {
        $attributes = ['user_id' => $userId];
        if (!$this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
        return null;
    }

    public function isFavorite(): Attribute
    {
        return Attribute::make(get: fn() => $this->favorites->isNotEmpty());
    }
}
