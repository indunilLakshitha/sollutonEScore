<div>
    <div class="w-layout-grid header37_component">
        <div id="w-node-_127afa0e-fe33-f29d-5999-64604b7d7761-b7f1bb90" class="header37_image-wrapper is-success-msg"><img
                sizes="(max-width: 767px) 99.984375px, (max-width: 991px) 149.984375px, 219.984375px"
                srcset="{{ asset('home/images/white-p-500.png') }} 500w, {{ asset('home/images/white-p-800.png') }} 800w, {{ asset('home/images/white-p-1080.png') }} 1080w, {{ asset('home/images/white.png') }} 1893w"
                alt="" src="{{ asset('home/images/white.png') }}" loading="eager" class="header37_logo">
            <div class="text-color-white center">The Business of the 21<sup>st</sup>  Century<br></div>
        </div>
        <div id="w-node-_127afa0e-fe33-f29d-5999-64604b7d7763-b7f1bb90" class="header37_content-2">
            <div class="margin-bottom margin-small">
                <h1 class="section-title">Thank you!</h1>
            </div>
            <div class="margin-top-2rem">
                <p class="text-size-regular">Dear, {{ $user->first_name }},</p>
            </div>
            <div>
                <p class="text-size-regular">Welcome to Equest Institute of Higher Education</p>
            </div>
            <div class="margin-top-2rem">
                <p class="text-size-regular">You have successfully registered for the
                    <strong>{{ $course->name }}</strong>. Please deposit total of
                    <strong>{{env('CURRENCY')}}{{ number_format($course->course_price, 2) }}</strong> to
                    below bank account.
                </p>
            </div>
            <div class="margin-top-2rem">
                <div class="bank-account-details-wrapper">
                    <div class="bank-account-details-row">
                        <p class="text-size-regular">Account No</p>
                        <p class="text-size-regular text-bold">{{ env('ACC_NUMBER') }}</p>
                    </div>
                    <div class="bank-account-details-row">
                        <p class="text-size-regular">Name</p>
                        <p class="text-size-regular text-bold">{{ env('ACC_NAME') }}</p>
                    </div>
                    <div class="bank-account-details-row">
                        <p class="text-size-regular">Bank</p>
                        <p class="text-size-regular text-bold">{{ env('ACC_BANK') }}</p>
                    </div>
                    <div class="bank-account-details-row">
                        <p class="text-size-regular">Branch</p>
                        <p class="text-size-regular text-bold">{{ env('ACC_BRANCH') }}</p>
                    </div>
                    <div class="bank-account-details-row">
                        <p class="text-size-regular">Registration Number</p>
                        <p class="text-size-regular text-bold">{{ $user->id }}</p>
                    </div>
                </div>
            </div>
            <div class="margin-top-2rem">
                <p class="text-size-regular">The eQuest Support Team</p>
            </div>
            <div class="margin-top-2rem">
                <p class="text-size-regular">If you have any inquiries, please feel free to contact us at
                    info@equest.lk<br></p>
            </div>
            <div class="margin-top-2rem">
                <div class="button-group">
                    <a data-w-id="f8f822a0-17fa-e3f6-9367-b9101ca1a787"
                        style="-webkit-transform:translate3d(-80px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(-80px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(-80px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(-80px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                        href="#" class="primary-button w-inline-block">
                        <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                            class="button-icon-wrapper two">
                            <div class="button-icon w-embed"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" viewbox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                        fill="#091E42"></path>
                                    <path
                                        d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                        fill="#091E42"></path>
                                </svg></div>
                            <div class="button-bg"></div>
                        </div>
                        <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                            class="button-text">Back To Home</div>
                        <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                            class="button-icon-wrapper one">
                            <div class="button-icon w-embed"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" viewbox="0 0 16 16" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                        fill="#091E42"></path>
                                    <path
                                        d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                        fill="#091E42"></path>
                                </svg></div>
                            <div class="button-bg"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
