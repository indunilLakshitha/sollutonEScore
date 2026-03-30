<x-app-layout>
    <livewire:course.pay.wallet courseId="{{ $courseId }}" amount="{{ $payment }}"
        purchasedPercent="{{ $paymentType }}" />
    </ x-app-layout>
