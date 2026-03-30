<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <!--! BEGIN: MatisMenu CSS -!-->
    <link rel="stylesheet" href="{{ asset('assets/vendors/metismenu/metisMenu.min.css') }}">
    <!--! END: MatisMenu CSS -!-->

    <!--! BEGIN: Flaticon CSS -!-->
    <link rel="stylesheet" href="{{ asset('assets/vendors/@flaticon/flaticon-uicons/css/all/all.css') }}">
    <!--! END: Flaticon CSS -!-->

    <!--! BEGIN: Theme CSS -!-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.min.css') }}">
    <!--! END: Theme CSS -!-->

    <!--! Start:: Color Modes JS -!-->
    <script src="{{ asset('assets/js/color-modes.min.js') }}"></script>
    <!--! END: Theme CSS -!-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/sweetalert2/sweetalert2.min.css') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>

    @livewireScripts

    <!--! BEGIN: Common Vendors !-->
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <!--! END: Common Vendors !-->

    <!--! BEGIN: Apps Common Init  !-->
    <script src="{{ asset('assets/js/common-init.min.js') }}"></script>
    <!--! END: Apps Common Init  !-->

    <script src="{{ asset('assets/js/misc/lslstrength.min.js') }}"></script>
    <!--! BEGIN: Page Vendors -!-->
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!--! END: Page Vendors -!-->

    <!-- BEGIN: Init JS -->
    <script src="{{ asset('assets/js/components/extended/sweetalert2-init.min.js') }}"></script>
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

        window.addEventListener('registered_with_id', function(e) {
            Swal.fire({
                text: e.detail[0].title,
                icon: "success",
                buttonsStyling: !1,
                confirmButtonText: e.detail[0].detail,
                customClass: {
                    confirmButton: "btn btn-success"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        });
    </script>
</body>

</html>
