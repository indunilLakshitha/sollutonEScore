<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendors/summernote/summernote-lite.min.css') }}">


    <!--! BEGIN: Page Vendors -!-->
    <link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datatable-full/bootstrap-datatable.min.css') }}" />
    <!--! END: Page Vendors -!-->

    <link rel="stylesheet" href="{{ asset('/assets/vendors/apexcharts/apexcharts.css') }}" />

    <!--! BEGIN: MatisMenu CSS -!-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/metismenu/metisMenu.min.css') }}">
    <!--! END: MatisMenu CSS -!-->

    <!--! BEGIN: Flaticon CSS -!-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/@flaticon/flaticon-uicons/css/all/all.css') }}">
    <!--! END: Flaticon CSS -!-->
    <link rel="stylesheet"
        href="{{ asset('/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" />

    <!--! BEGIN: Theme CSS -!-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/theme.min.css') }}">
    <!--! END: Theme CSS -!-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/sweetalert2/sweetalert2.min.css') }}" />
    <!--! Start:: Color Modes JS -!-->
    <script src="{{ asset('/assets/js/color-modes.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        .main-color {
            color: green
        }

        .dummy-color {
            color: orange
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="">
    <div class="main-wrapper">
        @include('layouts.comp.aside')
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
        document.addEventListener('livewire:init', function() {
            var notifyMethods = ['assignSelectedUsers', 'save', 'approve', 'reject'];

            Livewire.hook('commit', function(_ref) {
                var commit = _ref.commit,
                    succeed = _ref.succeed,
                    fail = _ref.fail;
                var calls = commit.calls || [];
                if (!calls.some(function(c) {
                        return notifyMethods.indexOf(c.method) !== -1;
                    })) {
                    return;
                }
                if (typeof Swal === 'undefined') {
                    return;
                }

                Swal.fire({
                    title: 'Sending notifications',
                    html: '<p class="small text-muted mb-3 mb-0 px-1">SMS and email are being sent. Please wait.</p>' +
                        '<div class="progress rounded-pill overflow-hidden mx-1" style="height:10px">' +
                        '<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" ' +
                        'style="width:100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" ' +
                        'aria-valuemax="100"></div></div>',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'text-start'
                    }
                });

                succeed(function() {
                    Swal.close();
                });
                fail(function() {
                    Swal.close();
                });
            });
        });
    </script>

    <!--! BEGIN: Page Vendors -!-->
    <script src="{{ asset('assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <!--! END: Page Vendors -!-->

    <!-- BEGIN: Init JS -->
    <script src="{{ asset('assets/js/components/forms/touchspin-init.min.js') }}"></script>
    <!-- END: Init JS-->

    <!--! BEGIN: Page Vendors -!-->
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <!--! END: Page Vendors -!-->

    <!-- BEGIN: Init JS -->
    <script src="{{ asset('assets/js/components/charts/chartjs-init.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/summernote/summernote-lite.min.js') }}"></script>
    <!--! END: Page Vendors -!-->

    <!-- BEGIN: Init JS -->
    <script src="{{ asset('assets/js/components/editors/summernote-init.min.js') }}"></script>
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
        function livewireToastTitle(e) {
            var d = e.detail;
            if (d == null) return '';
            if (typeof d.title === 'string') return d.title;
            if (Array.isArray(d) && d[0] && typeof d[0].title === 'string') return d[0].title;
            return '';
        }

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
                title: livewireToastTitle(e)
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
                title: livewireToastTitle(e)
            });
        });

        window.addEventListener('done_alert', function(e) {
            Swal.fire("Done!", "", "success");
        });

        window.addEventListener('not_done_alert', function(e) {
            Swal.fire("Changes are not saved", "", "info");
        });

        window.addEventListener('copy_alert', function(e) {
            Swal.fire({
                title: "Are you sure?",
                text: "You Want To Copt The Referral Link ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Copy it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    copy();
                }
            });
        });
    </script>
</body>

</html>
