<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="CUSTOMERS" section="Admin" sub="Customers" action="All">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Filter -->
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <!--  -->
                        <form action="#" class="form-group" id="repeaterAdvanced">
                            <div data-repeater-list="repeater-advanced">
                                <div data-repeater-item>
                                    <div class="form-group row mb-4">

                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Status:</label>
                                            <select class="form-select" wire:model='active_status'
                                                wire:change="filter()">
                                                <option value="0">ALL</option>

                                                <option value="1">Unblocked</option>
                                                <option value="2">Blocked</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Approval:</label>
                                            <select class="form-select" wire:model='status' wire:change="filter()">
                                                <option value="0">ALL</option>
                                                <option value="1">Not Approved</option>
                                                <option value="2">Half Activation</option>
                                                <option value="3">Full Activation</option>
                                                <option value="4">ER Approved</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Account Type:</label>
                                            <select class="form-select" wire:model='type' wire:change="filter()">
                                                <option value="0">ALL</option>
                                                <option value="1" selected>Main Account</option>
                                                <option value="2">Dummy Account</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Course:</label>
                                            <select class="form-select" wire:change="filter()"
                                                wire:model='selected_course'>
                                                <option value="0">ALL</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <div class="col-lg-2 mb-2 mb-md-0 pt-1">
                                            <button class="btn btn-md btn-soft-danger d-block mt-4"
                                                wire:click="filter()">

                                                <span class="ms-2">SEARCH</span>
                                            </button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <!--  -->
                        <form action="#" class="form-group" id="repeaterAdvanced">
                            <div class="form-group row ">

                                <div class="col-lg-2 mb-2 mb-md-0">
                                    <label class="form-label">Not Activated:</label>
                                    <button class="w-25 btn btn-warning"> </button>
                                </div>
                                <div class="col-lg-2 mb-2 mb-md-0">
                                    <label class="form-label">Half Activated:</label>
                                    <button class="w-25 btn btn-facebook"> </button>
                                </div>
                                <div class="col-lg-2 mb-2 mb-md-0">
                                    <label class="form-label">Full Activated:</label>
                                    <button class="w-25 btn btn-primary"> </button>
                                </div>
                                <div class="col-lg-2 mb-2 mb-md-0">
                                    <label class="form-label">CRP Activated:</label>
                                    <button class="w-25 btn btn-success"> </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                        <div class="card-header d-flex w-100">
                            <h4 class="card-title">Customers</h4>

                            {{-- <div class="ms-auto"> --}}

                            <div class="input-group ms-auto w-25 me-3">
                                <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                                <input type="text" class="form-control" wire:model='search'
                                    wire:input='filter' wire:change='filter()' placeholder="Search here...">
                            </div>

                            {{-- <a href="{{ route('admin.customer.create') }}" class="btn btn-md btn-primary">ADD</a> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                    <div class="card-table table-responsive">

                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Reg No</th>
                                    <th>Points</th>
                                    <th>Wallet</th>
                                    <th>Account Type</th>
                                    <th>Ref Owner</th>
                                    <th>Reg Date</th>
                                    <th>Status</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                        <td>{{ $user->reg_no }}</td>
                                        <td>A1 : {{ $user->left_points }} A2 : {{ $user->right_points }}</td>
                                        <td>{{ $user?->wallet?->balance }}</td>
                                        <td>
                                            @if ($user->type == 'M')
                                                <h6 class="main-color">MAIN</h6>
                                            @elseif ($user->type == 'A1')
                                                <h6 class="dummy-color">DUMMY</h6>
                                            @elseif ($user->type == 'A2')
                                                <h6 class="dummy-color">DUMMY</h6>
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($user->referrer))
                                                {{ $user->referrer?->id }}
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y m d') }}</td>
                                        @if ($user->active_status != 2)
                                            @if ($user->er_status == 1)
                                                <td> <button class=" btn btn-warning"> Not Activated</button></td>
                                            @elseif ($user->er_status == 3)
                                                <td> <button class=" btn btn-primary" type="button"
                                                        wire:click='erActivate({{ $user->id }})'
                                                        wire:confirm="Are you sure you want to Activate ER this customer?">
                                                        Full
                                                        Activated</button></td>
                                            @elseif ($user->er_status == 2)
                                                <td> <button class=" btn btn-facebook"
                                                        wire:click='fullActivate({{ $user->id }})'
                                                        wire:confirm="Are you sure you want to Activate Full this customer?"
                                                        type="button"> Half Activated</button></td>
                                            @elseif ($user->er_status == 4)
                                                <td> <button class=" btn btn-success"> ER Activated</button></td>
                                            @else
                                                <td></td>
                                            @endif
                                        @else
                                            <td> <button class=" btn btn-danger"> BLOCKED</button></td>
                                        @endif
                                        <td>

                                            <a class="btn btn-primary " data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                title="{{ $user->purchase?->course?->name }}"
                                                href='{{ route('admin.customer.edit', $user->id) }}' type="button">
                                                <i class="fi fi-rr-pencil"></i>

                                            </a>
                                            @if ($user->active_status == 1)
                                                <button class="btn btn-danger btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" title="Block"
                                                    wire:click='block({{ $user->id }})'
                                                    wire:confirm="Are you sure you want to block this customer?"
                                                    type="button">
                                                    <i class="fi fi-rr-bell"></i>
                                                </button>
                                            @endif
                                            @if ($user->active_status == 2)
                                                <button class="btn btn-warning btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" title="Unblock"
                                                    wire:click='unblock({{ $user->id }})'
                                                    wire:confirm="Are you sure you want to unblock this customer?"
                                                    type="button">
                                                    <i class="fi fi-br-check"></i>
                                                </button>
                                            @endif
                                            @if ($user->is_tree_enabled)
                                                <button class="btn btn-danger btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" title="Disable Tree"
                                                    wire:click='changeTreeStatus({{ $user->id }})' type="button"
                                                    wire:confirm="Are you sure you want to Disable Tree for this customer?">
                                                    <i class="fi fi-br-checkbox"></i>
                                                </button>
                                            @endif
                                            @if (!$user->is_tree_enabled)
                                                <button class="btn btn-primary btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" title="Enable Tree"
                                                    wire:click='changeTreeStatus({{ $user->id }})' type="button"
                                                    wire:confirm="Are you sure you want to Enable Tree for this customer?">
                                                    <i class="fi fi-sr-checkbox"></i>
                                                </button>
                                            @endif
                                            @if (!$user->approved_by_admin)
                                                <button class="btn btn-danger btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" title="Delete"
                                                    wire:click='delete({{ $user->id }})' type="button"
                                                    wire:confirm="Are you sure you want to Delete this customer?">
                                                    <i class="fi fi-sr-trash"></i>
                                                </button>
                                            @endif
                                            @if (!$user->referrel_enabled && $user->er_status == 3)
                                                <button class="btn btn-primary btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" title="Enable Refferrel"
                                                    wire:click='enableRef({{ $user->id }})' type="button"
                                                    wire:confirm="Are you sure you want to Enable Refferrel this customer?">
                                                    <i class="fi fi-br-check-double"></i>
                                                </button>
                                            @endif
                                            @if ($user->referrel_enabled && $user->er_status == 3)
                                                <button class="btn btn-danger btn-icon" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" title="Disable Refferrel"
                                                    wire:click='enableRef({{ $user->id }})' type="button"
                                                    wire:confirm="Are you sure you want to Disable Refferrel this customer?">
                                                    <i class="fi fi-br-check-double"></i>
                                                </button>
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Reg No</th>
                                    <th>Points</th>
                                    <th>Wallet</th>
                                    <th>Account Type</th>
                                    <th>Ref Owner</th>
                                    <th>Reg Date</th>
                                    <th>Status</th>
                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <div id="pg_id">

                        {{ $customers->links() }}
                    </div>
                    {{-- <div class="flex justify-between">
                        <div class="row mt-1">
                            <div class="col-12"> --}}
                    {{-- </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>

        <style>
            .main-color {
                color: green
            }

            .dummy-color {
                color: orange
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
