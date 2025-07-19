<?php

namespace Modules\Forum\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThreadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Forum\Domain\Models\Thread::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];
    }
}

