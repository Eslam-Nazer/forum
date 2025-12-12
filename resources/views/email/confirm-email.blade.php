<x-mail::message>
# One Last Step

We just need you to confirm your email address to prove that you're a owner.

<x-mail::button :url="url('/register/confirm?token=' . $user->confirmation_token)">
Confirm Email
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
