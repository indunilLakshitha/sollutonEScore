<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="COURSES" section="User" sub="Courses" action="All">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">

            <div class="modal fade" id="paymentModel" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Payment Method
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="ml-5 mr-5">
                            <label for="radio-card-example4-2" class="radio-card">
                                <span class="radio-card-wrapper d-flex gap-4 align-items-start ">
                                    <span class="wd-80 ht-80">
                                        <img src="./../assets/images/brand/2.svg" alt="" class="img-fluid"
                                            id="model_course_image" />
                                    </span>
                                    <span class="radio-card-content">
                                        <span class="radio-card-title d-flex justify-content-between">
                                            <span>
                                                <span class="fw-semibold text-dark" id="model_course_name">
                                                </span>
                                                -{{env('CURRENCY')}} : <span class="radio-card-price fw-semibold text-dark mt-3"
                                                    id="model_course_price">
                                                </span>
                                            </span>
                                            <span class="check-icon"></span>
                                        </span>
                                        <span class="radio-card-desc">Selected Course</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="modal-body" id="payment_section">
                            <div id="payment_method_area">
                                Please select Payment method from below
                                <div class="mt-5" id="payment_method_area">
                                    <div class="col-lg-4">
                                        <label for="radio-card-example1-1" class="">
                                            <input id="radio-card-example1-1" type="radio" value="1"
                                                onchange="payByWallet()" name="radio-card-example1" />
                                            Pay By Wallet ({{ number_format($walletBalance, 2) }})
                                        </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="radio-card-example1-1" class="">
                                            <input id="radio-card-example1-1" type="radio" value="2"
                                                onchange="directBank()" name="radio-card-example1" />
                                            Direct Bank Deposite
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer" id="md-submit-area">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Close
                            </button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Start:: Sink Card -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Courses</h4>
                    </div>
                    <div class="card-body">

                        <div class="row g-4">
                            @foreach ($courses as $course)
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $course->thumbnail) }}" class="card-img-top"
                                            width="250px" alt="..." />
                                        <div class="card-body">
                                            <h5 class="card-title mb-2">
                                                {{ $course->name }}
                                            </h5>
                                            {{-- <p class="card-text">
                                                {!! $course->description !!}
                                            </p> --}}
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <dl class="dl-horizontal mb-0">

                                                    <dt>Course Points:</dt>
                                                    <dd>{{ $course->course_point }}</dd>
                                                    <dt>Installments:</dt>
                                                    <dd>{{env('CURRENCY')}}{{ number_format($course->installment_1, 2) }}<br>
                                                        {{env('CURRENCY')}} {{ number_format($course->installment_2, 2) }}</dd>
                                                    <dt>Course Price:</dt>
                                                    <dd>{{env('CURRENCY')}}{{ number_format($course->course_price, 2) }}</dd>


                                                </dl>
                                            </li>

                                        </ul>
                                        <div class="card-body">
                                            <a href="{{ route('course.view', $course->id) }}"
                                                class="card-link btn rounded-pill btn-primary"> View Course</a>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#paymentModel"
                                                @click="setCourse({{ $course }})"
                                                class=" btn rounded-pill btn-danger">Purchase</button>

                                            {{-- <button type="button" wire:click='payAlert()'
                                                class="card-link btn rounded-pill btn-softtext-danger">PURCHASE</button> --}}

                                            <button class="btn btn-primary d-none" type="hidden" id="payFull"
                                                wire:click='payFull({{ $course->id }})'>
                                                FULL
                                            </button>
                                            <button class="btn btn-primary d-none" type="hidden" id="payHalf"
                                                wire:click='payHalf({{ $course->id }})'>
                                                Half
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: Sink Card -->

        </div>
        <style>
            card-img,
            .card-img-top,
            .card-img-bottom {
                width: 100% !important;
                height: 300px !important;
                object-fit: cover;
            }
        </style>
