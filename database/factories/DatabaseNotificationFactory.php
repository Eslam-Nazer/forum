<?php

namespace Database\Factories;

use App\Models\User;
use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<DatabaseNotification>
 */
class DatabaseNotificationFactory extends Factory
{
    protected $model = DatabaseNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id'    => Str::uuid(),
            'notifiable_id' => auth()->guard()->id(),
            'notifiable_type' => User::class,
            'read_at' => null,
            'data' => [
                'message' => 'Hello world',
            ],
        ];
    }

    public function forNotification(string $notificationClass): static
    {
        return $this->state(fn() => [
            'type' => $notificationClass
        ]);
    }
}
