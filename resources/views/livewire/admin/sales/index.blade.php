<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="Sales" section="Admin" sub="Sales" action="All">
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
                                            <select class="form-select" wire:model='selected_payment'
                                                wire:change='filter()'>
                                                <option value="0">ALL</option>
                                                <option value="3">Non Paid</option>
                                                <option value="1">Half Paid</option>
                                                <option value="2">Full Paid
                                                </option>

                                            </select>
                                        </div>

                                        {{-- <div class="col-lg-2 mb-2 mb-md-0 pt-1">
                                            <a href="javascript:void(0);" wire:click='filter()'
                                                class="btn btn-md btn-soft-danger d-block mt-4">

                                                <span class="ms-2">SEARCH</span>
                                            </a>
                                        </div> --}}
                                    </div>
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
                        <div class="card-header">
                            <h4 class="card-title">Sales</h4>
                        </div>
                        <div class="card-header">
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="dataTablesExportCustomer" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $index => $course)
                                    <tr>
                                        <td>{{ $index +1 }}</td>
                                        <td>{{ $course->created_at }}</td>
                                        <td>{{ $course->user_name }}</td>
                                        <td>{{ $course->course_name }}</td>

                                        <td>{{ number_format($course->course_price, 2) }}</td>
                                        <td>
                                            @if ($course->purchased_percent == 1)
                                                HALF
                                            @elseif($course->purchased_percent == 2)
                                                FULL
                                            @endif
                                        </td>
                                        <td>
                                            @if ($course->purchased_percent == 1)
                                                {{ number_format($course->course_price / 2, 2) }}
                                            @elseif($course->purchased_percent == 2)
                                                0
                                            @endif
                                        </td>



                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Balance</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
</div>
