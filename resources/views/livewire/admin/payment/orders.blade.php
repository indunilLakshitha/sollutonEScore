<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="ORDER" section="Order" sub="History" action="All">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">

            <!-- Start:: Zero Config -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Orders</h4>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Course Name</th>
                                    <th>User Name</th>
                                    <th>Paid At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $course)
                                    <tr>
                                        <td>{{ $course?->id }}</td>
                                        <td>{{ $course?->course?->name }}</td>
                                        <td>{{ $course?->user?->name }}</td>
                                        <td>{{ $course?->created_at }}</td>
                                        <td>
                                            @if ($course?->status == 1)
                                                <span class="badge bg-warning ms-1 rounded-pill">APPLIED</span>
                                            @elseif($course?->status == 2)
                                                <span class="badge bg-primary ms-1 rounded-pill">APPROVED</span>
                                            @else
                                                <span class="badge bg-danger ms-1 rounded-pill">CANCELED</span>
                                            @endif
                                        </td>


                                        <td>

                                            @if ($course?->status != 2)
                                                <button class="btn btn-primary"
                                                    wire:click='approve({{ $course?->id }})' type="button">
                                                    APPROVE
                                                </button>
                                                <button class="btn btn-danger" wire:click='cansel({{ $course?->id }})'
                                                    type="button">
                                                    CANCEL
                                                </button>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Course Name</th>
                                    <th>User Name</th>
                                    <th>Paid At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->

        </div>
</div>
