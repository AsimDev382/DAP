{{-- @extends('admin.layouts.adminlayout')
@section('main-content')

<div class="container mt-4">
    <form method="POST" action="{{ route('permission.assign') }}">
        @csrf

        <div class="form-group mb-3">
            <label>Select User:</label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        @foreach ($permissions as $module => $group)
        <div class="card mb-3">
            <div class="card-header">
                <strong>{{ $module }}</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($group as $permission)
                    <div class="col-md-3">
                        <label>
                            <input type="checkbox" name="permissions[]" class="item-checkbox"
                                value="{{ $permission->name }}">
                            {{ ucwords($permission->name) }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Assign Permissions</button>
    </form>
</div>

@endsection --}}


@extends('admin.layouts.adminlayout')
@section('main-content')
    <div class="main-content">
        <div class="row px-4">
            <div class="col-12 mb-4 case-bar">

                <div class="card mb-3">

                    <form method="POST" action="{{ route('permission.assign') }}">
                        <div class="card-body">
                            @csrf


                            <div class="form-group mb-3">
                                <label>Select User:</label>
                                <select name="user_id" class="form-control" id="userSelect" required>
                                    <option value="">-- Select User --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @foreach ($permissions as $module => $group)
                                <div class="permission-group mb-3">
                                    <div class="">
                                        <strong class="header" style="cursor: pointer;">{{ $module }}</strong>
                                    </div>
                                    <div class="submenu-container" style="display: none;">
                                        <div class="row">
                                            @foreach ($group as $permission)
                                                <div class="col-12 sub_menu">
                                                    <label>
                                                        <input type="checkbox" name="permissions[]"
                                                            class="item-checkbox permission-checkbox"
                                                            value="{{ $permission->name }}"
                                                            id="perm_{{ Str::slug($permission->name, '_') }}">
                                                        {{ ucwords($permission->name) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('permission.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $('.header').on('click', function() {
                $(this).closest('.permission-group').find('.submenu-container').slideToggle();
            });


            // Get Permission
            $('#userSelect').on('change', function() {
                let userId = $(this).val();

                // Uncheck all checkboxes first
                $('.permission-checkbox').prop('checked', false);

                if (userId) {
                    $.ajax({
                        url: '/get-user-permissions/' + userId,
                        type: 'GET',
                        success: function(response) {
                            response.permissions.forEach(function(perm) {
                                // Check the checkbox that matches the permission
                                $("input.permission-checkbox[value='" + perm + "']").prop('checked',
                                    true);
                            });
                        },
                        error: function() {
                            alert('Could not load permissions.');
                        }
                    });
                }
            });
        </script>
    @endsection

