<div>
    <!--! Start:: Breadcumb !-->
    <div class="edash-content-breadcumb row mb-4 mb-md-6 pt-md-2">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h4 fw-semibold text-dark">{{ $title }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">{{ $section }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">{{ $sub }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $action }}
                            </li>
                        </ol>
                    </nav>
                </div>
                {{-- <div class="d-flex align-items-center gap-2">
                 <a
                   href="https://getbootstrap.com/docs/5.3/forms/validation/"
                   class="btn btn-md btn-primary"
                   target="_blank"
                   >Official Docs</a
                 >
               </div> --}}
            </div>
        </div>
    </div>
    <!--! End:: Breadcumb !-->
</div>
