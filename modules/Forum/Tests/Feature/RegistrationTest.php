<?php

namespace Modules\Forum\Tests\Feature;

use App\Mail\PleaseConfirmYourEmail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_confirmation_email_is_sent_upon_registration(): void
    {
        Mail::fake();

        event(new Registered(create(User::class)));

        Mail::assertSent(PleaseConfirmYourEmail::class);
    }

    public function test_user_can_fully_confirm_their_email_addresses(): void
    {
        Mail::fake();
        $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $user = User::whereName('John Doe')->first();

        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);

        $response = $this->get(route('register.confirm', [
            "token" => $user->confirmation_token
        ]))
        ->assertRedirect(route('threads.index'));

        tap($user->fresh(), function ($user) {
            $this->assertTrue($user->confirmed);
            $this->assertNull($user->confirmation_token);
        });
    }

    public function test_confirming_an_invalid_token(): void
    {
        $this->get(route('register.confirm', [
            "token" => 'invalid-token'
        ]))
            ->assertRedirect(route('threads.index'))
            ->assertSessionHas('messages', ['error' => 'Invalid confirmation token.']);
    }
}
