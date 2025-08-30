<?php

namespace Modules\Forum\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Forum\Domain\Models\Channel;

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
            'user_id' => fn () => User::factory()->create()->id,
            'channel_id' => fn () => Channel::factory()->create()->id,
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];
    }
}

