<div>
     <!--! Start:: Breadcumb !-->
     <div class="edash-content-breadcumb row mb-4 mb-md-6 pt-md-2">
        <div class="col-12">
          <div class="d-flex align-items-center justify-content-between">
            <div>
              <h2 class="h4 fw-semibold text-dark">Validation</h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Components</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Forms</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Validation
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
    <div class="edash-content-section row g-3 g-md-4">
        <!-- Start:: Defaults -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Defaults</h4>
                </div>
                <div class="card-body">
                    <form class="row g-4">
                        <div class="col-md-4">
                            <label for="validationDefault01" class="form-label">Course Name</label>
                            <input type="text" class="form-control" id="validationDefault01" wire.model />
                        </div>
                        <div class="col-md-4">
                            <label for="validationDefault02" class="form-label">Description</label>
                            <input type="text" class="form-control" id="validationDefault02" wire.model />
                        </div>
                        {{-- <div class="col-md-4">
                            <label for="validationDefaultUsername" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                <input type="text" class="form-control" id="validationDefaultUsername"
                                    aria-describedby="inputGroupPrepend2" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="validationDefault03" class="form-label">City</label>
                            <input type="text" class="form-control" id="validationDefault03" required />
                        </div>
                        <div class="col-md-3">
                            <label for="validationDefault04" class="form-label">State</label>
                            <select class="form-select" id="validationDefault04" required>
                                <option selected disabled value="">Choose...</option>
                                <option>One</option>
                                <option>Two</option>
                                <option>Three</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="validationDefault05" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="validationDefault05" required />
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2"
                                    required />
                                <label class="form-check-label" for="invalidCheck2">
                                    Agree to terms and conditions
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">
                                Submit form
                            </button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
