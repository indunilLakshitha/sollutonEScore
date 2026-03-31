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

        window.addEventListener('task_details_popup', function(e) {
            var d = e.detail;
            if (Array.isArray(d)) d = d[0];
            if (!d || !window.Swal) return;

            var t = d.task || {};
            var otherUsers = Array.isArray(d.other_users) ? d.other_users : [];
            var canSubmit = !!d.can_submit;

            var esc = function(s) {
                return (s ?? '').toString()
                    .replaceAll('&', '&amp;')
                    .replaceAll('<', '&lt;')
                    .replaceAll('>', '&gt;')
                    .replaceAll('"', '&quot;')
                    .replaceAll("'", '&#039;');
            };

            var otherHtml = otherUsers.length
                ? '<ul class="text-start mb-0 ps-3">' + otherUsers.map(function(u) {
                    return '<li>' + esc(u.name) + (u.reg_no ? ' <span class="text-muted">(' + esc(u.reg_no) + ')</span>' : '') + '</li>';
                }).join('') + '</ul>'
                : '<div class="text-muted small">No other assigned users.</div>';

            var descHtml = t.description
                ? '<div class="mb-3 text-start"><div class="fw-semibold">Description</div><div class="text-muted small">' + esc(t.description) + '</div></div>'
                : '';

            var noteInputHtml = canSubmit
                ? '<textarea id="swal_task_note" class="swal2-textarea" placeholder="Optional note..."></textarea>'
                : '';

            Swal.fire({
                title: esc(t.name || 'Task details'),
                html: '' +
                    '<div class="text-start">' +
                    '  <div class="row g-2 small mb-3">' +
                    '    <div class="col-md-6"><span class="text-muted">Category:</span> ' + esc(t.category || '—') + '</div>' +
                    '    <div class="col-md-6"><span class="text-muted">Deadline:</span> ' + esc(t.deadline_at || '—') + '</div>' +
                    '    <div class="col-md-6"><span class="text-muted">Status:</span> ' + (t.is_expired ? 'Expired' : esc(t.status || '—')) + '</div>' +
                    '    <div class="col-md-6"><span class="text-muted">Score:</span> ' + (t.is_expired ? '0' : (t.score ?? '—')) + ' / ' + esc(t.max_score ?? 0) + '</div>' +
                    '  </div>' +
                    descHtml +
                    '  <div class="mb-3 text-start">' +
                    '    <div class="fw-semibold">Other assigned users</div>' +
                    otherHtml +
                    '  </div>' +
                    '  <div class="small text-start mb-2"><span class="text-muted">Submitted at:</span> ' + esc(t.submitted_at || '—') + '</div>' +
                    '  <div class="small text-start mb-3"><span class="text-muted">Last note:</span> ' + esc(t.submission_note || '—') + '</div>' +
                    noteInputHtml +
                    '</div>',
                showCancelButton: true,
                confirmButtonText: canSubmit ? 'Mark as done' : 'Close',
                cancelButtonText: 'Close',
                focusConfirm: false,
                preConfirm: function() {
                    if (!canSubmit) return true;
                    return {
                        note: document.getElementById('swal_task_note')?.value ?? ''
                    };
                }
            }).then(function(res) {
                if (res.isConfirmed && canSubmit && window.Livewire) {
                    window.Livewire.dispatch('markAsDoneWithNote', {
                        id: parseInt(t.id, 10),
                        note: (res.value && res.value.note) ? res.value.note : ''
                    });
                }
            });
        });
    </script>
</body>

</html>
