<div>
    <!--! Start:: Breadcumb !-->
    <div class="edash-content-breadcumb row mb-4 mb-md-6 pt-md-2">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h4 fw-semibold text-dark">Ranking</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">User</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Ranking</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--! End:: Breadcumb !-->

    <!-- Page Content -->
    <div class="edash-page-container container-xxl" id="edash-page-container">
        <!-- Profile Header Card -->
        <div class="card mb-4">
            <div class="card-body p-0">
                <!-- Cover Photo Placeholder -->
                <div class="position-relative">
                    <div class="bg-light rounded-top"
                        style="height: 200px; display: flex; align-items: center; justify-content: center;">
                        {{-- <span class="text-muted fs-4">1600 × 480</span> --}}
                        <img src="{{ asset('assets/images/cover-user-dash.png') }}" alt="Reward" style="width: 100%"
                            class="img-fluid  rounded " />
                    </div>

                    <!-- Profile Photo Placeholder -->
                    <div class="position-absolute" style="bottom: -30px; left: 30px;">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center "
                            style="width: 120px; height: 120px; border: 4px solid white;">
                            {{-- <span class="text-muted fs-6">300 × 300</span> --}}
                            <img src="{{ asset('assets/images/eq-user.png') }}" alt="Reward"
                                class="img-fluid  rounded-circle " />
                        </div>
                    </div>
                </div>

                <!-- Profile Info and Actions -->
                <div class="pt-5 pb-4 px-4">
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="ms-5" style="margin-top: 20px;">
                                <h4 class="mb-1">{{ $user->first_name . ' ' . $user->last_name }}</h4>
                                <p class="text-muted mb-2">#{{ $user->id }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="text-end">
                                <div class="badge bg-warning-subtle text-warning fs-6 mb-2">
                                    <i class="fi fi-rr-trophy me-2"></i>Current Level
                                </div>
                                <h5 class="text-primary mb-1">{{ $inProgressInDetail->name }}</h5>
                                <p class="text-muted fs-6 mb-0">Level {{ $inProgressInDetail->id }} Progress</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Main Content Area (Left Side) -->
            <div class="col-lg-8">
                <!-- Levels -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Levels</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr class="fs-12 text-uppercase">
                                        <th>LEVEL</th>
                                        <th class="min-wd-250">REWARD</th>
                                        <th class="text-end wd-150">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promotions as $rank)
                                        <tr
                                            class="{{ $inProgressInDetail?->id == $rank?->id ? 'current-level-row' : '' }}">
                                            <td>
                                                <div>
                                                    <a href="javascript:void(0);"
                                                        class="mb-1 d-block">{{ $rank->name }}</a>
                                                    <span class="fs-12 text-muted text-uppercase d-block">Level:
                                                        {{ $rank->id }}</span>
                                                    {{-- </span> --}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-4">
                                                    <img src="{{ Storage::disk('public')->url($rank->image) }}"
                                                        alt="Reward" class="img-fluid wd-64 rounded" />
                                                    {{-- <img src="./../assets/images/general/trophy.png" alt="Reward"
                                                        class="img-fluid wd-64 rounded" /> --}}
                                                    <div>
                                                        <span class="d-block word-wrap">{{ $rank->reward_name }}</span>
                                                        <small class="text-muted">Completion reward</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                {{-- <span class="badge bg-warning-subtle text-warning">Current
                                                Progress</span> --}}
                                                @if ($rank->is_achived)
                                                    <span class="badge bg-success-subtle text-success">Completed</span>
                                                @else
                                                    @if ($inProgressInDetail->id == $rank->id)
                                                        <span class="badge bg-warning-subtle text-warning">In
                                                            Progress</span>
                                                    @else
                                                        <span
                                                            class="badge bg-secondary-subtle text-secondary">Upcoming</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Added remaining levels per provided plan -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">

                <!-- Current Level Progress -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Current Level Progress</h6>
                        <span class="badge bg-warning-subtle text-warning">Level {{ $inProgressInDetail->id }}</span>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-2"> {{ $inProgressInDetail->name }}</h5>

                        <!-- Criteria List -->
                        <div class="vstack gap-2 mb-3">
                            @foreach ($criteriaAssigned as $cri)
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-muted fs-12">{{ $cri?->criteria?->name }}</span>
                                    @if ($cri['completed'])
                                        <span class="badge bg-success-subtle text-success">✅ Complete</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning">Not Complete</span>
                                    @endif
                                </div>
                            @endforeach
                            @foreach ($courseAssigned as $cr)
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-muted fs-12">{{ $cr?->course?->name }}</span>
                                    @if ($cri['completed'])
                                        <span class="badge bg-success-subtle text-success">✅ Complete</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning">Not Complete</span>
                                    @endif
                                </div>
                            @endforeach
                            @if ($inProgressInDetail->direct_sale_count > 0)
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-muted fs-12">New Direct Sales</span>
                                    @if ($inProgressInDetail->all_sales_completed >= $inProgressInDetail->direct_sale_count)
                                        <span class="badge bg-success-subtle text-success">✅ Complete</span>
                                    @else
                                        <span
                                            class="badge bg-warning-subtle text-warning">{{ $inProgressInDetail->all_sales_completed }}
                                            / {{ $inProgressInDetail->direct_sale_count }}</span>
                                    @endif

                                </div>
                            @endif
                            @if ($inProgressInDetail->sales_targrt > 0)
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-muted fs-12">Sales Target</span>
                                      @if ($inProgressInDetail->all_sales_completed >= $inProgressInDetail->sales_targrt)
                                        <span class="badge bg-success-subtle text-success">✅ Complete</span>
                                    @else
                                         <span
                                        class="badge bg-warning-subtle text-warning">{{ $inProgressInDetail->all_sales_completed }}
                                        / {{ $inProgressInDetail->sales_targrt }}</span>
                                    @endif

                                </div>
                            @endif
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="text-muted fs-12">Team Comission</span>
                                @if ($inProgressInDetail->income_completed >= $inProgressInDetail->income_target)
                                    <span class="badge bg-success-subtle text-success">✅ Complete</span>
                                @else
                                    <span
                                        class="badge bg-warning-subtle text-warning">{{ number_format($inProgressInDetail->income_completed) }}
                                        / {{ number_format($inProgressInDetail->income_target, 2) }}</span>
                                @endif

                            </div>
                            @if ($inProgressInDetail->downline_count == 2)
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-muted fs-12">Two Active Downlines</span>
                                    @if ($downline_status)
                                        <span class="badge bg-success-subtle text-success">✅ Complete</span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning">Not Complete</span>
                                    @endif
                                </div>
                            @endif

                        </div>


                    </div>
                </div>



                <!-- Current Level Completion Reward -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Current Level Completion Reward</h6>
                        <span class="badge bg-success-subtle text-success"><i class="fi fi-rr-trophy"></i>
                            Level {{ $inProgressInDetail->id }}</span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <img src="{{ Storage::disk('public')->url($inProgressInDetail->image) }}"
                                alt="Reward Thumbnail" class="rounded w-100"
                                style="aspect-ratio: 3 / 2; object-fit: cover;" />
                            {{-- <img src="./../assets/images/general/trophy.png" alt="Reward Thumbnail"
                                class="rounded w-100" style="aspect-ratio: 3 / 2; object-fit: cover;" /> --}}
                        </div>
                        <h6 class="mb-1">Active Representative Completion</h6>
                        <p class="text-muted fs-12 mb-0">100% Training + Active Representative Meeting</p>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <style>
        .table-primary {
            background-color: rgba(13, 110, 253, 0.1) !important;
        }

        .progress {
            background-color: #e9ecef;
            border-radius: 0.375rem;
        }

        .progress-bar {
            border-radius: 0.375rem;
        }

        .avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
        }

        .avatar-sm {
            width: 1.5rem;
            height: 1.5rem;
        }

        .avatar-xl {
            width: 3rem;
            height: 3rem;
        }

        .word-wrap {
            word-wrap: break-word;
            /* old */
            overflow-wrap: break-word;
            /* new standard */
            white-space: normal;
        }


        .bg-light.rounded-top {
            overflow: hidden;
        }

        .img-fluid {
            max-width: 100%;
            height: 100%;
            object-fit: cover !important;
        }

        /* Highlight current level row like the blue gradient card */
        .current-level-row {
            background: linear-gradient(135deg,
                    #3b82f6 0%,
                    #1d4ed8 50%,
                    #1e40af 100%) !important;
        }

        .current-level-row a,
        .current-level-row span,
        .current-level-row small,
        .current-level-row td,
        .current-level-row th {
            color: #fff !important;
        }

        .current-level-row .text-muted {
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .current-level-row .badge {
            background: rgba(255, 255, 255, 0.2) !important;
            color: #fff !important;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
    </style>
</div>
