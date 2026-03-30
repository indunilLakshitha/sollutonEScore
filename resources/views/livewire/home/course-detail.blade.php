<div>
    <main class="main-wrapper">
        <section class="course-header">
            <div class="section-gap">
                <div class="w-layout-blockcontainer container-default w-container">
                    <div class="breadcrumb-content-block">
                        <div data-w-id="f8531ac7-6d4c-9631-d415-62eb316cc5d8"
                            style="-webkit-transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                            class="breadcrumb-link-wrapper is-black">
                            <a href="#" class="breadcrumb-link is-black">{{ $course->category?->cat_name }}</a>
                        </div>
                        <div class="course-header-wrapper">
                            <div class="breadcrumb-grid-wrapper">
                                <h1 class="breadcrumb-title is-black is-course">{{ $course->name }}</h1>
                                <div id="w-node-_3492af5c-ec31-03db-b460-5b3e0888f1f6-36b5deb7"
                                    class="breadcrumb-button-wrapper">
                                    <a  href='{{ route('regWithcourse', $course->slug) }}' data-w-id="00a40158-89ed-6414-492b-3bb25c58539a"
                                    {{-- <a  wire:click='selectCourse({{ $course->id }})' data-w-id="00a40158-89ed-6414-492b-3bb25c58539a" --}}
                                        style="-webkit-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                                        class="primary-button w-inline-block">
                                        <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                            class="button-icon-wrapper two">
                                            <div class="button-icon w-embed"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" viewbox="0 0 16 16" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                        fill="#091E42"></path>
                                                    <path
                                                        d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                        fill="#091E42"></path>
                                                </svg></div>
                                            <div class="button-bg-2"></div>
                                        </div>
                                        <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                            class="button-text">Enroll Now</div>
                                        <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                            class="button-icon-wrapper one">
                                            <div class="button-icon w-embed"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" viewbox="0 0 16 16" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                        fill="#091E42"></path>
                                                    <path
                                                        d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                        fill="#091E42"></path>
                                                </svg></div>
                                            <div class="button-bg-2"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="breadcrumb-header-image-wrapper is-course"><img
                                    src="{{ asset('storage/' . $course->thumbnail) }}" loading="lazy"
                                    sizes="(max-width: 479px) 99vw, (max-width: 767px) 93vw, (max-width: 991px) 710px, (max-width: 1279px) 929.9999389648438px, (max-width: 1439px) 1167.0028076171875px, 1320px"
                                    srcset="{{ asset('storage/' . $course->thumbnail) }} 500w, {{ asset('storage/' . $course->thumbnail) }} 800w, {{ asset('storage/' . $course->thumbnail) }} 1080w, {{ asset('storage/' . $course->thumbnail) }} 1167w"
                                    alt="" class="breadcrumb-header-image iscourse"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="course-content">
            <div class="section-gap is-small">
                <div class="w-layout-blockcontainer container-default w-container">
                    <div class="course-details-wrap">
                        <div class="course-details-sidebar">
                            <div data-w-id="e6bc9f8c-37c0-daa7-d2a7-fe67e6328084"
                                style="-webkit-transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                                class="course-category-block">
                                <div class="service-category-cms-block is-no-padding">
                                    <div class="service-category-collection-list-wrap">
                                        <div class="service-category-collection-list">
                                            <div class="service-category-items">
                                                <a href="#"
                                                    class="service-sidebar-link is-active-tab w-inline-block">
                                                    <div class="service-category-title-v2">Introduction</div>
                                                    <div class="service-category-arrow w-embed"><svg width="24"
                                                            height="24" viewbox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.51472 12.0001H20.4853" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path d="M14.125 4.98071L21.0193 11.875L14.125 18.7693"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                        </svg></div>
                                                </a>
                                            </div>
                                            <div class="service-category-items">
                                                <a href="#" class="service-sidebar-link w-inline-block">
                                                    <div class="service-category-title-v2">Course Structure</div>
                                                    <div class="service-category-arrow w-embed"><svg width="24"
                                                            height="24" viewbox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.51472 12.0001H20.4853" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path d="M14.125 4.98071L21.0193 11.875L14.125 18.7693"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                        </svg></div>
                                                </a>
                                            </div>
                                            <div class="service-category-items">
                                                <a href="#" class="service-sidebar-link w-inline-block">
                                                    <div class="service-category-title-v2">Lectures</div>
                                                    <div class="service-category-arrow w-embed"><svg width="24"
                                                            height="24" viewbox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.51472 12.0001H20.4853" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path d="M14.125 4.98071L21.0193 11.875L14.125 18.7693"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                        </svg></div>
                                                </a>
                                            </div>
                                            <div class="service-category-items">
                                                <a href="#" class="service-sidebar-link w-inline-block">
                                                    <div class="service-category-title-v2">Investment</div>
                                                    <div class="service-category-arrow w-embed"><svg width="24"
                                                            height="24" viewbox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.51472 12.0001H20.4853" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path d="M14.125 4.98071L21.0193 11.875L14.125 18.7693"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                        </svg></div>
                                                </a>
                                            </div>
                                            <div class="service-category-items">
                                                <a href="#" class="service-sidebar-link w-inline-block">
                                                    <div class="service-category-title-v2">FAQs</div>
                                                    <div class="service-category-arrow w-embed"><svg width="24"
                                                            height="24" viewbox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.51472 12.0001H20.4853" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                            </path>
                                                            <path d="M14.125 4.98071L21.0193 11.875L14.125 18.7693"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                        </svg></div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cou-sesiebar-inner hide-on-mobile">
                                <div class="service-info-and-download-block">
                                    <div data-w-id="e6bc9f8c-37c0-daa7-d2a7-fe67e63280a5"
                                        style="-webkit-transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 80px, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                                        class="service-contact-info-block">
                                        <div class="service-contact-info-icon">
                                            <div class="contact-icon w-embed"><svg width="80" height="80"
                                                    viewbox="0 0 80 80" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g clip-path="url(#clip0_811_14068)">
                                                        <path
                                                            d="M80.0002 54.1409C80.0002 44.2135 74.3051 35.3536 65.7754 31.0439C65.5105 50.0784 50.0784 65.5105 31.0439 65.7754C35.3536 74.3051 44.2135 80.0002 54.1409 80.0002C58.7954 80.0002 63.3218 78.7606 67.2988 76.4053L79.8873 79.8873L76.4053 67.2988C78.7606 63.3218 80.0002 58.7954 80.0002 54.1409Z"
                                                            fill="white"></path>
                                                        <circle cx="30.5" cy="30.5" r="30.5"
                                                            fill="#121926"></circle>
                                                        <path
                                                            d="M61.0938 30.5469C61.0938 13.703 47.3908 0 30.5469 0C13.703 0 0 13.703 0 30.5469C0 36.0364 1.46118 41.3812 4.23584 46.0736L0.112305 60.9808L15.0201 56.8579C19.7125 59.6326 25.0574 61.0938 30.5469 61.0938C47.3908 61.0938 61.0938 47.3908 61.0938 30.5469ZM25.8594 23.4375H21.1719C21.1719 18.2678 25.3772 14.0625 30.5469 14.0625C35.7166 14.0625 39.9219 18.2678 39.9219 23.4375C39.9219 26.0614 38.811 28.5834 36.8732 30.3558L32.8906 34.0009V37.6563H28.2031V31.9366L33.7085 26.8976C34.6924 25.9973 35.2344 24.7687 35.2344 23.4375C35.2344 20.8527 33.1317 18.75 30.5469 18.75C27.962 18.75 25.8594 20.8527 25.8594 23.4375ZM28.2031 42.3438H32.8906V47.0313H28.2031V42.3438Z"
                                                            fill="white"></path>
                                                    </g>
                                                    <defs>
                                                        <clippath id="clip0_811_14068">
                                                            <rect width="80" height="80" fill="white">
                                                            </rect>
                                                        </clippath>
                                                    </defs>
                                                </svg></div>
                                        </div>
                                        <div class="service-contact-info-title">Do you need any help?</div>
                                        <div class="service-contact-info-devider"></div>
                                        <div class="servoce-contact-link-block">
                                            <a href="tel:+94777672738" class="service-cotact-info-link">077 767
                                                2738</a>
                                            <a href="mailto:contact@equest.lk?subject=contact"
                                                class="service-cotact-info-link font-size-20px">contact@equest.lk</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="w-node-e6bc9f8c-37c0-daa7-d2a7-fe67e6328048-36b5deb7" class="couse-details-block">
                            <div class="course-details-tab-wrap">
                                <div data-current="Tab 1" data-easing="ease" data-duration-in="300"
                                    data-duration-out="100" class="course-tab w-tabs">
                                    <div class="course-tab-menu hide w-tab-menu">
                                        <a data-w-tab="Tab 1" class="w-inline-block w-tab-link w--current">
                                            <div>Tab 1</div>
                                        </a>
                                        <a data-w-tab="Tab 2" class="w-inline-block w-tab-link">
                                            <div>Tab 2</div>
                                        </a>
                                        <a data-w-tab="Tab 3" class="w-inline-block w-tab-link">
                                            <div>Tab 3</div>
                                        </a>
                                        <a data-w-tab="Tab 4" class="w-inline-block w-tab-link">
                                            <div>Tab 4</div>
                                        </a>
                                        <a data-w-tab="Tab 5" class="w-inline-block w-tab-link">
                                            <div>Tab 5</div>
                                        </a>
                                    </div>
                                    <div class="course-tab-content w-tab-content">
                                        <div data-w-tab="Tab 1" class="conter-tab-pane w-tab-pane w--tab-active">
                                            <div class="course-tab-content-single">
                                                <div class="course-tab-header-wrap">
                                                    <h2 class="course-tab-header">Introduction</h2>
                                                </div>
                                                <div class="course-tab-content-single-wrap">
                                                    <div class="w-richtext">
                                                        {!! $description !!}
                                                    </div>
                                                </div>
                                                <div class="course-tab-footer-static">
                                                    <div class="course-tab-footer-button-wrap">
                                                        <a  href='{{ route('regWithcourse', $course->slug) }}'
                                                        {{-- <a  wire:click='selectCourse({{ $course->id }})' --}}
                                                            data-w-id="f264fc84-fbef-6ff2-8f4c-0ea79d6f0923"
                                                            style="-webkit-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                                                            class="primary-button w-inline-block">
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper two">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-text">Enroll Now</div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper one">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-w-tab="Tab 2" class="tab-pane-tab-2 w-tab-pane">
                                            <div class="course-tab-content-single">
                                                <div class="course-tab-header-wrap">
                                                    <h2 class="course-tab-header">Course Structure</h2>
                                                </div>
                                                <div class="course-tab-content-single-wrap">
                                                    <table class="table_component">
                                                        <thead class="table_head">
                                                            <tr class="table_row">
                                                                <th class="table_header">Module</th>
                                                                <th class="table_header">Title</th>
                                                                <th class="table_header">Duration</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="table_body">
                                                            @foreach ($structures as $structure)
                                                                <tr class="table_row">
                                                                    <td class="table_cell">{{ $structure['module'] }}
                                                                    </td>
                                                                    <td class="table_cell">{{ $structure['title'] }}
                                                                    </td>
                                                                    <td class="table_cell">{{ $structure['duration'] }}
                                                                        hrs</td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="course-tab-footer-static">
                                                    <div class="course-tab-footer-button-wrap">
                                                        <a  wire:click='selectCourse({{ $course->id }})'
                                                            data-w-id="491c5e5a-3800-19c7-33bd-d73742595c79"
                                                            style="-webkit-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                                                            class="primary-button w-inline-block">
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper two">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-text">Enroll Now</div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper one">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-w-tab="Tab 3" class="w-tab-pane">
                                            <div class="course-tab-content-single">
                                                <div class="course-tab-header-wrap">
                                                    <h2 class="course-tab-header">Lectures</h2>
                                                </div>
                                                <div class="course-tab-content-single-wrap">
                                                    <div class="our-team-grid home-8 centered iscourse">
                                                        @foreach ($course_lecturers as $lec)
                                                            <div id="w-node-_74aa0a07-bd7c-474e-2a1e-827a5230cb8d-36b5deb7"
                                                                class="our-team-item home-9">
                                                                <div class="our-team-card-block home-10"><img
                                                                        loading="lazy"
                                                                        src="{{ asset('storage/' . $lec->image) }}"
                                                                        alt="Our Team Thumbnail"
                                                                        class="our-team-thumbnail home-11">
                                                                    <div class="our-team-card-overlay home-12"></div>
                                                                </div>
                                                                <div class="our-team-card-info home-14 is-margin-top">
                                                                    <div class="our-team-card-name home-15 is-black">
                                                                        {{ $lec->name }}</div>
                                                                    <div class="_14-text-size"> {{ $lec->post }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="course-tab-footer-static">
                                                    <div class="course-tab-footer-button-wrap">
                                                        <a  href='{{ route('regWithcourse', $course->slug) }}'
                                                        {{-- <a  wire:click='selectCourse({{ $course->id }})' --}}
                                                            data-w-id="acced7f7-b824-e4eb-48a1-68e5b4c98a4e"
                                                            style="-webkit-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                                                            class="primary-button w-inline-block">
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper two">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-text">Enroll Now</div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper one">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-w-tab="Tab 4" class="w-tab-pane">
                                            <div class="course-tab-content-single">
                                                <div class="course-tab-header-wrap">
                                                    <h2 class="course-tab-header">Investment</h2>
                                                </div>
                                                <div class="course-tab-content-single-wrap">
                                                    <div class="w-richtext">
                                                        {!! $investment !!}
                                                    </div>
                                                </div>
                                                <div class="course-tab-footer-static">
                                                    <div class="course-tab-footer-button-wrap">
                                                        <a  href='{{ route('regWithcourse', $course->slug) }}'
                                                        {{-- <a  wire:click='selectCourse({{ $course->id }})' --}}
                                                            data-w-id="177f9462-6b85-8118-8d68-39a81d2af1ba"
                                                            style="-webkit-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                                                            class="primary-button w-inline-block">
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper two">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-text">Enroll Now</div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper one">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-w-tab="Tab 5" class="w-tab-pane">
                                            <div class="course-tab-content-single">
                                                <div class="course-tab-header-wrap">
                                                    <h2 class="course-tab-header">FAQs</h2>
                                                </div>
                                                <div class="course-tab-content-single-wrap">
                                                    <div class="faq-list-wrapper">
                                                        @foreach ($faqs as $faq)
                                                            <div class="faq-item is-course">
                                                                <div class="faq-question-wrapper">
                                                                    <div class="faq-title">{{ $faq['title'] }}</div>
                                                                    <div class="icon-block">
                                                                        <div class="link-icon w-embed"><svg
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                width="18" height="10"
                                                                                viewbox="0 0 18 10" fill="none">
                                                                                <path fill-rule="evenodd"
                                                                                    clip-rule="evenodd"
                                                                                    d="M16.9778 1.47257C16.4105 0.747691 15.363 0.61994 14.6381 1.18724L8.9987 5.60067L3.3592 1.18724C2.6342 0.61994 1.5867 0.747691 1.01953 1.47257C0.4522 2.19751 0.579866 3.24501 1.3047 3.81217L7.47137 8.63834C8.3712 9.34251 9.6262 9.34251 10.5259 8.63834L16.6925 3.81217C17.4173 3.24501 17.5451 2.19751 16.9778 1.47257Z"
                                                                                    fill="currentColor"></path>
                                                                            </svg></div>
                                                                    </div>
                                                                </div>

                                                                <div class="faq-answer-wrapper">
                                                                    <div class="faq-answer-block">
                                                                        <p class="accordion-text">
                                                                            {{ $faq['description'] }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                                <div class="course-tab-footer-static">
                                                    <div class="course-tab-footer-button-wrap">
                                                        <a  href='{{ route('regWithcourse', $course->slug) }}'
                                                        {{-- <a  wire:click='selectCourse({{ $course->id }})' --}}
                                                            data-w-id="0829cf9c-21f0-18b7-3bdd-763fbc787fea"
                                                            style="-webkit-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 70px, 0) scale3d(0.8, 0.8, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);opacity:0"
                                                            class="primary-button w-inline-block">
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper two">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-text">Enroll Now</div>
                                                            <div style="-webkit-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0px, 0, 0) scale3d(1, 1, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                                class="button-icon-wrapper one">
                                                                <div class="button-icon w-embed"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16" height="16"
                                                                        viewbox="0 0 16 16" fill="none">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M11.5669 4.43306C11.811 4.67714 11.811 5.07286 11.5669 5.31694L4.69194 12.1919C4.44786 12.436 4.05214 12.436 3.80806 12.1919C3.56398 11.9479 3.56398 11.5521 3.80806 11.3081L10.6831 4.43306C10.9271 4.18898 11.3229 4.18898 11.5669 4.43306Z"
                                                                            fill="#091E42"></path>
                                                                        <path
                                                                            d="M11.2777 3.80614C11.4532 3.85733 11.6916 3.94709 11.8722 4.12777C12.0529 4.30847 12.1427 4.54685 12.1939 4.72229C12.2505 4.91624 12.2879 5.13563 12.3136 5.3563C12.3654 5.79925 12.3782 6.31917 12.3744 6.80262C12.3706 7.28981 12.3496 7.75762 12.3298 8.10244C12.3199 8.27519 12.3101 8.418 12.3029 8.518C12.2992 8.5675 12.2929 8.6485 12.2907 8.67637L12.2906 8.67712C12.2616 9.02112 11.9592 9.27681 11.6153 9.24781C11.2714 9.21881 11.0161 8.9165 11.045 8.57256C11.0469 8.54781 11.0527 8.47469 11.0562 8.42737C11.0631 8.33269 11.0723 8.19625 11.0819 8.03056C11.101 7.6985 11.1209 7.25262 11.1244 6.79281C11.1281 6.32926 11.115 5.86875 11.0721 5.50125C11.0505 5.31669 11.0072 5.12309 10.9778 5.02222C10.8769 4.99279 10.6834 4.94952 10.4988 4.92797C10.1312 4.88507 9.67075 4.87195 9.20718 4.87557C8.74737 4.87917 8.30156 4.89904 7.96943 4.91815C7.80375 4.92769 7.66731 4.93698 7.57268 4.94385C7.52537 4.94729 7.4525 4.95303 7.42775 4.95498C7.08381 4.98394 6.78125 4.72865 6.75225 4.38471C6.72325 4.04075 6.97856 3.73841 7.32256 3.70942L7.32393 3.7093C7.35243 3.70706 7.43287 3.70072 7.48206 3.69714C7.58206 3.68987 7.72487 3.68015 7.89762 3.67021C8.24237 3.65037 8.71018 3.62943 9.19743 3.62562C9.68087 3.62183 10.2008 3.63469 10.6437 3.68641C10.8644 3.71217 11.0838 3.74953 11.2777 3.80614Z"
                                                                            fill="#091E42"></path>
                                                                    </svg></div>
                                                                <div class="button-bg-2"></div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
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
</div>
