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



        <ul class="edash-metismenu" id="edash-metismenu">
            <li class="nav-label mb-2 mt-4 px-5 fs-11 fw-semibold text-muted text-uppercase"
                style="letter-spacing: 1px">
                SUMMARY
            </li>
            <li>
                <a class="" href="{{ route('dashboard') }}">
                    <i class="fi fi-rr-chart-line-up"></i>
                    <span class="mm-text">Dashboard</span>
                </a>

            </li>
          
            <li class="nav-label mb-2 mt-4 px-5 fs-11 fw-semibold text-muted text-uppercase"
                style="letter-spacing: 1px">
                MANAGEMENT
            </li>

            @if (Auth::check() && (int) (Auth::user()->is_admin ?? 0) === 1)
                <li>
                    <a class="has-arrow" href="javascript:void(0);">
                        <i class="fi fi-rr-users-alt"></i>
                        <span class="mm-text">Members</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.member.index') }}" class="sub-menu">Member Management</a>
                        </li>
                    </ul>
                </li>
            @endif

            <li>
                <a class="has-arrow" href="javascript:void(0);">
                    <i class="fi fi-rr-clipboard-list"></i>
                    <span class="mm-text">Tasks</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('task.my-tasks') }}" class="sub-menu">My Tasks</a>
                    </li>
                    <li>
                        <a href="{{ route('task.monthly-summary') }}" class="sub-menu">Monthly Summary</a>
                    </li>
                    @if (Auth::check() && (int) (Auth::user()->is_admin ?? 0) === 1)
                        <li>
                            <a href="{{ route('admin.task.index') }}" class="sub-menu">Task Management</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.task-category.index') }}" class="sub-menu">Task Categories</a>
                        </li>
                    @endif
                </ul>
            </li>
            @if (Auth::check() && (int) (Auth::user()->is_admin ?? 0) === 1)
                <li>
                    <a class="has-arrow" href="javascript:void(0);">
                        <i class="fi fi-rr-chart-histogram"></i>
                        <span class="mm-text">Performance</span>
                    </a>
                    <ul>

                        <li>
                            <a href="{{ route('admin.member-performance.index') }}" class="sub-menu">Member
                                Performance</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:void(0);">
                        <i class="fi fi-rr-settings"></i>
                        <span class="mm-text">Settings</span>
                    </a>
                    <ul>

                        <li>
                            <a href="{{ route('admin.company-sales.index') }}" class="sub-menu">Company Sales Count</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.settings.index') }}" class="sub-menu">Income Multipliers</a>
                        </li>
                    </ul>
                </li>
            @endif



        </ul>



    </nav>
    <!-- End:: Sidebar Nav -->
</aside>
