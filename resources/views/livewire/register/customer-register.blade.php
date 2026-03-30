<div>
    <div class="main-wrapper">
        <main class="min-vh-100 overflow-y-auto d-flex flex-column justify-content-center px-4 m-0" id="edash-main">
            <div class="card max-wd-400 max-wd-sm-450 mx-auto my-5 bg-body-tertiary">
                @if (!$payment_details)
                    <div class="card-body p-sm-8 p-4">
                        <h4 class="mb-2 fw-semibold">Create an account</h4>
                        <p class="fs-13 fw-medium text-muted mb-6">
                            Let's get you all setup, so you can verify your personal account
                            and begine setting up your profile.
                        </p>
                        <form wire:submit="registerCustomer">
                            @if ($referral_id)
                                <div class="mb-4 d-none">
                                    <input type="text" class="form-control" disabled wire:model='referral_id' />
                                </div>
                            @endif
                            <div class="mb-4">
                                <input type="text" class="form-control" placeholder="First Name"
                                    wire:model='first_name' />
                                @error('first_name')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <input type="text" class="form-control" placeholder="Last Name"
                                    wire:model='last_name' />
                                @error('last_name')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <select class="form-select" wire:model='gender'>
                                    <option class="d-none">select Gender</option>
                                    <option value="Male">Male
                                    </option>
                                    <option value="Female">Female
                                    </option>

                                </select>
                                @error('gender')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control" placeholder="NIC" wire:model='nic' />
                                @error('nic')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="date" class="form-control" placeholder="DOB" wire:model='dob' />
                                @error('dob')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="email" class="form-control" placeholder="Email" wire:model='email' />
                                @error('email')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <input type="number" class="form-control" placeholder="Contact No"
                                    wire:model='mobile_no' />
                                @error('mobile_no')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <input type="text" class="form-control" placeholder="Address" wire:model='address' />
                                @error('address')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <select class="form-select" wire:model='selected_district' wire:change='getCities()'>
                                    <option class="d-none">select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">
                                            {{ $district->name_en }}

                                        </option>
                                    @endforeach


                                </select>
                                @error('selected_district')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <select class="form-select" wire:model='selected_city'>
                                    <option class="d-none">select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">
                                            {{ $city->name_en }}
                                    @endforeach


                                </select>
                                @error('selected_city')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- <div class="mb-4">
                                <select class="form-select" wire:model='payment_type'>
                                    <option class="d-none">select Payment Method</option>
                                    <option value="1">BANK DEPOSITE
                                    </option>
                                    <option value="2">ONLINE
                                    </option>

                                </select>
                                @error('payment_type')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}
                            <div class="mb-4">
                                <select class="form-select" wire:model='branch'>
                                    <option class="d-none">select Branch</option>
                                    <option value="Galle">Galle
                                    </option>
                                    <option value="Malabe">Malabe
                                    </option>
                                    <option value="Panadura">Panadura
                                    </option>
                                    <option value="Nittambuwa">Nittambuwa
                                    </option>
                                    <option value="Kurunegala">Kurunegala
                                    </option>

                                </select>
                                @error('branch')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <select class="form-select" wire:model='selected_course'>
                                    <option class="d-none">select Course</option>
                                    @foreach ($courses as $course)
                                        @if (isset($course->display_price))
                                            <option value="{{ $course->id }}">
                                                {{ $course->name . ' ' . $course->display_price }}
                                            </option>
                                        @else
                                            <option value="{{ $course->id }}">
                                                {{ $course->name . ' ' . $course->course_price }}

                                            </option>
                                        @endif
                                    @endforeach


                                </select>
                                @error('selected_course')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                {{-- <div class="form-check mb-3">
                                <input class="form-check-input cursor-pointer" type="checkbox" id="receiveMial"
                                    required />
                                <label class="form-check-label text-muted" for="receiveMial">Yes, I wnat to receive
                                    nexel community emails</label>
                            </div> --}}
                                {{-- <div class="form-check">
                                <input class="form-check-input cursor-pointer" type="checkbox" id="termsCondition"
                                    required />
                                <label class="form-check-label text-muted" for="termsCondition">I agree to all the
                                    <a href="javascript:void(0);">Terms &amp; Conditions</a> and
                                    <a href="javascript:void(0);">Fees</a>.</label>
                            </div> --}}
                            </div>
                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">
                                    Create Account
                                </button>
                            </div>
                        </form>
                        {{-- <div class="mt-5 text-muted">
                        <span>Already have an account?</span>
                        <a href="./auth-login.html" class="fw-semibold text-dark">Login</a>
                    </div> --}}
                    </div>
                @endif
                @if ($payment_details)
                    <div class="card-body p-sm-8 p-4">
                        <h4 class="mb-2 fw-semibold">Bank Details</h4>
                        <p class="fs-13 fw-medium text-muted mb-6">

                        </p>
                        <form wire:submit="setPaid">
                            <div class="col-12">
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>

                            <div class="mb-4">
                                <input type="text" class="form-control" value="company name" disabled />

                            </div>
                            <div class="mb-4">
                                <input type="text" class="form-control" value="xxxxxxxxxxxxxxx" disabled />

                            </div>
                            <div class="mb-4">
                                <input type="number" class="form-control" value="xxxxxxxxxxxxx" disabled />

                            </div>
                            {{-- <div class="mb-4">
                                <select class="form-select" wire:model='paid_amount'>
                                    <option>--select--</option>
                                    <option value="2">HALF
                                    </option>
                                    <option value="3">FULL
                                    </option>

                                </select>
                                @error('paid_amount')
                                    <div style="color: red">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}

                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">
                                    PAID
                                </button>
                                <button type="button" wire:click='back' class="btn btn-lg btn-primary w-100 mt-5">
                                    BACK
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
