<div>
    <livewire:comp.breadcumb title="COMMISION" section="Admin" sub="Commision" action="Generate">
        <div>
            <!--! Start:: Content Section !-->
            <div class="edash-page-container container-xxl" id="edash-page-container">
                <!--! Start:: Content Section !-->
                <div class="edash-content-section">
                    <div class="d-flex gap-3 gap-md-4">

                        <!-- End:: edash-settings-aside -->
                        <!-- Start:: edash-settings-content -->
                        <div class="edash-settings-content card w-100 overflow-hidden">
                            <div class="card-header ">
                                <h4 class="card-title">Generate</h4>
                            </div>

                            <!--! Start:: settings-content-header !-->
                            <!--! End:: settings-content-header !-->
                            <div class="card-body mt-0 mb-0 ">
                                <div class="col-6">
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <form wire:submit="generateCommision" class="mt-0 mb-0 p-0">

                                    <!--! End:: profile-avatar !-->
                                    <hr class="my-12 border-top-dashed" />
                                    <!--! Start:: personal-info !-->
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Generate Commission Password</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control" wire:model='password'
                                                placeholder="Password" />
                                        </div>
                                        @error('password')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <hr class="my-12 border-top-dashed" />
                                    <!--! Start:: action-button !-->
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">

                                            <button class="btn btn-primary" type="submit">
                                                GENERATE
                                            </button>
                                        </div>
                                    </div>
                                    <!--! End:: action-button !-->

                                </form>
                            </div>
                        </div>
                        <!-- End:: edash-settings-content  -->
                    </div>
                </div>
                <!--! End:: Content Section !-->
            </div>
            <!--! End:: Content Section !-->
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-header">
                            <h4 class="card-title">History</h4>
                        </div>
                        <div class="card-header">

                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Run By</th>
                                    <th>Started At</th>
                                    <th>Ended At</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($history as $index => $comission)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $comission->user->name }}</td>

                                        <td>{{ $comission->started_at }}</td>
                                        <td>{{ $comission->ended_at }}</td>
                                        <td>
                                            @if ($comission->status == 1)
                                                <span class="badge bg-danger ms-1 rounded-pill">COMPLETED</span>
                                            @elseif ($comission->status == 2)
                                                <span class="badge bg-primary ms-1 rounded-pill">FAILED</span>
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Run By</th>
                                    <th>Started At</th>
                                    <th>Ended At</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
