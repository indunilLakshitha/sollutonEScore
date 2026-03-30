<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="COMMISION" section="Admin" sub="CommisCommisionsion" action="All">
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
                                            <label class="form-label">Payment Status:</label>
                                            <select class="form-select" wire:model='selected_category'>
                                                <option>--select--</option>

                                            </select>
                                        </div>

                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Commision Type:</label>
                                            <select class="form-select" wire:model='selected_category'>
                                                <option>--select--</option>

                                            </select>
                                        </div>

                                        <div class="col-lg-2 mb-2 mb-md-0 pt-1">
                                            <a href="javascript:void(0);" wire:click='filter()'
                                                class="btn btn-md btn-soft-danger d-block mt-4">

                                                <span class="ms-2">SEARCH</span>
                                            </a>
                                        </div>
                                    </div>
                                    < </div>
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
                        <div class="card-header">
                            <h4 class="card-title">Commisions</h4>
                        </div>
                        <div class="card-header">
                            <a href="{{ route('admin.commission.generate') }}" class="btn btn-md btn-primary">GENERATE</a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Customer No</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comissions as $comission)
                                    <tr>
                                        <td>{{ $comission->id }}</td>
                                        <td>{{ $comission->owner?->name }}</td>
                                        <td>{{ $comission->given?->name }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td>
                                            {{-- <a class="btn btn-primary"
                                                href="{{ route('admin.course.edit', $course->id) }}" type="button">
                                                EDIT
                                            </a> --}}


                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Customer No</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
</div>
