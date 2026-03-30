<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Assign Users to Criteria: {{ $criteria->name }}</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="search_text" class="form-label">Search Users</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search users by name or ID..."
                        wire:input='searchUsers' wire:model='search_text' id="search_text">
                </div>
                <div class="panel-footer">
                    @foreach ($availableUsers as $user)
                        <div style="width: 400px; background-color : white">

                            <ul class="list-group" id="available_list"
                                style="max-height: 400px; overflow-y: auto;   padding: 10px; font-color : black"
                                wire:click='assignUser({{ $user->id }})'>
                                {{ $user->first_name . ' ' . $user->last_name . ' ' . $user->id }}
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Show assigned users -->
            <div class="mt-4">
                <h5>Assigned Users</h5>
                @if ($assignedUsersList->count() > 0)
                    <div class="list-group">
                        @foreach ($assignedUsersList as $user)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong></strong> (ID: {{ $user->id }})
                                    {{-- @if ($user->email)
                                        <br><small>{{ $user->email }}</small>
                                    @endif --}}
                                    <span class="badge bg-success">COMPLETED</span>
                                </div>
                                <button class="btn btn-danger btn-sm" wire:click='delete({{ $user->id }})'
                                    wire:confirm="Are you sure you want to Remove this User from List?" type="button">
                                    REMOVE
                                </button>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No users assigned yet.</p>
                @endif
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
            overflow-y: scroll
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

    async function sent() {

        var text = document.getElementById('search_text').value;
        var keyword = text.toLowerCase();
        var filtered_data = [];

        var data = {!! json_encode($all_available ?? [], JSON_HEX_TAG) !!}

        data.forEach(user => {
            var str = user.unique_id.toLowerCase();
            var str_2 = user.first_name.toLowerCase();
            var str_3 = user.last_name.toLowerCase();
            if (str.includes(keyword) || str_2.includes(keyword) || str_3.includes(keyword)) {
                filtered_data.push(user);
            }
        });
        document.getElementById('available_list').innerHTML = '';

        await filtered_data.forEach(user => {
            const newLi = document.createElement('li');
            var dt = JSON.stringify(user);
            newLi.innerHTML =
                ` <li class="list-group-item" @click='setPath(${ dt })'>
                                                ${user.first_name}   ${user.last_name} - ${user.type}
                                            </li>`;

            document.getElementById('available_list').appendChild(newLi);
        });

    }
</script>
