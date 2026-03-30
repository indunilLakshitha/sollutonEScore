<div>
    <livewire:@livewire('comp.breadcumb')>
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Defaults -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">New User</h4>
                    </div>
                    <div class="card-body">
                        <form class="row g-4" wire:submit="save">
                            {{-- <div class="col-md-4">
                           <label for="validationDefault01" class="form-label">First name</label>
                           <input type="text" class="form-control" id="validationDefault01"   wire.model='user.first_name'/>
                       </div>
                       <div class="col-md-4">
                           <label for="validationDefault02" class="form-label">Last name</label>
                           <input type="text" class="form-control" id="validationDefault02"  wire.model='user.last_name'/>
                       </div> --}}
                            <div class="col-md-4">
                                <label for="validationDefaultUsername" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2"></span>
                                    <input type="text" class="form-control" id="validationDefaultUsername"
                                        wire:model="name" aria-describedby="inputGroupPrepend2" />

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
                                        wire:model="email" aria-describedby="inputGroupPrepend2" />
                                </div>
                                <div style="color: red">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12">

                                <button class="btn btn-primary" type="submit">
                                    SAVE
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
