<x-guest-layout>
    @section('title', 'Login')

    {{-- <x-validation-errors class="mb-4" /> --}}

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <main class="min-vh-100 overflow-y-auto d-flex flex-column justify-content-center px-4 m-0" id="edash-main">
        <div class="card max-wd-400 max-wd-sm-450 mx-auto my-5 bg-body-tertiary">
            <div class="card-body p-sm-8 p-4 ">
                <a href="#" class="edash-logo image">
                    <img src="{{ asset('assets/images/logo-main.png') }}" alt="logo"
                        class="img-fluid edash-logo-main image" />
                </a>
                <h4 class="mb-2 fw-semibold">Login to your account</h4>
                <p class="fs-13 fw-medium text-muted mb-6">

                </p>
                <form method="POST" action="{{ route('login') }}">
                    @error('email')
                        <div style="color: red">
                            {{ $message }}
                        </div>
                    @enderror
                    @csrf
                    <div class="mb-4">
                        <input type="text" id="reg_no" type="reg_no" name="reg_no" :value="old('reg_no')"
                            required autofocus autocomplete="reg_no" class="form-control" placeholder="Reg No"
                            required />
                        {{-- @error('email')
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">

                                <li>{{ $error }}</li>

                            </ul>
                        @enderror --}}
                        <input type="hidden" id="email" type="email" name="email" :value="old('email')"
                            value="test@gmail.com" autofocus autocomplete="username" class="form-control"
                            placeholder="Email" required />
                        {{-- <input type="email" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"  class="form-control" placeholder="Email"
                            required /> --}}
                    </div>
                    <div class="mb-3">
                        <input type="password"id="password" ype="password" name="password" required
                            autocomplete="current-password" class="form-control" placeholder="Password" required />
                        @error('password')
                            <div style="color: red">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <div class="d-flex align-items-center justify-content-between"> --}}
                    {{-- <div class="form-check"> --}}
                    {{-- <input class="form-check-input cursor-pointer" type="checkbox" id="rememberMe" /> --}}
                    {{-- <label class="form-check-label text-muted" for="rememberMe">Remember</label> --}}
                    {{-- </div> --}}
                    {{-- <a href="./auth-reset.html" class="fs-13 text-primary">Forget password?</a> --}}
                    {{-- </div> --}}
                    <div class="d-grid mt-5">
                        <button type="submit" class="btn btn-lg btn-primary w-100">
                            Login
                        </button>
                    </div>
                </form>
                {{-- <div class="w-100 mt-5 text-center mx-auto">
                    <div class="my-5 border-bottom position-relative">
                        <span
                            class="small py-1 px-3 text-uppercase text-muted bg-body-tertiary rounded position-absolute translate-middle">or</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <a href="javascript:void(0);" class="btn bg-body-tertiary flex-fill border"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" title="Login with Facebook">
                            <i class="fi fi-brands-facebook"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn bg-body-tertiary flex-fill border"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" title="Login with Twitter">
                            <i class="fi fi-brands-twitter"></i>
                        </a>
                        <a href="javascript:void(0);" class="btn bg-body-tertiary flex-fill border"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" title="Login with Github">
                            <i class="fi fi-brands-github"></i>
                        </a>
                    </div>
                </div> --}}
                <div class="mt-5 text-muted">
                    <span> Don't have an account?</span>
                    <a href="{{ route('register') }}" class="fw-semibold text-dark">Create an Account</a>
                </div>
            </div>
        </div>
    </main>

    <style>
        .image {
            justify-content: center !important;
            justify-items: center !important;
            margin-bottom: 10px;
            margin-left: 25px;
        }
    </style>
</x-guest-layout>
