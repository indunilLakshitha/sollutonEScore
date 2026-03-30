<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="COURSES" section="User" sub="Course" action="Purchase">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">


            <!-- Start:: Sink Card -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Purchase Course - Direct Bank Transfer</h4>
                    </div>
                    <div class="card-body">

                        <div class="row g-4">

                            <div class="col-lg-4">
                                <div class="card">
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top"
                                        width="250px" alt="..." />
                                    <div class="card-body">
                                        <h5 class="card-title mb-2">
                                            {{ $course->name }}
                                        </h5>
                                        <p class="card-text">
                                            PAYMENT AMOUNT ( Rs ) : {{ $amount }}
                                        </p>
                                        <p class="card-text">
                                            Please Transfer to Below account and send the Slip
                                        </p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <dl class="dl-horizontal mb-0">
                                                <dt>Name :</dt>
                                                <dd>{{ $adminBankDetails?->holder_name }}</dd>
                                                <dt>Branch :</dt>
                                                <dd>{{ $adminBankDetails?->branch }}</dd>
                                                <dt>ACC No :</dt>
                                                <dd>{{ $adminBankDetails?->account_number }}</dd>
                                                <dt>Bank :</dt>
                                                <dd>{{ $adminBankDetails?->bank_name }}</dd>
                                            </dl>
                                        </li>

                                    </ul>
                                    <div class="card-body">

                                        <button type="button" wire:click='purchase()'
                                            class="card-link btn rounded-pill btn-primary">CONFIRM
                                            PURCHASED</button>


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: Sink Card -->



        </div>
</div>
