@component('mail::message')
# {{ __('register.EmailConfirmation') }}

{{ __('register.VerifyLink') }}:

@component('mail::button', ['url' => route('register.verify', ['token' => $user->verify_token])])
{{ __('register.VerifyEmail') }}
@endcomponent

Спасибо,<br>
{{ config('app.name') }}
@endcomponent
