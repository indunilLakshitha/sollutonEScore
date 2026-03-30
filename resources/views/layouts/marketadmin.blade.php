<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" />

    <!--! BEGIN: Page Vendors -!-->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datatable-full/bootstrap-datatable.min.css') }}" />
    <!--! END: Page Vendors -!-->

    <!--! BEGIN: MatisMenu CSS -!-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/metismenu/metisMenu.min.css') }}">
    <!--! END: MatisMenu CSS -!-->

    <!--! BEGIN: Flaticon CSS -!-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/@flaticon/flaticon-uicons/css/all/all.css') }}">
    <!--! END: Flaticon CSS -!-->

    <!--! BEGIN: Theme CSS -!-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/theme.min.css') }}">
    <!--! END: Theme CSS -!-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/sweetalert2/sweetalert2.min.css') }}" />
    <!--! Start:: Color Modes JS -!-->
    <script src="{{ asset('/assets/js/color-modes.min.js') }}"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="">
    <div class="main-wrapper">
        @include('layouts.comp.aside_marketplace_admin')
        <main id="edash-main">
            @include('layouts.comp.header')
            <div class="edash-page-container container-xxl" id="edash-page-container">
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
            @include('layouts.comp.footer')
        </main>
    </div>
    @stack('modals')
    @livewireScripts



    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <!--! END: Common Vendors !-->

    <!--! BEGIN: Apps Common Init  !-->
    <script src="{{ asset('assets/js/common-init.min.js') }}"></script>
    <!--! END: Apps Common Init  !-->


    <!--! BEGIN: Page Vendors -!-->
    {{-- <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('assets/vendors/js-circle-progress/circle-progress.min.js') }}" type="module"></script>
    <script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datatable-full/bootstrap-datatable.min.js') }}"></script>
    <!--! END: Page Vendors -!-->

    <!-- BEGIN: Init JS -->
    {{-- <script src="{{ asset('assets/js/dashboards/ecommerce-init.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/components/selects/select2-init.min.js') }}"></script>
    <script src="{{ asset('assets/js/components/tables/datatable-init.min.js') }}"></script>

    <!--! BEGIN: Page Vendors -!-->
    <script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!--! END: Page Vendors -!-->

    <!-- BEGIN: Init JS -->
    <script src="{{ asset('assets/js/components/extended/sweetalert2-init.min.js') }}"></script>
    <!-- END: Init JS-->
    <script>
        "use strict";
        // Avatar Upload
        function initAvatarUpload() {
            $(".file-upload").on("change", function() {
                    var t;
                    this.files &&
                        this.files[0] &&
                        (((t = new FileReader()).onload = function(t) {
                                $(".upload-pic").attr("src", t.target.result);
                            }),
                            t.readAsDataURL(this.files[0]));
                }),
                $(".upload-button").on("click", function() {
                    $(".file-upload").click();
                });
        }
        // Date Picker
        function initBirthDatePicker() {
            $("#birthDatePicker").flatpickr({
                altInput: !0,
                altFormat: "F j, Y",
                dateFormat: "Y-m-d",
            });
        }
        $(function() {
            initAvatarUpload();
            initBirthDatePicker();
        });
    </script>
    <!-- END: Init JS-->

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

       
    </script>
</body>

</html>
