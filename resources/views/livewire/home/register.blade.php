<div>
    <header class="header">
        <div class="w-layout-blockcontainer container-default w-container">
            <div data-animation="over-left" data-collapse="medium" data-duration="400" data-easing="ease" data-easing2="ease"
                role="banner" class="navbar-container w-nav">
                <div class="navbar-wrapper">
                    <a href="#" class="navbar-brand w-nav-brand"><img loading="lazy"
                            src="{{ asset('home/images/Equest-logo.svg') }}" alt="Brand Logo" class="brand-logo"></a>
                    <nav role="navigation" class="nav-menu-wrapper w-nav-menu">
                        <ul role="list" class="nav-menu w-list-unstyled">
                            <li class="nav-mobile-brand">
                                <a href="#" class="navbar-brand w-nav-brand"><img loading="lazy"
                                        src="{{ asset('home/images/Equest-logo.svg') }}" alt="Brand Logo"
                                        class="brand-logo"></a>
                            </li>
                            <li class="nav-menu-list">
                                <div class="nav-menu-link-wrapper">
                                    <a href="#" class="nav-menu-link">Home</a>
                                </div>
                            </li>
                            <li class="nav-menu-list">
                                <div class="nav-menu-link-wrapper">
                                    <a href="#" class="nav-menu-link">About Us</a>
                                </div>
                            </li>
                            <li class="nav-menu-list">
                                <div class="nav-menu-link-wrapper">
                                    <a href="#" class="nav-menu-link">Courses</a>
                                </div>
                            </li>
                            <li class="nav-menu-list">
                                <div class="nav-menu-link-wrapper">
                                    <a href="#" class="nav-menu-link">Our Team</a>
                                </div>
                            </li>
                            <li class="nav-menu-list">
                                <div class="nav-menu-link-wrapper">
                                    <a href="#" class="nav-menu-link">Contact Us</a>
                                </div>
                            </li>
                        </ul>
                        <div class="nav-button-block">
                            <a href="#" class="nav-menu-button w-button">Enroll Now</a>
                        </div>
                    </nav>
                    <div class="menu-button w-nav-button">
                        <div class="w-icon-nav-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main-wrapper">
        <section class="contact-info-section">
            <div class="section-gap is-registerform">
                <div class="header-blue-wrapper"></div>
                <div class="w-layout-blockcontainer container-default w-container">
                    <div class="register-form-wrapper">
                        <div id="w-node-_24026d05-5415-ce81-2e1e-26a7b8260504-f835ecd8"
                            class="max-width-large align-center">
                            <div class="contact-us-form-block">
                                <div class="section-title-wrapper center">
                                    <div class="overflow-hidden">
                                        <h2 data-w-id="091f6b78-4fb7-0735-892a-8495dcab8441"
                                            style="-webkit-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-moz-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-ms-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform-style:preserve-3d"
                                            class="section-title is-credintail">Register Now</h2>
                                    </div>
                                    {{-- <div class="overflow-hidden">
                                        <p data-w-id="091f6b78-4fb7-0735-892a-8495dcab8444"
                                            style="-webkit-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-moz-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-ms-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(0) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform-style:preserve-3d"
                                            class="section-title-except">Please fill in all your personal details to
                                            register.</p>
                                    </div> --}}
                                </div>
                                <div class="contact2_form-block w-form">
                                    <form id="wf-form-Registration-Form" name="wf-form-Registration-Form"
                                        wire:submit="registerCustomer" data-name="Registration Form" method="get"
                                        class="contact2_form" data-wf-page-id="677f670450b972dff835ecd8"
                                        data-wf-element-id="24026d05-5415-ce81-2e1e-26a7b8260506">
                                        <div class="form_field-2col">
                                            <div class="form_field-wrapper"><label for="first-name"
                                                    class="form_field-label">First name<span
                                                        class="requied-mark">*</span></label><input
                                                    wire:model='first_name' class="form-input-field w-input"
                                                    maxlength="256" name="first-name" data-name="first-name"
                                                    placeholder="Enter your first name" type="text" id="first-name"
                                                    required="">
                                                @error('first_name')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form_field-wrapper"><label for="last-name"
                                                    class="form_field-label">Last name<span
                                                        class="requied-mark">*</span></label><input
                                                    wire:model='last_name' class="form-input-field w-input"
                                                    maxlength="256" name="last-name" data-name="last-name"
                                                    placeholder="Enter your last name" type="text" id="last-name"
                                                    required=""> @error('last_name')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form_field-2col">
                                            <div class="form_field-wrapper"><label for="first-name"
                                                    class="form_field-label">NIC<span
                                                        class="requied-mark">*</span></label><input wire:model='nic'
                                                    class="form-input-field w-input" maxlength="256"
                                                    name="first-name" data-name="first-name"
                                                    placeholder="Enter your NIC" type="text"
                                                    id="first-name" required="">
                                                @error('nic')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form_field-wrapper"><label for="last-name"
                                                    class="form_field-label">Contact No<span
                                                        class="requied-mark">*</span></label><input
                                                    wire:model='mobile_no' class="form-input-field w-input"
                                                    maxlength="256" name="last-name" data-name="last-name"
                                                    placeholder="Enter your Contact No" type="number" id="last-name"
                                                    required="">
                                                @error('mobile_no')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form_field-wrapper"><label for="email"
                                                class="form_field-label">Email<span
                                                    class="requied-mark">*</span></label><input wire:model='email'
                                                class="form-input-field w-input" maxlength="256" name="email"
                                                wire:model='email' data-name="email"
                                                placeholder="Enter your email address" type="email" id="email"
                                                required=""> @error('email')
                                                <div style="color: red" class="er_msg">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div id="w-node-d8851195-8d61-a54a-65c6-938234ab650d-f835ecd8"
                                            class="form_field-2col is-mobile-1col">
                                            <div id="w-node-d8851195-8d61-a54a-65c6-938234ab650e-f835ecd8"
                                                class="form_field-wrapper"><label for="gender"
                                                    class="form_field-label">Gender<span
                                                        class="requied-mark">*</span></label><select id="gender"
                                                    wire:model='gender' name="gender" data-name="gender"
                                                    required="" class="form-input-field is-select-field w-select">
                                                    <option value="">Select one...</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select> @error('gender')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form_field-wrapper"><label for="Contact-2-Email-2"
                                                    class="form_field-label">Date of Birth<span
                                                        class="requied-mark">*</span></label><input type="date"
                                                    wire:model='dob' name="date-of-birth" required=""
                                                    class="form-input-field _w-100"> @error('dob')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div id="w-node-d75f9469-8c00-2d40-eb82-6b5e28020412-f835ecd8"
                                            class="form_field-wrapper"><label for="course"
                                                class="form_field-label">Course<span
                                                    class="requied-mark">*</span></label><select id="course"
                                                wire:model='selected_course' name="course" data-name="course"
                                                required="" class="form-input-field is-select-field w-select">
                                                <option value="" class="d-none">Select one...</option>
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
                                            </select> @error('selected_course')
                                                <div style="color: red" class="er_msg">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form_field-2col is-mobile-1col">
                                            <div class="form_field-wrapper"><label for="address"
                                                    class="form_field-label">Address<span
                                                        class="requied-mark">*</span></label><input
                                                    class="form-input-field w-input" maxlength="256" name="address"
                                                    wire:model='address' data-name="address"
                                                    placeholder="Enter your address" type="text" id="address"
                                                    required=""> @error('address')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form_field-wrapper"><label for="district"
                                                    class="form_field-label">District<span
                                                        class="requied-mark">*</span></label><select id="district"
                                                    wire:model='selected_district'
                                                    name="district" data-name="district" required=""
                                                    class="form-input-field is-select-field w-select">
                                                    <option class="d-none">Select one...</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}">
                                                            {{ $district->name_en }}

                                                        </option>
                                                    @endforeach
                                                </select> @error('selected_district')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div id="w-node-ea1bbd5a-a342-7fa4-bdb3-bd595776863f-f835ecd8"
                                            class="form_field-2col is-mobile-1col">

                                            <div id="w-node-f8a99a08-0897-b8ae-e087-3d5667c1ec0a-f835ecd8"
                                                class="form_field-wrapper"><label for="city"
                                                    class="form_field-label">City<span
                                                        class="requied-mark">*</span></label><select id="city"
                                                    wire:model='selected_city' name="city" data-name="city"
                                                    required="" class="form-input-field is-select-field w-select">
                                                    <option class="d-none" value="">Select one...</option>
                                                    {{-- @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">
                                                            {{ $city->name_en }}
                                                        </option>
                                                    @endforeach --}}
                                                </select> @error('selected_city')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div id="w-node-ea1bbd5a-a342-7fa4-bdb3-bd5957768644-f835ecd8"
                                                class="form_field-wrapper"><label for="city"
                                                    class="form_field-label">Branch<span
                                                        class="requied-mark">*</span></label><select id="branch"
                                                    name="branch" data-name="branch" required=""
                                                    wire:model='branch'
                                                    class="form-input-field is-select-field w-select">
                                                    <option class="d-none">Select one...</option>
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
                                                </select> @error('branch')
                                                    <div style="color: red" class="er_msg">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <label id="Contact-1-Checkbox"
                                            class="w-checkbox form_checkbox margin-top-form-checkbox">
                                            <div
                                                class="w-checkbox-input w-checkbox-input--inputType-custom form_checkbox-icon">
                                            </div><input type="checkbox"  wire:model='is_agree'
                                                required="" style="opacity:0;position:absolute;z-index:-1"><span
                                                for="Contact-1-Checkbox-2"
                                                class="form_checkbox-label agree-text w-form-label">I agree to the <a
                                                    href="https://www.equest.lk/terms_conditions" target="_blank"
                                                    class="text-bold">Terms and Conditions</a>.</span>
                                        </label> --}}
                                        <div id="w-node-_5f2207f8-1e34-bae7-ff1b-4316f5b675c4-f835ecd8"
                                            class="register-margin-top"><input type="submit"
                                                data-wait="Please wait..."
                                                id="w-node-_24026d05-5415-ce81-2e1e-26a7b8260546-f835ecd8"
                                                class="submit-button w-button" value="Register Now"></div>
                                    </form>
                                    <div class="form_message-success-wrapper w-form-done">
                                        <div class="form_message-success">
                                            <div class="success-text">Thank you! Your submission has been received!
                                            </div>
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

    <style>
        .er_msg {
            font-size: 14px !important;
        }
    </style>

    <script>
        // Helper function to extract complete JSON object from string
        function extractJsonObject(str, startIndex) {
            let braceCount = 0;
            let inString = false;
            let escapeNext = false;

            for (let i = startIndex; i < str.length; i++) {
                const char = str[i];

                if (escapeNext) {
                    escapeNext = false;
                    continue;
                }

                if (char === '\\') {
                    escapeNext = true;
                    continue;
                }

                if (char === '"') {
                    inString = !inString;
                    continue;
                }

                if (!inString) {
                    if (char === '{') {
                        braceCount++;
                    } else if (char === '}') {
                        braceCount--;
                        if (braceCount === 0) {
                            return str.substring(startIndex, i + 1);
                        }
                    }
                }
            }

            throw new Error('Incomplete JSON object');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const districtSelect = document.getElementById('district');
            const citySelect = document.getElementById('city');

            if (districtSelect && citySelect) {
                districtSelect.addEventListener('change', function() {
                    const districtId = this.value;

                    // Reset city select
                    citySelect.innerHTML = '<option class="d-none" value="">Select one...</option>';
                    citySelect.value = '';

                    // Reset Livewire selected_city
                    citySelect.dispatchEvent(new Event('change', { bubbles: true }));

                    if (!districtId) {
                        return;
                    }

                    // Show loading state
                    citySelect.disabled = true;
                    const loadingOption = document.createElement('option');
                    loadingOption.textContent = 'Loading...';
                    loadingOption.disabled = true;
                    citySelect.appendChild(loadingOption);

                    // Make Axios request - use absolute URL for better compatibility
                    const apiUrl = '{{ url("/api/cities") }}';

                    console.log('Fetching cities for district:', districtId);
                    console.log('API URL:', apiUrl);

                    axios.get(apiUrl, {
                        params: {
                            district_id: districtId
                        },
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(function(response) {
                        console.log('Response received:', response);
                        console.log('Response data:', response.data);

                        // Clear loading option
                        citySelect.innerHTML = '<option class="d-none" value="">Select one...</option>';

                        let responseData = response.data;

                        // Handle case where response.data is a string (contains HTML spam + JSON)
                        if (typeof responseData === 'string') {
                            try {
                                // Find the JSON object - look for {"success" pattern
                                const jsonStartIndex = responseData.indexOf('{"success"');
                                if (jsonStartIndex === -1) {
                                    // Try alternative pattern
                                    const altStartIndex = responseData.indexOf('{"cities"');
                                    if (altStartIndex === -1) {
                                        throw new Error('No JSON found in response');
                                    }
                                    // Extract from this position and find the matching closing brace
                                    const jsonString = extractJsonObject(responseData, altStartIndex);
                                    responseData = JSON.parse(jsonString);
                                    console.log('Extracted JSON from string (alt):', responseData);
                                } else {
                                    // Extract the complete JSON object
                                    const jsonString = extractJsonObject(responseData, jsonStartIndex);
                                    responseData = JSON.parse(jsonString);
                                    console.log('Extracted JSON from string:', responseData);
                                }
                            } catch (e) {
                                console.error('Failed to parse JSON from response:', e);
                                console.error('Response string (first 500 chars):', responseData.substring(0, 500));
                                responseData = null;
                            }
                        }

                        // Populate cities
                        console.log('Parsed responseData:', responseData);
                        console.log('responseData type:', typeof responseData);
                        console.log('responseData.cities:', responseData ? responseData.cities : 'N/A');

                        if (responseData && responseData.cities) {
                            if (responseData.cities.length > 0) {
                                responseData.cities.forEach(function(city) {
                                    const option = document.createElement('option');
                                    option.value = city.id;
                                    option.textContent = city.name_en || city.name || 'Unknown';
                                    citySelect.appendChild(option);
                                });
                                console.log('Cities loaded:', responseData.cities.length);
                            } else {
                                const option = document.createElement('option');
                                option.value = '';
                                option.textContent = 'No cities available';
                                option.disabled = true;
                                citySelect.appendChild(option);
                                console.log('No cities found for district:', districtId);
                            }
                        } else {
                            console.warn('Unexpected response format. responseData:', responseData);
                            console.warn('responseData type:', typeof responseData);
                            if (responseData) {
                                console.warn('responseData keys:', Object.keys(responseData));
                            }
                            const option = document.createElement('option');
                            option.value = '';
                            option.textContent = 'No cities available';
                            citySelect.appendChild(option);
                        }

                        citySelect.disabled = false;

                        // Trigger change event to sync with Livewire wire:model
                        citySelect.dispatchEvent(new Event('change', { bubbles: true }));
                    })
                    .catch(function(error) {
                        console.error('Error loading cities:', error);
                        console.error('Error details:', {
                            message: error.message,
                            response: error.response,
                            status: error.response ? error.response.status : 'N/A',
                            statusText: error.response ? error.response.statusText : 'N/A',
                            data: error.response ? error.response.data : 'N/A',
                            url: error.config ? error.config.url : 'N/A'
                        });

                        citySelect.innerHTML = '<option class="d-none" value="">Select one...</option>';
                        const errorOption = document.createElement('option');
                        errorOption.value = '';
                        errorOption.textContent = 'Error loading cities. Please try again.';
                        errorOption.disabled = true;
                        citySelect.appendChild(errorOption);
                        citySelect.disabled = false;

                        // Trigger change event to sync with Livewire wire:model
                        citySelect.dispatchEvent(new Event('change', { bubbles: true }));
                    });
                });
            }
        });
    </script>
</div>
