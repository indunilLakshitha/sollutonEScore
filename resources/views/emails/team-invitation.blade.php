@component('mail::message')
{{ __('You have been invited to join the :team team!') }}

<p>Thanks for Joining {{ config('app.name') }}.</p>

<p>Email : 33333</p>
<p>Password : 3333</p>

<p>Cick on the link bellow, to Validate your email address.</p>

{{ __('If you already have an account, you may accept this invitation by clicking the button below:') }}

@else
{{ __('You may accept this invitation by clicking the button below:') }}
@endif


@component('mail::button', ['url' => 'test/sss'])
{{ __('Accept Invitation') }}
@endcomponent

{{ __('If you did not expect to receive an invitation to this team, you may discard this email.') }}
@endcomponent

