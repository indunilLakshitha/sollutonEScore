<!DOCTYPE html>
<!--  Last Published: Sat Jan 11 2025 06:27:08 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="6780ec5a92222feda1dd8a6d" data-wf-site="6744125b4028f712efbe2a96">

<head>
    <meta charset="utf-8">
    <title>Verify OTP</title>
    <meta content="Forget Password" property="og:title">
    <meta content="https://cdn.prod.website-files.com/6744125b4028f712efbe2a96/67820d51bcc1aee9221799ee_equest-og.png"
        property="og:image">
    <meta content="Forget Password" property="twitter:title">
    <meta content="https://cdn.prod.website-files.com/6744125b4028f712efbe2a96/67820d51bcc1aee9221799ee_equest-og.png"
        property="twitter:image">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="{{ asset('home/css/normalize.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('home/css/webflow.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('home/css/eq-site-new-032.webflow.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript">
        ! function(o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n
                .className += t + "touch")
        }(window, document);
    </script>
    <link href="{{ asset('home/images/favicon.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('home/images/webclip.png') }}" rel="apple-touch-icon">
    <style>
        a.w-webflow-badge {
            display: none !important;
        }

        .home-about-wrapper.login-page-form-layout {
            display: flex !important;
            justify-content: center;
            align-items: flex-start;
            width: 100%;
            max-width: 100%;
        }

        .home-about-wrapper.login-page-form-layout .home-about-content-block.is-login {
            flex: 0 1 560px;
            width: 100%;
            max-width: 560px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <main id="top" class="page-wrapper">
        <main class="main-wrapper">
            <section class="home-about-section">
                <div class="section-gap is-registerform">
                    <div class="w-layout-blockcontainer container-default w-container">
                        <div class="home-about-wrapper login-page-form-layout">
                            <div id="w-node-_4504abfe-e50f-4aac-bd0f-ccdd7bb449e9-a1dd8a6d"
                                class="home-about-content-block is-login">
                                <div class="contact-us-form-block">
                                    <div style="text-align: center; margin-bottom: 18px;">
                                        <img src="{{ asset('home/images/Equest-logo.svg') }}" alt="Logo"
                                            style="max-width: 180px; width: 100%; height: auto;">
                                    </div>
                                    <div class="form_field-wrapper" style="text-align: center; margin-bottom: 8px;">
                                        <a href="{{ route('login') }}" class="_14-px-text" style="position: relative; z-index: 2;">Back to login</a>
                                    </div>
                                    <div class="section-title-wrapper center is-low">
                                        <div class="overflow-hidden">
                                            <h2 data-w-id="b95a6cd3-528c-a887-18c6-53b0075de7a1"
                                                style="-webkit-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-moz-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-ms-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform-style:preserve-3d"
                                                class="section-title is-credintail">Verify OTP</h2>
                                        </div>
                                        <div class="overflow-hidden">
                                            <p data-w-id="b95a6cd3-528c-a887-18c6-53b0075de7a4"
                                                style="-webkit-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-moz-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-ms-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform-style:preserve-3d"
                                                class="section-title-except">Please Insert OTP received to Your Mobile
                                                Number.</p>
                                        </div>
                                    </div>
                                    <div class="contact2_form-block w-form">
                                        <form id="wf-form-Registration-Form" name="wf-form-Registration-Form"
                                            data-name="Registration Form" class="contact2_form" method="POST"
                                            action="{{ route('forgotPassword.verify') }}"
                                            data-wf-page-id="6780ec5a92222feda1dd8a6d"
                                            data-wf-element-id="b95a6cd3-528c-a887-18c6-53b0075de7a7">
                                            @csrf
                                            <div class="form_field-wrapper"><label for="email-3"
                                                    class="form_field-label">OTP</label><input
                                                    class="form-input-field w-input" maxlength="256" name="otp"
                                                    data-name="Email 3" placeholder="Enter your OTP ID"
                                                    type="number" id="email-3" required="">

                                                @if ($errors->has('error'))
                                                    <div style="color: red">
                                                        {{ $errors->first('error') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <input class="form-input-field w-input" maxlength="256" name="ref_id"
                                                data-name="Email 3" placeholder="Enter your OTP ID" type="hidden"
                                                value="{{ $ref_id }}">
                                            <div id="w-node-b95a6cd3-528c-a887-18c6-53b0075de7b2-a1dd8a6d"
                                                class="register-margin-top is-login"><input type="submit"
                                                    data-wait="Please wait..."
                                                    id="w-node-b95a6cd3-528c-a887-18c6-53b0075de7b3-a1dd8a6d"
                                                    class="submit-button w-button" value="Reset Password"></div>
                                        </form>
                                        <div class="form_message-success-wrapper w-form-done">
                                            <div class="form_message-success">
                                                <div class="success-text">Thank you! Your submission has been received!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_message-error-wrapper w-form-fail">
                                            <div class="form_message-error">
                                                <div class="error-text">Oops! Something went wrong while submitting the
                                                    form.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        @include('auth.partials.minimal-footer')
    </main>
    <a href="#top" class="scroll-to-top w-inline-block"><img src="{{ asset('home/images/scroll-to-top.svg') }}"
            loading="lazy" alt="Scroll to Top Icon" class="scroll-to-top-icon"></a>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=6744125b4028f712efbe2a96"
        type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    <script src="{{ asset('home/js/webflow.js') }}" type="text/javascript"></script>
</body>

</html>
