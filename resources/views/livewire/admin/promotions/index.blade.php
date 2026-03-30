<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="RANKING" section="Admin" sub="Ranking" action="List">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Filter -->
            {{-- <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <!--  -->
                        <form action="#" class="form-group" id="repeaterAdvanced">
                            <div data-repeater-list="repeater-advanced">
                                <div data-repeater-item>
                                    <div class="form-group row mb-4">

                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Course Category:</label>
                                            <select class="form-select">
                                                <option>--select--</option>
                                                <option value="">*</option>
                                                <option value="">Unblocked</option>
                                                <option value="">Blocked</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-2 mb-2 mb-md-0 pt-1">
                                            <a href="javascript:void(0);"
                                                class="btn btn-md btn-soft-danger d-block mt-4">

                                                <span class="ms-2">SEARCH</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
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
                        <div class="card-header">
                            <h4 class="card-title">Rankings</h4>
                        </div>
                        <div class="input-group ms-auto w-25 me-3">
                            <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                            <input type="text" class="form-control" wire:model='search'
                                wire:input='filter' wire:change='filter()' placeholder="Search here...">
                        </div>
                        <div class="card-header">
                            <a href="{{ route('admin.promotions.create') }}" class="btn btn-md btn-primary">ADD</a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Sales Target</th>
                                    <th>Income Target</th>
                                    <th>Reward</th>
                                    <th>Criteria</th>
                                    <th>Required Rankings</th>
                                    <th>Status</th>
                                    <th>Added By</th>
                                    <th>Created At</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promotions as $promo)
                                    <tr>
                                        <td>{{ $promo->id }}</td>
                                        <td>{{ $promo->name }}</td>
                                        <td>
                                            {{ $promo->sales_target }}
                                            {{-- <span class="badge bg-info">
                                                @if($promo->sales_target_type == 1)
                                                    Monthly
                                                @elseif($promo->sales_target_type == 2)
                                                    Yearly
                                                @else
                                                    Total
                                                @endif
                                            </span> --}}
                                        </td>
                                        <td>
                                            {{ $promo->income_target }}
                                            {{-- <span class="badge bg-info">
                                                @if($promo->income_target_type == 1)
                                                    Monthly
                                                @elseif($promo->income_target_type == 2)
                                                    Yearly
                                                @else
                                                    Total
                                                @endif
                                            </span> --}}
                                        </td>
                                        <td>
                                            @if($promo->reward_name)
                                                <div class="fw-semibold text-success">
                                                    {{ $promo->reward_name }}
                                                </div>
                                                <small class="text-muted">
                                                    Downline: {{ $promo->downline_count }} | Sales: {{ $promo->direct_sale_count }}
                                                </small>
                                            @else
                                                <span class="text-muted">No reward</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($promo->criteria->count() > 0)
                                                @foreach($promo->criteria as $criteria)
                                                    <div class="badge bg-info mb-1">
                                                        {{ $criteria->name }} ({{ $criteria->pivot->required_count }})
                                                    </div>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No criteria</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($promo->requiredPromotions->count() > 0)
                                                @foreach($promo->requiredPromotions as $requiredPromotion)
                                                    <div class="badge bg-warning mb-1">
                                                        {{ $requiredPromotion->name }} ({{ $requiredPromotion->pivot->required_count }})
                                                    </div>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No required rankings</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($promo->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $promo->addedBy->name ?? 'N/A' }}</td>
                                        <td>{{ $promo->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('admin.promotions.edit', $promo->id) }}"
                                                type="button">
                                                EDIT
                                            </a>
                                            <button class="btn btn-danger btn-sm" wire:click='delete({{ $promo->id }})'
                                                wire:confirm="Are you sure you want to Delete this Promotion?"
                                                type="button">
                                                DELETE
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Sales Target</th>
                                    <th>Income Target</th>
                                    <th>Reward</th>
                                    <th>Criteria</th>
                                    <th>Required Rankings</th>
                                    <th>Status</th>
                                    <th>Added By</th>
                                    <th>Created At</th>
                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">
                        {{ $promotions->links() }}
                    </div>
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
