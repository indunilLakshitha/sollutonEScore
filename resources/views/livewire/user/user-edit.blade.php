<div>
    <!--! Start:: Breadcumb !-->
    <div class="edash-content-breadcumb row mb-4 mb-md-6 pt-md-2">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h4 fw-semibold text-dark"> User</h2>
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

            </div>
        </div>
    </div>
    
    <!--! End:: Breadcumb !-->
    <div class="edash-content-section row g-3 g-md-4">
        <!-- Start:: Defaults -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update User</h4>
                </div>
                <div class="card-body">
                    <form class="row g-4" wire:submit="edit">

                        <div class="col-md-4">
                            <label for="validationDefaultUsername" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend2"></span>
                                <input type="text" class="form-control" id="validationDefaultUsername"
                                    wire:model="name" required aria-describedby="inputGroupPrepend2" />

                            </div>
                            <div style="color: red">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationDefaultUsername" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                <input type="text" class="form-control" id="validationDefaultUsername"
                                    wire:model="email" required aria-describedby="inputGroupPrepend2" />
                            </div>
                            <div style="color: red">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>


                        <div class="col-12">

                            <button class="btn btn-primary" type="submit">
                                EDIT
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
