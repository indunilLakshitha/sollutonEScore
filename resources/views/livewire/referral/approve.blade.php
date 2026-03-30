<div>
    <livewire:comp.breadcumb title="REFERRALS" section="User" sub="Referrals" action="Approve">
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Defaults -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Approve -
                            {{ $user->first_name . ' ' . $user->last_name }}</h4>
                    </div>
                    <div class="card-body">
                        <form class="row g-4">
                            {{-- <form class="row g-4" wire:submit="approve"> --}}
                            <div class="col-md-3 form-group col-sm-6">
                                <label for="validationDefault04" class="form-label">Path</label>
                                {{-- <select class="form-select" id="validationDefault04" required wire:model='assigned_to'
                                    wire:change='selectPath'>
                                    <option selected value="">Choose...</option>
                                    @foreach ($path_list as $p)
                                        <option value="{{ $p->id }}">{{ $p->id }}
                                        </option>
                                    @endforeach
                                </select> --}}
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                                    <input type="text" class="form-control" @input="sent()" @focus="sent()"
                                        wire:model='keyword' id="search_text" />
                                </div>
                                <input type="hidden" class="form-control" wire:model='assigned_to' id="assigned_to" />
                                {{-- <input type="text" class="form-control" wire:input='getPathBySearch()'
                                    wire:focus='getPathBySearch()' wire:model='keyword' /> --}}
                                <div class="panel-footer">
                                    <ul class="list-group" id="available_list"
                                        style="max-height: 400px; overflow-y: auto;   padding: 10px;">


                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="validationDefault04" class="form-label">Agent</label>
                                <select class="form-select" required wire:model='assigned_user_side' id="agent_list">
                                    <option selected value="">Choose...</option>
                                    {{-- @if ($A1_active)
                                        <option value="A1">Agent A1</option>
                                    @endif
                                    @if ($A2_active)
                                        <option value="A2">Agent A2</option>
                                    @endif --}}
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefault01" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="validationDefault01"
                                    wire:model='first_name' disabled />
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefault01" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="validationDefault01"
                                    wire:model='last_name' disabled />
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefault01" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="validationDefault01" wire:model='reg_no'
                                    disabled />
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefault02" class="form-label">Contact No</label>
                                <input type="text" class="form-control" id="validationDefault02"
                                    wire:model='mobile_no' disabled />
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefaultUsername" class="form-label">Email ID</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                    <input type="text" class="form-control" id="validationDefaultUsername"
                                        wire:model='email' aria-describedby="inputGroupPrepend2" required disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefault03" class="form-label">NIC No</label>
                                <input type="text" class="form-control" id="validationDefault03" required disabled
                                    wire:model='nic' />
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefault03" class="form-label">Address</label>
                                <input type="text" class="form-control" id="validationDefault03" required disabled
                                    wire:model='address' />
                            </div>
                            <div class="col-md-6">
                                <label for="validationDefault03" class="form-label">Course</label>
                                <input type="text" class="form-control" id="validationDefault03" disabled
                                    wire:model='course' />
                            </div>
                            {{-- <div class="col-md-3">
                                <label for="validationDefault04" class="form-label">TYPE</label>
                                <select class="form-select" id="validationDefault04" required wire:model='payment_type' >
                                    <option value="FULL" selected>FULL</option>
                                    <option value="HALF">HALF</option>
                                </select>
                            </div> --}}
                            <div class="col-12">
                                <button class="btn btn-primary" type="button" @click="approveUser()" id="btn_approve">
                                    Approve User
                                </button>
                                {{-- <button class="btn btn-primary" type="submit"{{ !$submit_active ? 'disabled' : '' }}>
                                    Approve User
                                </button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <style>
                .panel-footer {
                    position: absolute;
                    width: calc(100% - 30px);
                    z-index: 9;
                }

                .cus-list {
                    max-height: 400px !important;
                    overflow-y:scroll
                }

                .form-group {
                    position: relative;
                }

                .remove-padding {
                    padding: 5px 5px 5px 5px !important;
                }
            </style>
        </div>

        <script>
            var global_selected_user;
            var searchTimeout;

            async function sent() {
                var text = document.getElementById('search_text').value;
                var keyword = text.trim();

                // Clear previous timeout
                if (searchTimeout) {
                    clearTimeout(searchTimeout);
                }

                // Debounce search to avoid too many requests
                searchTimeout = setTimeout(async function() {
                    document.getElementById('available_list').innerHTML = '<li class="list-group-item">Searching...</li>';

                    try {
                        // Call search endpoint
                        const response = await axios.get('/dashboard/referrals/search-users', {
                            params: { keyword: keyword }
                        });

                        const users = response.data.success ? response.data.users : [];

                        document.getElementById('available_list').innerHTML = '';

                        if (users.length === 0) {
                            document.getElementById('available_list').innerHTML = '<li class="list-group-item">No users found</li>';
                            return;
                        }

                        users.forEach(user => {
                            const newLi = document.createElement('li');
                            newLi.className = 'list-group-item';
                            newLi.style.cursor = 'pointer';
                            newLi.innerHTML = `${user.first_name} ${user.last_name} - ${user.type}`;
                            newLi.onclick = function() {
                                setPath(user);
                            };
                            document.getElementById('available_list').appendChild(newLi);
                        });
                    } catch (error) {
                        console.error('Search error:', error);
                        document.getElementById('available_list').innerHTML = '<li class="list-group-item text-danger">Error searching users</li>';
                    }
                }, 300); // 300ms debounce
            }

            function setPath(selected_user) {


                document.getElementById('search_text').value = selected_user.name + ' - ' + selected_user.unique_id;
                document.getElementById('assigned_to').value = selected_user.id;
                document.getElementById('available_list').innerHTML = '';
                document.getElementById('agent_list').innerHTML = '';
                global_selected_user = selected_user;
                const select = document.getElementById('agent_list');
                var option = [];
                if (selected_user.er_status == 4) {
                    options = [{
                            value: 'A1',
                            text: 'Agent A1'
                        },
                        {
                            value: 'A2',
                            text: 'Agent A2'
                        }
                    ];
                } else {
                    options = [{
                        value: 'A1',
                        text: 'Agent A1'
                    }];
                }

                options.forEach(option => {
                    const newOption = document.createElement('option');
                    newOption.value = option.value;
                    newOption.text = option.text;
                    select.appendChild(newOption);
                });

            }

            function approveUser() {

                document.getElementById('btn_approve').disabled = true;

                axios.post('/dashboard/referrals/approve-user', {
                        logged_user_id: "{{ $logged_user_id }}",
                        approval_pending_user_id: "{{ $approval_pending_user_id }}",
                        selected_user: global_selected_user,
                        asigned_user_side: document.getElementById('agent_list').value,
                    })
                    .then(response => {
                        console.log('Response:', response.data);
                        if (response.data.success) {
                            Swal.fire("Done!", "", "success");
                            window.location.href = '/dashboard/referrals/pending';
                        } else if (response.data.success == false) {

                            Swal.mixin({
                                toast: !0,
                                position: "top-end",
                                showConfirmButton: !1,
                                timer: 3e3,
                                timerProgressBar: !0,
                                didOpen: function didOpen(t) {
                                    t.addEventListener("mouseenter", Swal.stopTimer), t.addEventListener(
                                        "mouseleave",
                                        Swal.resumeTimer);
                                }
                            }).fire({
                                icon: "error",
                                title: 'PLEASE CONTACT ADMIN'
                            });

                            window.location.href = '/dashboard/referrals/pending';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.mixin({
                            toast: !0,
                            position: "top-end",
                            showConfirmButton: !1,
                            timer: 3e3,
                            timerProgressBar: !0,
                            didOpen: function didOpen(t) {
                                t.addEventListener("mouseenter", Swal.stopTimer), t.addEventListener(
                                    "mouseleave",
                                    Swal.resumeTimer);
                            }
                        }).fire({
                            icon: "error",
                            title: 'PLEASE CONTACT ADMIN'
                        });

                        window.location.href = '/dashboard/referrals/pending';
                    });
            }
        </script>
