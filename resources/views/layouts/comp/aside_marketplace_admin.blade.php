<!--! ================================================================ !-->
<!--! Start:: Main Menu !-->
<!--! ================================================================ !-->
<aside class="edash-menu position-fixed z-1030 start-0 top-0 end-0 bottom-0 bg-body-tertiary border-end" id="edash-menu">
    <!-- Start:: Logo -->
    <div class="edash-menu-header ht-80 d-flex align-items-center px-5 py-4 position-relative">
        <a href="#" class="edash-logo">
            <img src="{{ asset('assets/images/logo-main.png') }}" alt="logo" class="img-fluid edash-logo-main" />
            <img src="{{ asset('assets/images/logo-abbr.png') }}" alt="logo" class="img-fluid edash-logo-abbr" />
        </a>
    </div>
    <!-- End:: Logo -->
    <!-- Start::  Sidebar Nav -->
    <nav class="edash-sidebar-nav position-relative z-2" id="edash-sidebar-nav" style="height: calc(100vh - 5rem)">
        @php
            $user = Auth::user();
            $status = $user->status;
        @endphp
        <ul class="edash-metismenu" id="edash-metismenu">
            <li class="nav-label mb-2 mt-4 px-5 fs-11 fw-semibold text-muted text-uppercase"
                style="letter-spacing: 1px">
                Navigations
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="fi fi-rr-airplay"></i>
                    <span class="mm-text">Dashboard</span>
                </a>
                <ul>
                    <li><a class="sub-menu" href="#">Dashboard</a></li>
                    {{-- <li>
                        <a class="sub-menu" href="./index-analytics.html">Analytics</a>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-label mb-2 mt-4 px-5 fs-11 fw-semibold text-muted text-uppercase"
                style="letter-spacing: 1px">
                Webapps
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="fi fi-rr-layers"></i>
                    <span class="mm-text">Product</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('marketplace.admin.category.index') }}" class="sub-menu">Category</a>
                    </li>
                    <li><a href="{{ route('course.myCourses') }}" class="sub-menu">Product</a></li>

                </ul>
            </li>

            <li>
                <a href="./app-email.html">
                    <i class="fi fi-rr-envelope-dot"></i>
                    <span class="mm-text">Wallet</span>
                </a>
            </li>
            <li>
                <a href="./app-invoice.html">
                    <i class="fi fi-rr-file-invoice"></i>
                    <span class="mm-text">Marketplace</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="fi fi-rr-layers"></i>
                    <span class="mm-text">My Team</span>
                </a>
                <ul>
                    @if ($user->is_tree_enabled)
                        <li>
                            <a href="{{ route('tree.my') }}" class="sub-menu">Tree View</a>
                        </li>
                    @endif
                    <li><a href="./base-avatar.html" class="sub-menu">Sales Chart</a></li>
                    <li><a href="./base-avatar.html" class="sub-menu">Direct Team</a></li>
                    <li><a href="{{ route('referrals.pending') }}" class="sub-menu">Not Approved</a></li>

                </ul>
            </li>
            <li>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </li>
            <div class="card text-center mx-3 mt-6 mb-4 bg-primary-subtle">
                <div class="card-body vstack gap-4">
                    <i class="fi fi-rr-rocket-lunch fs-1 text-primary" style="transform: rotate(320deg)"></i>
                    <div>
                        <h5 class="mb-2 text-primary">Help Center</h5>
                        <p class="fs-13 fw-light mb-0 text-primary">
                            Expodash is a production ready multi dashboard to get started up and
                            running easily.
                        </p>
                    </div>
                    <a href="mailto:contact@equest.info" class="btn btn-primary text-white w-100">Get Support</a>
                </div>
            </div>
    </nav>
    <!-- End:: Sidebar Nav -->
</aside>
