@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">
    <div class="row px-4">
        <div class="col-12 mb-4 case-bar ">

            @foreach ($users as $user)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $user->name }} ({{ $user->email }})
                </div>
                <form method="POST" action="{{ route('permission.update', $user->id) }}">
                    <div class="card-body">
                        @csrf

                        <div class="mb-3">
                            <label>Roles:</label><br>
                            {{-- @foreach ($roles as $role)
                            <label>
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                {{ $role->name }}
                            </label><br>
                            @endforeach --}}
                        </div>

                        <div class="mb-3 float-right">
                            <label>
                                <input type="checkbox" id="selectAll"> Select All
                            </label>
                        </div>

                        {{-- <div class="mb-3">
                            <label>Permissions:</label><br>
                            @foreach ($permissions as $permission)
                            <div class="row">
                                <div class="col-12">
                                    <label>
                                        <input type="checkbox" name="permissions[]" class="item-checkbox" value="{{ $permission->name }}" @if($user->permissions->contains('name', $permission->name))
                                        checked
                                        @endif>
                                        {{ $permission->name }}
                                    </label><br>
                                </div>
                            </div>
                            @endforeach
                        </div> --}}

                        <div class="mb-3">
                            <label>Permissions:</label><br>
                            <div class="row">
                                @foreach ($permissions as $permission)
                                    <div class="col-md-4"> <!-- Show 3 per row (12/4 = 3 columns per row) -->
                                        <label>
                                            <input type="checkbox" name="permissions[]" class="item-checkbox"
                                                value="{{ $permission->name }}"
                                                @if($user->permissions->contains('name', $permission->name)) checked @endif>
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('permission.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @endsection
    @section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#selectAll').on('change', function() {
            $('.item-checkbox').prop('checked', this.checked);
        });

    </script>
    @endsection
