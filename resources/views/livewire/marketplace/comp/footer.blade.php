<footer>
    <div class="f-top">
        <div class="container container-240">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <div class="footer-block footer-about">
                        <div class="f-logo">
                            <a href="#"><img src="{{ asset('assets/images/logo-main.png') }}" alt="" class="img-reponsive"></a>
                        </div>
                        <ul class="footer-block-content">
                            <li class="address">
                                <span>45 Grand Central Terminal New York,NY 1017 United State USA</span>
                            </li>
                            <li class="phone">
                                <span>(+123) 456 789 - (+123) 666 888</span>
                            </li>
                            <li class="email">
                                <span>Contact@yourcompany.com</span>
                            </li>
                            <li class="time">
                                <span>Mon-Sat 9:00pm - 5:00pm  &nbsp;&nbsp;&nbsp;  Sun : Closed</span>
                            </li>
                        </ul>
                        <div class="footer-social social">
                            <h3 class="footer-block-title">Follow us</h3>
                            <a href="https://www.facebook.com/equest.lk/" class="fa fa-facebook"></a>
                            <a href="https://www.instagram.com/equest.lk/" class="fa fa-instagram"></a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                    <div class="footer-block">
                        <h3 class="footer-block-title">Categories</h3>
                        <ul class="footer-block-content">
                            @if (isset($categories))
                            @foreach ($categories as $cat)

                                <li><a href="{{ route('marketplace.user.filterByCat', [$cat->slug]) }}">{{ $cat->name }}</a></li>
                            @endforeach
                        @endif

                        </ul>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
                    <div class="footer-block">
                        <h3 class="footer-block-title">Quick Link</h3>
                        <ul class="footer-block-content">
                            <li><a href="#">Shop</a></li>
                            <li><a href="{{ route('profile.index') }}">My Account</a></li>
                            <li><a href="#">Contact</a></li>

                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="footer-block">
                        <div class="footer-block-phone">
                            <h3 class="footer-block-title">Hot Line</h3>
                            <p class="phone-desc">Call Us toll Free</p>
                            <p class="phone-light">(+123) 456 789 or (+123) 666 888</p>
                        </div>
                        <div class="footer-block-newsletter">
                            <h3 class="footer-block-title">Subscription</h3>
                            <p>Register now to get updates on promotions and coupons.</p>
                            <form class="form_newsletter" action="#" method="post">
                                <input type="email" value="" placeholder="Enter your emaill adress" name="EMAIL" id="mail" class="newsletter-input form-control">
                                <a id="subscribe" class="button_mini btn btn-gradient" type="button" href="#">
                                    Subscribe
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="f-bottom">
        <div class="container container-240">
            <div class="row flex lr">
                <div class="col-xs-6 f-copyright"><span></span></div>
                <div class="col-xs-6 f-payment hidden-xs">
                    <a href="#"><img src="{{ asset('market/assets/img/payment/mastercard.png') }}" alt="" class="img-reponsive"></a>
                    <a href="#"><img src="{{ asset('market/assets/img/payment/paypal.png') }}" alt="" class="img-reponsive"></a>
                    <a href="#"><img src="{{ asset('market/assets/img/payment/visa.png') }}" alt="" class="img-reponsive"></a>
                    <a href="#"><img src="{{ asset('market/assets/img/payment/american-express.png') }}" alt="" class="img-reponsive"></a>
                    <a href="#"><img src="{{ asset('market/assets/img/payment/western-union.png') }}" alt="" class="img-reponsive"></a>
                    <a href="#"><img src="{{ asset('market/assets/img/payment/jcb.png') }}" alt="" class="img-reponsive"></a>
                </div>
            </div>
        </div>
    </div>
</footer>
