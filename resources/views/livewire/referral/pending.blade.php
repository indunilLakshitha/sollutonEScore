<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="Not Approved" section="User" sub="My Team" action="Not Approved">
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
                                            <select class="form-select" wire:model='selected_course'
                                                wire:change='filter()'>
                                                <option value="">ALL</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
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
                            <h4 class="card-title">Referrals Not Approved</h4>
                        </div>
                        <div class="card-header">
                            {{-- <a href="{{ route('admin.customer.create') }}" class="btn btn-md btn-primary">ADD</a> --}}
                        </div>
                    </div>
                    <div class="card-table table-responsive">

                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Reg No</th>
                                    <th>Reg Date</th>
                                    <th>Contact No</th>
                                    <th>Selected Course</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td></td>
                                        <td>{{ $user->reg_no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y m d') }}</td>
                                        <td>{{ $user->mobile_no }}</td>
                                        <td>{{ $user->purchase?->course?->name }}</td>

                                        <td>

                                            <a class="btn btn-primary"
                                                href="{{ route('referrals.approve', $user->id) }}" type="button">
                                                APPROVE
                                            </a>
                                            <button class="btn btn-danger" wire:click='delete({{ $user->id }})'
                                                wire:confirm="Are you sure you want to Delete this customer?"
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
                                    <th>Reg No</th>
                                    <th>Reg Date</th>
                                    <th>Contact No</th>
                                    <th>Selected Course</th>
                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
</div>
