<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="Sales Chart" section="User" sub="My Team" action="Sales Chart">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">

            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <!--  -->
                        <form action="#" class="form-group" id="repeaterAdvanced">
                            <div data-repeater-list="repeater-advanced">
                                <div data-repeater-item>
                                    <div class="form-group row mb-2">
                                        <div class="col-lg-12 mb-2 mb-md-0 pt-1">
                                            <h4 class="card-title mb-2">{{ $selectedUser->name }} /
                                                {{ $selectedUser->id }}
                                            </h4>

                                        </div>
                                        <div class="col-lg-12 mb-2 mb-md-0 pt-1">

                                            <h4 class="card-title align-items-center d-flex justify-content-center">A 1
                                                -
                                                {{ $selectedUser->left_points }}<small class="mr-5 ml-5"> Available
                                                    Points
                                                </small>A 2 -
                                                {{ $selectedUser->right_points }}</h4>
                                        </div>
                                        <div class="col-lg-12 mb-2 mb-md-0 pt-1">

                                            <select class="form-select user-list " wire:model='selectedAccountId'
                                                wire:change='filter()'>
                                                <option value="null">{{ $selectedUser->name }}</option>
                                                @foreach ($myMembers as $member)
                                                    <option value="{{ $member->id }}">{{ $member->id }} -
                                                        {{ $member->first_name . ' ' . $member->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal2" aria-labelledby="exampleModal2Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabe2">
                                {{ $selected['name'] }}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="card">
                            <div class="card-body d-flex">
                                <div class="col-3">
                                    <div class="avatar avatar-md rounded flex-shrink-0 ml-5">
                                        <img src="{{ asset('assets/images/avatar/1.png') }}" alt=""
                                            class="img-fluid rounded" />
                                    </div>
                                    <dt class="mb-3 fs-15">{{ $selected['id'] }}</dt>
                                    <dl class="dl-horizontal mb-0 hstack">
                                        <dt class="mb-1">a1 :{{ $selected['a1'] }}</dt>
                                        <dt>a2 :{{ $selected['a2'] }}</dt>

                                    </dl>
                                </div>
                                <div class="col">
                                    <dl class="dl-horizontal mb-0 hstack">
                                        <dt>Contact No :</dt>
                                        <dd>{{ $selected['contact'] }}</dd>

                                        <dt>District :</dt>
                                        <dd>{{ $selected['district'] }}</dd>
                                        <dt>City :</dt>
                                        <dd>{{ $selected['city'] }}</dd>
                                        <dt>Agent 1 :</dt>
                                        <dd>{{ $selected['agent_1'] }}</dd>
                                        <dt>Agent 2 :</dt>
                                        <dd>{{ $selected['agent_2'] }}</dd>
                                    </dl>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="hidden" class="d-none" id="showMdl" data-bs-toggle="modal"
                data-bs-target="#exampleModal2"></button>
            <!-- End:: Filter -->
            <div class="col-6">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <!-- Start:: Zero Config -->
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="card-header is-sales-chart-title">
                            <h4 class="card-title">Agent 1 /
                                {{ $this->allLeftAccounts }}</h4>
                        </div>
                        <div class="card-header is-sales-chart-title">
                            <h4 class="card-title">Agent 2 /
                                {{ $this->allRightAccounts }}</h4>
                        </div>

                    </div>

                    <div class="card-table table-responsive d-flex ">
                        <div class="table-responsive  col-6 border-right-sales-chart ">
                            <table class="table mb-0">
                                <thead class="border-top">
                                    <tr>
                                        <th scope="col-3">Agent 1</th>
                                        <th scope="col-3">Status</th>
                                        <th scope="col-6">Name</th>
                                        <th scope="col-3">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leftAccounts as $leftAc)
                                        <tr>
                                            <td><a href="javascript:void(0)">
                                                    @if ($leftAc->er_status == '2')
                                                        <h6 class="half-color">{{ $leftAc->id }}</h6>
                                                    @elseif ($leftAc->er_status == '3')
                                                        <h6 class="full-color">{{ $leftAc->id }}</h6>
                                                    @elseif ($leftAc->er_status == '4')
                                                        <h6 class="er-color">{{ $leftAc->id }}</h6>
                                                    @endif
                                                </a></td>
                                            <td>
                                                @if ($leftAc->er_status == '2')
                                                    <h6 class="half-color">HALF</h6>
                                                @elseif ($leftAc->er_status == '3')
                                                    <h6 class="full-color">FULL</h6>
                                                @elseif ($leftAc->er_status == '4')
                                                    <h6 class="er-color">ER</h6>
                                                @endif
                                            </td>
                                            <td>

                                                <a href="javascript:void(0);" class="d-flex gap-3 align-items-center"
                                                    wire:click='setSelectedUser({{ $leftAc->id }})'>

                                                    <div class="flex-shrink-0">
                                                        <div>{{ $leftAc->first_name . ' ' . $leftAc->last_name }}
                                                        </div>

                                                    </div>
                                                </a>
                                            </td>

                                            <td>
                                                <h6 class="point-color"> A1 :{{ $leftAc->left_points }}
                                                    A2 :{{ $leftAc->right_points }}</h6>

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive col-6 ">
                            <table class="table mb-0">
                                <thead class="border-top">
                                    <tr>
                                        <th scope="col-3">Agent 2</th>
                                        <th scope="col-3">Status</th>
                                        <th scope="col-6">Name</th>
                                        <th scope="col-3">Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rightAccounts as $rightAc)
                                        <tr>
                                            <td>
                                                @if ($rightAc->er_status == '2')
                                                    <h6 class="half-color">{{ $rightAc->id }}</h6>
                                                @elseif ($rightAc->er_status == '3')
                                                    <h6 class="full-color">{{ $rightAc->id }}</h6>
                                                @elseif ($rightAc->er_status == '4')
                                                    <h6 class="er-color">{{ $rightAc->id }}</h6>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($rightAc->er_status == '2')
                                                    <h6 class="half-color">HALF</h6>
                                                @elseif ($rightAc->er_status == '3')
                                                    <h6 class="full-color">FULL</h6>
                                                @elseif ($rightAc->er_status == '4')
                                                    <h6 class="er-color">ER</h6>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="d-flex gap-3 align-items-center"
                                                    wire:click='setSelectedUser({{ $rightAc->id }})'>

                                                    <div class="flex-shrink-0">
                                                        <div>{{ $rightAc->first_name . ' ' . $rightAc->last_name }}
                                                        </div>

                                                    </div>
                                                </a>
                                            </td>

                                            <td>
                                                <h6 class="point-color"> A1 : {{ $rightAc->left_points }} A2 :
                                                    {{ $rightAc->right_points }}
                                                </h6>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="pg_id">

                        {{ $rightAccounts->links() }}
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>

        <style>
            .user-list {
                max-width: 317px;
                margin: 20px auto 0 auto;
            }

            .form-group {
                text-align: center;

            }

            small {
                font-size: 12px;
                margin: 0 20px;
            }

            .card-header.is-sales-chart-title {
                width: 50%;
                text-align: center;
            }

            .er-color {
                color: green;
            }

            .full-color {
                color: rgb(23, 136, 211);
            }

            .half-color {
                color: rgb(23, 36, 211);
            }

            .point-color {
                color: red !important;
            }

            .table-responsive.col-6.border-right-sales-chart {
                border-right: 5px solid var(--expo-border-color);
            }

            .fs-12 {
                font-size: 1rem !important;
            }

            #pg_id nav svg {
                width: 20px !important;
            }

            #pg_id nav .flex {
                display: none;
            }

            #pg_id nav .hidden {
                display: flex !important;
                align-items: center;
                column-gap: 15px;
                margin-top: 10px;
                padding: 20px;

            }

            #pg_id nav .hidden p {
                margin: 0px;
            }
        </style>
</div>

<script>
    window.addEventListener('show_modal', function(e) {
        document.getElementById('showMdl').click();
    });
</script>
