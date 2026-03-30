<x-app-layout>
    <livewire:course.pay.direct-bank courseId="{{ $courseId }}" amount="{{ $payment }}"
        purchasedPercent="{{ $paymentType }}" />
    </ x-app-layout>
