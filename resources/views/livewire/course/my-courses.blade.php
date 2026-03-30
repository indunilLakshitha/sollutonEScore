<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="MY COURSES" section="User" sub="Courses" action="My">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">

            <!-- Start:: Zero Config -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">My Courses</h4>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Total ( {{ env('CURRENCY') }})</th>
                                    <th>Paid ( {{ env('CURRENCY') }})</th>
                                    <th>Balance ( {{ env('CURRENCY') }})</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $course->course?->name }}</td>

                                        <td>{{ number_format($course->course?->course_price, 2) }}</td>
                                        <td>
                                            @if ($course->purchased_percent == 1)
                                                {{ number_format($course->course?->installment_1, 2) }}
                                            @elseif ($course->purchased_percent == 2)
                                                {{ number_format($course->course?->course_price, 2) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($course->purchased_percent == 1)
                                                {{ number_format($course->course?->installment_2, 2) }}
                                            @elseif ($course->purchased_percent == 2)
                                                0
                                            @endif
                                        </td>
                                        <td>{{ $course->created_at }}</td>
                                        <td>

                                            @if (isset($course->approved_at))
                                                <span class="badge bg-primary ms-1 rounded-pill"> APPROVED</span>
                                            @else
                                                <span class="badge bg-warning ms-1 rounded-pill"> PENDING</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($course->purchased_percent == 1)
                                                {{-- <a class="btn btn-primary"
                                                    href="{{ route('course.view', $course->id) }}" type="button">
                                                    PAY
                                                </a> --}}
                                                <button type="button" wire:click='payAlert()'
                                                    class="btn btn-md btn-success">PAY
                                                </button>

                                                <button class="btn btn-primary d-none" type="hidden" id="payFull"
                                                    wire:click='payFull({{ $course->id }})'>
                                                    FULL
                                                </button>
                                                <button class="btn btn-primary d-none" type="hidden" id="payHalf"
                                                    wire:click='payHalf({{ $course->id }})'>
                                                    Half
                                                </button>
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Total ( {{ env('CURRENCY') }})</th>
                                    <th>Paid ( {{ env('CURRENCY') }})</th>
                                    <th>Balance ( {{ env('CURRENCY') }})</th>
                                    <th>Date</th>
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
<script>
    window.addEventListener('selects_alert', function(e) {

        Swal.fire({
            title: "Purchase As Full",
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: "Purchase",
            denyButtonText: `FULL`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                document.getElementById("payFull").click();

            } else if (result.isDenied) {
                document.getElementById("payFull").click();
            }
        });
    });
</script>
