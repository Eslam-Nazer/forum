<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

/**
 * @param $class
 * @param array $attributes
 * @param int|null $count
 * @return Model|Authenticatable|Collection;
 */
function create($class, array $attributes = [], int|null $count = null): Model|Authenticatable|Collection
{
    return $class::factory()->count($count)->create($attributes);
}

/**
 * @param $class
 * @param array $attributes
 * @param int|null $count
 * @return Model|Authenticatable|Collection
 */
function make($class, array $attributes = [], int|null $count = null): Model|Authenticatable|Collection
{
    return $class::factory()->count($count)->make($attributes);
}
