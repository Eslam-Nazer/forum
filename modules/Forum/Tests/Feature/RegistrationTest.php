<?php

namespace Modules\Forum\Tests\Feature;

use App\Listeners\SendEmailConfirmationRequest;
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

    public function test_user_can_fully_confirm_their_email_addresses():void
    {
        $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $user = User::whereName('John Doe')->first();

        $this->assertFalse($user->confirmed);
        $this->assertNotNull($user->confirmation_token);
    }
}
