<?php

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @param $class
 * @param array $attributes
 * @param int|null $count
 * @return Model|Authenticatable;
 */
function create($class, array $attributes = [], int|null $count = null): Model|Authenticatable
{
    return $class::factory($count)->create($attributes);
}

/**
 * @param $class
 * @param array $attributes
 * @param int|null $count
 * @return Model
 */
function make($class, array $attributes = [], int|null $count = null): Model|Authenticatable
{
    return $class::factory($count)->make($attributes);
}
