   <!--! ================================================================ !-->
   <!--! Start:: Header !-->
   <!--! ================================================================ !-->
   <header class="edash-header sticky-top d-flex align-items-end ht-80" id="edash-header-sticky">
       <div class="edash-header-container container-xxl w-100 ht-70 px-4 bg-body-tertiary border rounded-3 d-flex align-items-center justify-content-between position-relative"
           id="edash-header-container">
           <!--! Start:: edash-header-left !-->
           <div class="edash-header-left d-flex align-items-center gap-2">
               <!--! Start:: edash-minimenu-toggle !-->
               <div class="edash-minimenu-toggle d-none d-xl-flex">
                   <div id="edash-menu-mini">
                       <a href="javascript:void(0);"
                           class="edash-drop-item d-flex align-items-center justify-content-center rounded-pill ht-40">
                           <i class="fi fi-sr-menu-burger"></i>
                       </a>
                   </div>
                   <div id="edash-menu-expand" style="display: none">
                       <a href="javascript:void(0);"
                           class="edash-drop-item d-flex align-items-center justify-content-center rounded-pill ht-40">
                           <i class="fi fi-rr-arrow-right"></i>
                       </a>
                   </div>
               </div>
               <!--! End:: edash-minimenu-toggle !-->
               <!--! Start:: edash-menu-toggle !-->
               <div class="edash-menu-toggle d-xl-none">
                   <a href="javascript:void(0);"
                       class="edash-drop-item d-flex align-items-center justify-content-center rounded-pill ht-40"
                       id="edash-menu-show">
                       <i class="fi fi-sr-menu-burger"></i>
                   </a>
               </div>
               <!--! End:: edash-menu-toggle !-->
               <!--! Start:: edash-search-wrapper !-->
               <div class="edash-search-wrapper">
                   <a href="javascript:void(0);"
                       class="edash-drop-item d-flex align-items-center justify-content-center rounded-pill wd-40 ht-40 ms-1"
                       id="edash-search-show">
                       {{-- <i class="fi fi-rr-search"></i> --}}
                   </a>
                   <form action="#"
                       class="edash-search position-absolute start-0 top-0 end-0 bottom-0 w-100 z-1090">
                       <div class="input-group ps-3 ps-md-4 pe-md-2 bg-body-tertiary rounded-3"
                           style="height: calc(5rem - 0.75rem)">
                           <span class="input-group-text border-0">
                               <i class="fi fi-rr-search"></i>
                           </span>
                           <input type="text" class="form-control border-0 fw-medium text-muted"
                               placeholder="Search...." />
                           <span class="input-group-text border-0" id="edash-search-hide">
                               <button type="button" class="btn-close"></button>
                           </span>
                       </div>
                   </form>
               </div>
               <!--! End:: edash-search-wrapper !-->
           </div>
           <!--! End:: edash-header-left !-->
           <!--! Start:: edash-header-right !-->
           <div class="edash-header-right d-flex align-items-center gap-1 gap-sm-2">

               <!--! Start:: theme-switcher !-->
               <div class="dropdown">
                   <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                       <symbol id="sun-fill" viewBox="0 0 24 24">
                           <path
                               d="M12,17c-2.76,0-5-2.24-5-5s2.24-5,5-5,5,2.24,5,5-2.24,5-5,5Zm0-8c-1.65,0-3,1.35-3,3s1.35,3,3,3,3-1.35,3-3-1.35-3-3-3Zm1-5V1c0-.55-.45-1-1-1s-1,.45-1,1v3c0,.55,.45,1,1,1s1-.45,1-1Zm0,19v-3c0-.55-.45-1-1-1s-1,.45-1,1v3c0,.55,.45,1,1,1s1-.45,1-1ZM5,12c0-.55-.45-1-1-1H1c-.55,0-1,.45-1,1s.45,1,1,1h3c.55,0,1-.45,1-1Zm19,0c0-.55-.45-1-1-1h-3c-.55,0-1,.45-1,1s.45,1,1,1h3c.55,0,1-.45,1-1ZM6.71,6.71c.39-.39,.39-1.02,0-1.41l-2-2c-.39-.39-1.02-.39-1.41,0s-.39,1.02,0,1.41l2,2c.2,.2,.45,.29,.71,.29s.51-.1,.71-.29Zm14,14c.39-.39,.39-1.02,0-1.41l-2-2c-.39-.39-1.02-.39-1.41,0s-.39,1.02,0,1.41l2,2c.2,.2,.45,.29,.71,.29s.51-.1,.71-.29Zm-16,0l2-2c.39-.39,.39-1.02,0-1.41s-1.02-.39-1.41,0l-2,2c-.39,.39-.39,1.02,0,1.41,.2,.2,.45,.29,.71,.29s.51-.1,.71-.29ZM18.71,6.71l2-2c.39-.39,.39-1.02,0-1.41s-1.02-.39-1.41,0l-2,2c-.39,.39-.39,1.02,0,1.41,.2,.2,.45,.29,.71,.29s.51-.1,.71-.29Z">
                           </path>
                       </symbol>
                       <symbol id="moon-stars-fill" viewBox="0 0 24 24">
                           <path
                               d="M15,24a12.021,12.021,0,0,1-8.914-3.966,11.9,11.9,0,0,1-3.02-9.309A12.122,12.122,0,0,1,13.085.152a13.061,13.061,0,0,1,5.031.205,2.5,2.5,0,0,1,1.108,4.226c-4.56,4.166-4.164,10.644.807,14.41a2.5,2.5,0,0,1-.7,4.32A13.894,13.894,0,0,1,15,24Zm.076-22a10.793,10.793,0,0,0-1.677.127,10.093,10.093,0,0,0-8.344,8.8A9.927,9.927,0,0,0,7.572,18.7,10.476,10.476,0,0,0,18.664,21.43a.5.5,0,0,0,.139-.857c-5.929-4.478-6.4-12.486-.948-17.449a.459.459,0,0,0,.128-.466.49.49,0,0,0-.356-.361A10.657,10.657,0,0,0,15.076,2Z">
                           </path>
                       </symbol>
                       <symbol id="circle-half" viewBox="0 0 24 24">
                           <path
                               d="M12,0C5.38,0,0,5.38,0,12s5.38,12,12,12,12-5.38,12-12S18.62,0,12,0Zm0,22V2c5.51,0,10,4.49,10,10s-4.49,10-10,10Z">
                           </path>
                       </symbol>
                   </svg>
                   <a href="javascript:void(0);"
                       class="edash-drop-item d-flex align-items-center justify-content-center rounded-pill wd-40 ht-40"
                       id="bd-theme" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (dark)"
                       data-bs-auto-close="outside" data-bs-offset="0, 19">
                       <svg class="theme-icon-active wd-20 ht-20" fill="currentColor">
                           <use href="#moon-stars-fill"></use>
                       </svg>
                   </a>
                   <ul class="dropdown-menu dropdown-menu-end min-wd-200">
                       <li>
                           <a href="javascript:void(0);" class="dropdown-item" data-bs-theme-value="light">
                               <svg class="theme-icon" fill="currentColor" width="16" height="16">
                                   <use href="#sun-fill"></use>
                               </svg>
                               <span class="ms-3">Light</span>
                           </a>
                       </li>
                       <li>
                           <a href="javascript:void(0);" class="dropdown-item" data-bs-theme-value="dark">
                               <svg class="theme-icon" fill="currentColor" width="16" height="16">
                                   <use href="#moon-stars-fill"></use>
                               </svg>
                               <span class="ms-3">Dark</span>
                           </a>
                       </li>
                       <li>
                           <a href="javascript:void(0);" class="dropdown-item" data-bs-theme-value="auto">
                               <svg class="theme-icon" fill="currentColor" width="16" height="16">
                                   <use href="#circle-half"></use>
                               </svg>
                               <span class="ms-3">Auto</span>
                           </a>
                       </li>
                   </ul>
               </div>
               <!--! End:: theme-switcher !-->
               <!--! Start:: edash-notifications !-->
               {{-- <div class="dropdown">
                   <a href="javascript:void(0);"
                       class="edash-drop-item d-flex align-items-center justify-content-center rounded-pill wd-40 ht-40"
                       data-bs-toggle="dropdown" data-bs-auto-close="outside" data-bs-offset="0, 19">
                       <i class="fi fi-rr-bell"></i>
                       <div class="position-absolute top-10 start-50 translate-middle wd-6 ht-6 bg-danger rounded-circle"
                           data-bs-toggle="tooltip" data-bs-trigger="hover" title="12+ Unread Notification">
                       </div>
                   </a>
                   <div class="dropdown-menu dropdown-menu-end dropdown-xl p-0 overflow-hidden">
                       <div class="bg-primary text-white px-4 py-4">
                           <h5 class="fw-semibold text-white mb-1">
                               <span>Notifications</span>
                               <span class="badge bg-warning ms-1 rounded-pill">12+</span>
                           </h5>
                           <p class="fs-13 mb-0">You have 12+ unread notification</p>
                       </div>
                       <div class="list-group list-group-flush ht-300 position-relative init-perfect-scroll-bar">
                           <a href="javascript:void(0);" class="list-group-item d-flex position-relative">
                               <div class="avatar avatar-lg bg-danger-subtle rounded flex-shrink-0">
                                   <i class="fi fi-rr-megaphone text-danger"></i>
                               </div>
                               <div class="media-body flex-grow-1 ms-3">
                                   <p class="fw-normal mb-1">
                                       Congratulate
                                       <span class="fw-semibold text-dark">Socrates Itumay</span> for
                                       work anniversaries
                                   </p>
                                   <span class="fs-12 fw-normal text-muted">Mar 15 12:32pm</span>
                               </div>
                               <div class="position-absolute top-40 translate-middle wd-5 ht-5 bg-primary rounded-circle"
                                   style="left: 0.75rem" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                   title="Unread Notification"></div>
                           </a>
                           <a href="javascript:void(0);" class="list-group-item d-flex position-relative">
                               <div class="avatar avatar-lg bg-warning-subtle rounded flex-shrink-0">
                                   <i class="fi fi-rr-edit text-warning"></i>
                               </div>
                               <div class="media-body flex-grow-1 ms-3">
                                   <p class="fw-normal mb-1">
                                       <span class="fw-semibold text-dark">Althea Cabardo</span> just
                                       created a new blog post
                                   </p>
                                   <span class="fs-12 fw-normal text-muted">Mar 13 02:56am</span>
                               </div>
                               <div class="position-absolute top-40 translate-middle wd-5 ht-5 bg-primary rounded-circle"
                                   style="left: 0.75rem" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                   title="Unread Notification"></div>
                           </a>
                           <a href="javascript:void(0);" class="list-group-item d-flex">
                               <div class="avatar avatar-lg bg-info-subtle rounded flex-shrink-0">
                                   <i class="fi fi-rr-comment-alt-dots text-info"></i>
                               </div>
                               <div class="media-body flex-grow-1 ms-3">
                                   <p class="fw-normal mb-1">
                                       <span class="fw-semibold text-dark">Adrian Monino</span> added
                                       new comment on your photo
                                   </p>
                                   <span class="fs-12 fw-normal text-muted">Mar 12 10:40pm</span>
                               </div>
                           </a>
                           <a href="javascript:void(0);" class="list-group-item d-flex">
                               <div class="avatar avatar-lg bg-success-subtle rounded flex-shrink-0">
                                   <i class="fi fi-rr-badge-check text-success"></i>
                               </div>
                               <div class="media-body flex-grow-1 ms-3">
                                   <p class="fw-normal mb-1">
                                       <span class="fw-semibold text-dark">Kenneth Hune</span>
                                       accepted your request
                                   </p>
                                   <span class="fs-12 fw-normal text-muted">Mar 13 02:56am</span>
                               </div>
                           </a>
                           <a href="javascript:void(0);" class="list-group-item d-flex border-bottom-0">
                               <div class="avatar avatar-lg bg-warning-subtle rounded flex-shrink-0">
                                   <i class="fi fi-rr-file-medical-alt text-warning"></i>
                               </div>
                               <div class="media-body flex-grow-1 ms-3">
                                   <p class="fw-normal mb-1">
                                       December monthly financial <strong>report</strong> is
                                       generated
                                   </p>
                                   <span class="fs-12 fw-normal text-muted">Mar 12 10:40pm</span>
                               </div>
                           </a>
                       </div>
                       <div class="px-4 py-3 border-top d-flex justify-content-between align-items-center">
                           <a href="javascript:void(0);">Make as Read</a>
                           <a href="javascript:void(0);" class="icon-link icon-link-hover">
                               <span>View Alls</span>
                               <i class="fi fi-rr-arrow-small-right bi"></i>
                           </a>
                       </div>
                   </div>
               </div> --}}
               <!--! End:: edash-notifications !-->

               <!--! Start:: edash-profile !-->
               <div class="dropdown">
                   <a href="javascript:void(0);"
                       class="edash-drop-item d-flex align-items-center justify-content-center rounded-pill wd-40 ht-40"
                       data-bs-toggle="dropdown" data-bs-auto-close="outside" data-bs-offset="0, 19">
                       <div class="avatar avatar-md rounded-circle">
                           <img src="{{ asset('assets/images/avatar/1.png') }}" alt="Avatar"
                               class="img-fluid rounded-circle" />
                           <div class="avatar-indicator active"></div>
                       </div>
                   </a>
                   <div class="dropdown-menu dropdown-menu-end dropdown-md p-0">
                       <div class="px-4 py-3 d-flex border-bottom">
                           <div class="avatar avatar-md flex-shrink-0">
                               <img src="{{ asset('assets/images/avatar/1.png') }}" alt="Avatar"
                                   class="img-fluid rounded" />
                           </div>
                           <div class="flex-grow-1 ms-3">

                               <h6 class="text-dark mb-1">{{ Auth::user()->name }}</h6>
                               <span class="fs-13 text-muted"></span>
                           </div>
                       </div>
                       <div class="px-2 py-3">
                           <a href="{{ route('profile.edit.custom') }}" class="dropdown-item">
                               <i class="fi fi-rs-user"></i>
                               <span class="ms-3">Profile</span>
                           </a>
                           {{-- <a href="./account-activity.html" class="dropdown-item">
                               <i class="fi fi-rr-pulse"></i>
                               <span class="ms-3">Activity</span>
                           </a>
                           <a href="./account-project.html" class="dropdown-item">
                               <i class="fi fi-rr-file-invoice-dollar"></i>
                               <span class="ms-3">Projects</span>
                           </a>
                           <div class="dropdown-divider"></div>
                           <a href="./general-pricing.html" class="dropdown-item">
                               <i class="fi fi-rr-usd-circle"></i>
                               <span class="ms-3">Pricing</span>
                           </a>
                           <a href="./settings-account.html" class="dropdown-item">
                               <i class="fi fi-rr-settings"></i>
                               <span class="ms-3">Settings</span>
                           </a>
                           <a href="./general-helpdesk.html" class="dropdown-item">
                               <i class="fi fi-rr-seal-question"></i>
                               <span class="ms-3">Helpdesk</span>
                           </a> --}}
                           <div class="dropdown-divider"></div>
                           <!-- Authentication -->
                           <form method="POST" action="{{ route('logout') }}" x-data>
                               @csrf

                               <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                   {{ __('Log Out') }}
                               </x-dropdown-link>
                           </form>
                       </div>
                   </div>
               </div>
               <!--! End:: edash-profile !-->
           </div>
           <!--! End:: edash-header-right !-->
       </div>
   </header>
