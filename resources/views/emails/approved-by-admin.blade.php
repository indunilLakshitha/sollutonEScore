<x-mail::message>
# Congratulations !

Please Use Following Details to Login<br>
User ID : {{ $data['user_id'] }}<br>
Password : {{ $data['password'] }}

<x-mail::button :url="'https://equestinstitute.com'">
LOGIN
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
