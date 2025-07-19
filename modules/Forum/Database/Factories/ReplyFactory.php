<?php

namespace Modules\Forum\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Forum\Domain\Models\Thread;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Forum\Domain\Models\Reply::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'thread_id' => Thread::factory()->create()->id,
            'body' => $this->faker->paragraph,
        ];
    }
}

