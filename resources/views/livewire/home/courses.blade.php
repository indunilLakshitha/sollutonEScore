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
                                    <a href="#" aria-current="page"
                                        class="nav-menu-link w--current">Courses</a>
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
        <section data-wf--breadcrumb--variant="course"
            class="breadcrumb-section w-variant-b87ef14f-bb67-0b97-8626-8e547bbf1d7b">
            <div class="section-gap">
                <div class="w-layout-blockcontainer container-default w-container">
                    <div class="breadcrumb-content-block">
                        <div data-w-id="73831a50-f11a-da87-b439-1eab076c2a89" class="breadcrumb-link-wrapper">
                            <div class="breadcrumb-text">Courses</div>
                        </div>
                        <div class="overflow-hidden">
                            <h1 data-w-id="73831a50-f11a-da87-b439-1eab076c2a90" class="breadcrumb-title">Explore Our
                                Courses</h1>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb-shape-wrapper">
                    <div class="breadcrumb-overlay"></div><img src="{{ asset('home/images/breadcrumb-bg-shape.png') }}"
                        loading="lazy" sizes="100vw"
                        srcset="{{ asset('home/images/breadcrumb-bg-shape-p-500.png') }} 500w, {{ asset('home/images/breadcrumb-bg-shape-p-800.png') }} 800w, {{ asset('home/images/breadcrumb-bg-shape-p-1080.png') }} 1080w, {{ asset('home/images/breadcrumb-bg-shape.png') }} 1920w"
                        alt="Breadcrumb BG Shape" class="breadcrumb-bg-shape">
                </div>
            </div>
        </section>
        <section class="project-section">
            <div class="section-gap">
                <div class="w-layout-blockcontainer container-default w-container">
                    <div class="section-title-wrapper center">
                        <div class="overflow-hidden">
                            <h2 data-w-id="4dee49ab-7996-4224-f5a8-de0e86695a74"
                                style="-webkit-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-moz-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-ms-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform-style:preserve-3d"
                                class="section-title max-width-750px">Discover Your Potential with Our Courses</h2>
                        </div>
                    </div>
                    <div class="project-list-wrapper">
                        <div class="project-grid">
                            @foreach ($courses as $course)
                                <div class="project-grid-item">
                                    <div data-w-id="3da8345b-4f39-1871-d312-1eaf82907088" class="project-card-block">
                                        <div class="project-card-image-block">

                                            <a wire:click='selectCourse({{ $course->id }})'
                                                class="project-image-link-block w-inline-block"><img
                                                    src="{{ asset('storage/' . $course->thumbnail) }}" loading="lazy"
                                                    sizes="(max-width: 479px) 90vw, (max-width: 767px) 92vw, (max-width: 991px) 343px, (max-width: 1279px) 299.328125px, (max-width: 1439px) 374px, 424px"
                                                    srcset="{{ asset('storage/' . $course->thumbnail) }} 500w, {{ asset('storage/' . $course->thumbnail) }} 616w"
                                                    alt="Project Small Thumbnail"
                                                    class="project-thumbnail one image-animation"><img
                                                    src="{{ asset('storage/' . $course->thumbnail) }}" loading="lazy"
                                                    style="-webkit-transform:translate3d(0, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                    sizes="(max-width: 479px) 90vw, (max-width: 767px) 92vw, (max-width: 991px) 343px, (max-width: 1279px) 299.328125px, (max-width: 1439px) 374px, 424px"
                                                    alt="Project Small Thumbnail"
                                                    srcset="{{ asset('storage/' . $course->thumbnail) }} 500w, {{ asset('storage/' . $course->thumbnail) }} 616w"
                                                    class="project-thumbnail two"><img
                                                    src="{{ asset('storage/' . $course->thumbnail) }}" loading="lazy"
                                                    style="-webkit-transform:translate3d(0, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-moz-transform:translate3d(0, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);-ms-transform:translate3d(0, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0);transform:translate3d(0, 0, 0) scale3d(0, 0, 1) rotateX(0) rotateY(0) rotateZ(0) skew(0, 0)"
                                                    sizes="(max-width: 479px) 90vw, (max-width: 767px) 92vw, (max-width: 991px) 343px, (max-width: 1279px) 299.328125px, (max-width: 1439px) 374px, 424px"
                                                    alt="Project Small Thumbnail"
                                                    srcset="{{ asset('storage/' . $course->thumbnail) }}500w, {{ asset('storage/' . $course->thumbnail) }} 616w"
                                                    class="project-thumbnail three">
                                                <div class="project-tag-wrapper"></div>
                                                <div class="image-animation-wrapper">
                                                    <div class="image-overlay-block-one"></div>
                                                    <div class="image-overlay-block-two"></div>
                                                    <div class="image-overlay-block-three"></div>
                                                    <div class="image-overlay-block-four"></div>
                                                </div>
                                            </a>
                                            <div class="project-tags-list-wrapper">
                                                <div class="project-tags-list">
                                                    <div class="project-tags-list-item">
                                                        <a href="#"
                                                            class="project-tag">{{ $course?->category?->cat_name }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overflow-hidden">
                                            <a data-w-id="3da8345b-4f39-1871-d312-1eaf8290709a"
                                                style="-webkit-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-moz-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);-ms-transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform:translate3d(0, 180%, 0) scale3d(1, 1, 1) rotateX(null) rotateY(-45deg) rotateZ(0) skew(-10deg, 10deg);transform-style:preserve-3d"
                                                wire:click='selectCourse({{ $course->id }})'
                                                class="project-title-link-block w-inline-block">
                                                <h3 class="project-card-title">{{ $course->name }}</h3>
                                            </a>
                                        </div>
                                        <div class="select-course-btn-wrapper">
                                            <a href='{{ route('regWithcourse', $course->slug) }}'
                                                class="nav-menu-button w-button">SELECT COURSE</a>
                                            {{-- <a wire:click='selectCourse({{ $course->id }})'
                                                class="nav-menu-button w-button">SELECT COURSE</a> --}}
                                            <a href="{{ route('courseDetail', $course->slug) }}"
                                                class="nav-menu-button w-button">VIEW COURSE</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
