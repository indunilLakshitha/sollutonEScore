<x-mail::message>
# Congratulations !

Dear {{ $data['first_name'] }}<br>

Welcome to Equest Institute of Higher Education!<br><br>


You are now successfully registered for the {{ $data['course_name'] }}<br>
Registration Number: {{ $data['user_id'] }}<br>
Course Fee: {{ $data['fee'] }}<br>
Please deposit the course fee to below bank account to confirm your enrollment.<br><br>


Equest Institute of Higher Education<br>
Acc : 003510017969<br>
Sampath Bank - Galle City<br>
We look forward to supporting you on this exciting journey!

    {{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
