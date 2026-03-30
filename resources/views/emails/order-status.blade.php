<x-mail::message>
# Status Updated !

Thanks for shopping with us!<br><br>
Hi {{ $data['name'] }},<br>
Your Order has been {{ $data['status'] }}, at  {{ $data['time'] }}


We’re getting your order ready and will let you know once it’s on the way. We wish you enjoy shopping with us and hope to see you again real soon!
<x-mail::button :url="$data['url']">
VIEW
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
