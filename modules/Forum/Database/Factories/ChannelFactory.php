<?php

namespace Modules\Forum\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Forum\Domain\Models\Channel::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = fake()->word();
        return [
            'name' => $name,
            'slug' => strtolower($name)
        ];
    }
}

