<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('market/assets/css/owl.carousel.min.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="stylesheet" href="{{ asset('market/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('market/assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('market/assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('market/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('market/assets/css/bootstrap-slider.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/brands.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixe">
    <div class="wrapper">
        @include('layouts.MARKETPLACE.header')
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @include('layouts.MARKETPLACE.footer')
    </div>

    @stack('modals')

    @livewireScripts
    <a href="#" class="btn-gradient scroll_top"><i class="ion-ios-arrow-up"></i></a>
    <script src="{{ asset('market/js/jquery.js') }}"></script>
    <script src="{{ asset('market/js/bootstrap.js') }}"></script>
    <script src="{{ asset('market/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('market/js/slick.js') }}"></script>
    <script src="{{ asset('market/js/countdown.js') }}"></script>
    <script src="{{ asset('market/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('market/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        window.addEventListener('success_alert', function(e) {

            Swal.mixin({
                toast: !0,
                position: "top-end",
                showConfirmButton: !1,
                timer: 3e3,
                timerProgressBar: !0,
                didOpen: function didOpen(t) {
                    t.addEventListener("mouseenter", Swal.stopTimer), t.addEventListener("mouseleave",
                        Swal.resumeTimer);
                }
            }).fire({
                icon: "success",
                title: e.detail[0].title
            });
        });

        window.addEventListener('failed_alert', function(e) {

            Swal.mixin({
                toast: !0,
                position: "top-end",
                showConfirmButton: !1,
                timer: 3e3,
                timerProgressBar: !0,
                didOpen: function didOpen(t) {
                    t.addEventListener("mouseenter", Swal.stopTimer), t.addEventListener("mouseleave",
                        Swal.resumeTimer);
                }
            }).fire({
                icon: "error",
                title: e.detail[0].title
            });
        });

        window.addEventListener('done_alert', function(e) {
            Swal.fire("Done!", "", "success");
        });

        window.addEventListener('not_done_alert', function(e) {
            Swal.fire("Changes are not saved", "", "info");
        });

        window.addEventListener('payment_failed_alert', function(e) {
            Swal.fire({
                icon: "error",
                title: e.detail[0].title,
                text: e.detail[0].content,
            });
        });
        window.addEventListener('payment_success_alert', function(e) {
            Swal.fire({
                title: e.detail[0].title,
                icon: "success",
                draggable: true
            });
        });
        window.addEventListener('order_placed', function(e) {
            Swal.fire({
                title: "Done",
                text: "Your Order Has Been Placed!",
                icon: "success"
            });
        });
    </script>
</body>

</html>