</div>
<script>
    let selected_course, method;
    window.addEventListener('selects_alert', function(e) {

        Swal.fire({
            title: "Purchase As",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Pay As Installments",
            denyButtonText: `Pay Full`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                document.getElementById("payHalf").click();

            } else if (result.isDenied) {
                document.getElementById("payFull").click();
            }
        });
    });

    function setCourse(course) {
        selected_course = course;
        var name = document.getElementById('model_course_name');
        name.textContent = course.name;
        var price = document.getElementById('model_course_price');
        price.textContent = course.course_price;
        let img = document.getElementById('model_course_image');
        img.src = '/storage/' + course.thumbnail;

    }

    function payByWallet() {
        method = 1;
        // document.getElementById('payment_percent_area').className -= 'd-none';
        // document.getElementById('payment_method_area').className += 'd-none';
        addBack();
        showPaymentPercentArea();
    }

    function directBank() {
        method = 2;
        // document.getElementById('payment_percent_area').className -= 'd-none';
        // document.getElementById('payment_method_area').className += 'd-none';
        showPaymentPercentArea();
        addBack();

    }

    function showPaymentMethodArea() {
        document.getElementById('payment_section').innerHTML = `
                                <div id="payment_method_area">
                                Please select Payment method from below
                                <div class="mt-5" id="payment_method_area">
                                    <div class="col-lg-4">
                                        <label for="radio-card-example1-1" class="">
                                            <input id="radio-card-example1-1" type="radio" value="1"
                                                onchange="payByWallet()" name="radio-card-example1"  />
                                            Pay By Wallet ({{ $walletBalance }})
                                        </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="radio-card-example1-1" class="">
                                            <input id="radio-card-example1-1" type="radio" value="2"
                                                onchange="directBank()" name="radio-card-example1" />
                                            Direct Bank Deposite
                                        </label>
                                    </div>
                                </div>
                            </div>
                            `;
    }

    function showPaymentPercentArea() {
        document.getElementById('payment_section').innerHTML = `
                                <div id="payment_percent_area" >Purchase As
                                <div class="mt-5">
                                    <div class="col-lg-4">
                                        <label for="radio-card-example1-1" class="">
                                            <input id="radio-card-example1-1" type="radio" value="1"
                                                onchange="payAsInstallmentActivate()" name="radio-card-example1"
                                                 />
                                            Pay as Installments
                                        </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="radio-card-example1-1" class="">
                                            <input id="radio-card-example1-1" type="radio" value="2"
                                                onchange="payFullActivate()" name="radio-card-example1" />
                                            Pay Full
                                        </label>
                                    </div>
                                </div>
                            </div>
                            `;
    }

    function clickBack() {


        showPaymentMethodArea();
        // document.getElementById('payment_percent_area').className += 'd-none';
        // document.getElementById('payment_method_area').className -= 'd-none';
    }

    function addBack() {
        document.getElementById('md-submit-area').innerHTML = `

         </button><button type="button" @click="clickBack()" class="btn btn-danger">
                                Back
                            </button>
                             </button><button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Close
                            </button>
                            `;
    }

    function payAsInstallments() {
        window.location.replace('/dashboard/course/' + selected_course.id + '/pay/' + method + '/1');

    }

    function payFull() {
        window.location.replace('/dashboard/course/' + selected_course.id + '/pay/' + method + '/2');

    }

    function payAsInstallmentActivate() {

        document.getElementById('md-submit-area').innerHTML = `
        <button type="button" id="btn-pay-half" class="btn btn-primary"
                 onclick='payAsInstallments()'>
                     NEXT
         </button>
         <button type="button" @click="clickBack()" class="btn btn-danger">
        Back
        </button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Close
        </button>
                            `;

    }

    function payFullActivate() {

        document.getElementById('md-submit-area').innerHTML =
            `
          <button type="button" id="btn-pay-full" class="btn btn-primary" onclick='payFull()'>
            NEXT
           </button>
            </button><button type="button" @click="clickBack()" class="btn btn-danger">
             Back
            </button>
             <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Close
        </button>
        `;
    }
</script>
