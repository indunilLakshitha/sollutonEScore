<!--! ================================================================ !-->
<!--! Start:: Page Content !-->
<!--! ================================================================ !-->
<div class="edash-page-container container-xxl" id="edash-page-container">
    <!--! Start:: Breadcumb !-->
    <div class="edash-content-breadcumb row mb-4 mb-md-6 pt-md-2">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h4 fw-semibold text-dark">Summery</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0;)">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0;)">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Summery
                            </li>
                        </ol>
                    </nav>
                </div>
                {{-- <div class="d-flex align-items-center gap-2">
                    <a href="javascript:void(0);" class="btn btn-md bg-white text-black d-none d-sm-flex">New
                        Project</a>
                    <a href="javascript:void(0);" class="btn btn-md btn-primary">Reports</a>
                </div> --}}
            </div>
        </div>
    </div>
    <!--! End:: Breadcumb !-->
    <!--! Start:: Content Section !-->
    <div class="edash-content-section row g-3 g-md-4">
        <!-- Start:: Earning & Expense -->
        <div class="col-xxl-8">
            <!-- Start:: card -->
            <div class="card mb-3 mb-md-4">
                <div class="card-body">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fs-18">Store Overview</h5>
                            <p class="fs-13 text-muted mb-0">
                                Updated 37 minutes ago
                            </p>
                        </div>
                        {{-- <a href="javascript:void(0);" class="icon-link icon-link-hover link-primary">
                            <span>View Details</span>
                            <i class="fi fi-rr-arrow-small-right bi"></i>
                        </a> --}}
                    </div>
                    <div class="row g-3 g-md-4">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between pd-5">
                                        <div class="avatar avatar-xl rounded bg-warning-subtle text-warning">
                                            <i class="fi fi-rr-shopping-cart-add"></i>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="fs-18 fw-semibold">{{env('CURRENCY')}}0</h4>
                                            <span class="fs-13 text-muted">Total Commission</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between pd-5">
                                        <div class="avatar avatar-xl rounded bg-danger-subtle text-danger">
                                            <i class="fi fi-rr-cart-minus"></i>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="fs-18 fw-semibold">{{env('CURRENCY')}}0</h4>
                                            <span class="fs-13 text-muted">Total Direct Sale commissio</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between pd-5">
                                        <div class="avatar avatar-xl rounded bg-success-subtle text-success">
                                            <i class="fi fi-rr-sack-dollar"></i>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="fs-18 fw-semibold">{{env('CURRENCY')}}0</h4>
                                            <span class="fs-13 text-muted">Total Group Sale commission</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between pd-5">
                                        <div class="avatar avatar-xl rounded bg-warning-subtle text-warning">
                                            <i class="fi fi-rr-shopping-cart-add"></i>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="fs-18 fw-semibold">{{env('CURRENCY')}}0</h4>
                                            <span class="fs-13 text-muted">Total paid commission</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between pd-5">
                                        <div class="avatar avatar-xl rounded bg-danger-subtle text-danger">
                                            <i class="fi fi-rr-cart-minus"></i>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="fs-18 fw-semibold">{{env('CURRENCY')}}0</h4>
                                            <span class="fs-13 text-muted">Total Unpaid commission</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center justify-content-between pd-5">
                                        <div class="avatar avatar-xl rounded bg-success-subtle text-success">
                                            <i class="fi fi-rr-sack-dollar"></i>
                                        </div>
                                        <div class="text-end">
                                            <h4 class="fs-18 fw-semibold">{{env('CURRENCY')}}0</h4>
                                            <span class="fs-13 text-muted">Total Registration requests</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: card -->

        </div>
        <!-- End:: Earning & Expense -->
        <!-- Start:: Mini Card -->
        <div class="col-xxl-4">
            <!-- card Start:: -->
            <div class="card mb-3 mb-md-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="py-2">
                            <h5 class="fw-semibold text-dark">Profile</h5>
                            {{-- <p class="fs-13 text-muted text-truncate col">
                                Monthly performance reports
                            </p> --}}
                            <div class="mt-5">
                                <h3 class="fs-13 mb-1">
                                    <span>{{ Auth::user()->name  }}</span><br>
                                    <span>{{ Auth::user()->reg_no  }}</span><br>
                                    <span>{{ Auth::user()->mobile_no  }}</span><br>
                                    {{-- <span class="fs-18 fw-semibold text-primary mb-2 d-inline-block">$5.65K</span> --}}
                                </h3>
                                <a href="javascript:void(0);" class="btn btn-md btn-primary">Copy Refferal Link</a>
                            </div>
                        </div>
                        <circle-progress class="performance-progress mt-3" max="100" value="60"
                            text-format="percent"></circle-progress>
                    </div>
                </div>
            </div>
            <!-- card End:: -->

            </div>
            <!-- row End:: -->
        </div>
        <!-- End:: Mini Card -->
    </div>
    <!--! End:: Content Section !-->
</div>
<!--! ================================================================ !-->
<!--! End:: Page Content !-->
<!--! ================================================================ !-->
