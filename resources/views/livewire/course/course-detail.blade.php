<div class="edash-page-container container-xxl" id="edash-page-container">
    <!--! Start:: Content Section !-->
    <div class="edash-content-section overflow-hidden">
        <div class="modal fade" id="paymentModel" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Payment Method
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            -Rs. : <span class="radio-card-price fw-semibold text-dark mt-3"
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
        <!-- Start:: profile-header-card -->
        <div class="card mb-3 mb-md-4">
            <div class="card-body">
                <!-- Start:: profile-cover -->
                <div class="edash-profile-cover">
                    <div class="ht-100 mb-32 mb-md-24 position-relative rounded-4"
                        style="
                      background-image: {{ asset('storage/' . $course->thumbnail) }};
                      background-size: cover;
                      background-repeat: no-repeat;
                    ">
                        <div
                            class="w-100 p-4 mt-10 mt-md-4 mt-lg-0 d-md-flex align-items-end gap-4 text-center text-md-start position-absolute translate-middle-y top-100 z-3">
                            <!--! Start:: profile-cover-left !-->
                            <div class="d-md-flex align-items-end gap-4">
                                <div class="wd-lg-150 wd-100 mx-auto mx-md-0">

                                    <img alt=""src="{{ asset('storage/' . $course->thumbnail) }}"
                                        class="img-fluid img-thumbnail" />
                                </div>
                                <div class="mb-5 mb-md-2 mt-4 mt-md-0">
                                    <h5 class="mb-2">
                                        {{ $course->name }}
                                        {{-- <small
                                            class="fs-13 fw-medium text-muted mx-2">@alex_della</small> --}}
                                    </h5>
                                    <div class="d-flex justify-content-center justify-content-md-start gap-3">
                                        <span class="fs-13 fw-medium">
                                            @if (isset($course->display_price))
                                                <span class="fw-semibold text-dark">{{env('CURRENCY')}}{{ $course->display_price }}</span>
                                            @else
                                                <span
                                                    class="fw-semibold text-dark">{{env('CURRENCY')}}{{ number_format($course->course_price, 2) }}</span>
                                            @endif
                                        </span>
                                        <span class="fs-13 fw-medium">
                                            @if (isset($course->display_price))
                                                <span
                                                    class="fw-semibold text-dark"><s>{{env('CURRENCY')}}{{ number_format($course->course_price, 2) }}</s></span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--! End:: profile-cover-left !-->
                            <!--! Start:: profile-cover-right !-->
                            <div
                                class="d-none d-md-flex align-items-end justify-content-center justify-content-md-end gap-1 mb-md-2 ms-md-auto">
                                {{-- <a href="javascript:void(0);" class="btn btn-md btn-light">Follow</a> --}}
                                <button type="button" class="btn btn-md btn-success" data-bs-toggle="modal"
                                    data-bs-target="#paymentModel" @click="setCourse({{ $course }})">PAY
                                </button>


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
                        <!--! End:: profile-cover-right !-->
                    </div>
                </div>
                <!-- End:: profile-cover -->
            </div>

        </div>
        <!-- End:: profile-header-card -->
        <!-- Start:: profile-overview -->
        <div class="row g-3 g-md-4">
            <!--! Start:: col !-->
            <div class="col-md-6 col-lg-5 col-xl-6 col-xxl-5 col-xxxl-4">

                <!--! Start:: card-about !-->
                <div class="card mb-3 mb-md-4">
                    <div class="card-body">
                        <div class="hstack gap-4 justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-0">About</h5>
                            <a href="javascript:void(0);" class="btn btn-icon-md btn-icon btn-light"
                                data-bs-toggle="tooltip" data-bs-trigger="hover" title="About Informations">
                                <i class="fi fi-rr-info"></i>
                            </a>
                        </div>
                        <dl class="dl-horizontal mb-0">
                            <dt>Installment 1:</dt>
                            <dd>{{env('CURRENCY')}}{{ number_format($course->installment_1, 2) }}</dd>
                            <dt>Installment 2:</dt>
                            <dd>{{env('CURRENCY')}}{{ number_format($course->installment_2, 2) }}</dd>

                        </dl>
                    </div>
                </div>
                <!--! End:: card-about !-->
                <!--! Start:: card-skills !-->
                {{-- <div class="card mb-3 mb-md-4">
                    <div class="card-body">
                        <div class="hstack gap-4 justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-0">Skills</h5>
                            <a href="javascript:void(0);" class="btn btn-icon-md btn-icon btn-light"
                                data-bs-toggle="tooltip" data-bs-trigger="hover" aria-label="Add More"
                                data-bs-original-title="Add More">
                                <i class="fi fi-rr-add"></i>
                            </a>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="javascript:void(0);"
                                class="py-1 px-2 border border-dashed rounded-pill fs-13">Frontend</a>
                            <a href="javascript:void(0);"
                                class="py-1 px-2 border border-dashed rounded-pill fs-13">Bootstrap</a>


                        </div>
                    </div>
                </div> --}}
                <!--! End:: card-skills !-->
                <!--! Start:: card-social !-->
                {{-- <div class="card mb-0">
                    <div class="card-body">
                        <div class="hstack gap-4 justify-content-between mb-4">
                            <h5 class="card-title fw-semibold mb-0">Social</h5>
                            <a href="javascript:void(0);" class="btn btn-icon-md btn-icon btn-light"
                                data-bs-toggle="tooltip" data-bs-trigger="hover" aria-label="Add More"
                                data-bs-original-title="Add More">
                                <i class="fi fi-rr-add"></i>
                            </a>
                        </div>
                        <div class="hstack gap-2">
                            <a href="javascript:void(0);" class="btn btn-icon rounded text-white"
                                style="background: #3b5998">
                                <i class="fi fi-brands-facebook"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-icon rounded text-white"
                                style="background: #1da1f2">
                                <i class="fi fi-brands-twitter"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-icon rounded text-white"
                                style="background: #0e76a8">
                                <i class="fi fi-brands-linkedin"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-icon rounded text-white"
                                style="background: #c4302b">
                                <i class="fi fi-brands-youtube"></i>
                            </a>
                            <a href="javascript:void(0);" class="btn btn-icon rounded text-white"
                                style="background: #333333">
                                <i class="fi fi-brands-github"></i>
                            </a>
                        </div>
                    </div>
                </div> --}}
                <!--! End:: card-social !-->
            </div>
            <!--! End:: col !-->
            <!--! Start:: col !-->
            <div class="col-md-6 col-lg-7 col-xl-6 col-xxl-7 col-xxxl-8">
                <!--! Start::  card-bio !-->
                <div class="card mb-3 mb-md-4">
                    <div class="card-body">
                        <div class="hstack gap-4 justify-content-between mb-6">
                            <h5 class="card-title fw-semibold mb-0">Description</h5>
                            <a href="javascript:void(0);" class="btn btn-icon-md btn-icon btn-light"
                                data-bs-toggle="tooltip" data-bs-trigger="hover" title="Update Bio">
                                {{-- <i class="fi fi-rr-pen-nib"></i> --}}
                            </a>
                        </div>
                        <p class="card-text">
                            {!! $course->description !!}
                        </p>

                    </div>
                </div>
                <!--! End:: card-bio !-->
            </div>
            <!--! End:: col !-->
        </div>
        <!-- End:: profile-overview -->
    </div>
    <!--! End:: Content Section !-->
</div>
<script>
    window.addEventListener('selects_alert', function(e) {

        Swal.fire({
            title: "Purchase As",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "HALF",
            denyButtonText: `FULL`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                document.getElementById("payHalf").click();

            } else if (result.isDenied) {
                document.getElementById("payFull").click();
            }
        });
    });

    let selected_course, method;

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
