@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="row px-4">
    <div class="col-md-12 mb-4 case-bar ">
        <div class="row d-flex align-items-center justify-content-between  gap-3">

            <!-- Title -->
            <div class="col-md-1">
                <p class="fw-bold fs-5 me-3 m-0 text-nowrap">User Permission</p>
            </div>

            <!-- Search -->
            <div class="col-md-6">
                <div class="case-search flex-grow-1">
                    <i class="fas fa-search"></i>
                    <input type="text" class="form-control" placeholder="Search here..." />
                </div>
            </div>

            <!-- Icons -->
            <div class="col-md-3 d-flex justify-content-end">
                <div class="d-flex gap-3 align-items-center ">
                    <i class="bi bi-filter fs-3 text-dark" role="button"></i>
                    <i class="bi bi-arrow-down-up fs-5 text-dark" role="button"></i>
                    <a href="{{ route('permission.create') }}" type="submit" class="btn btn-primary px-5 py-2">Permission</a>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Sr #</th>
                        <th>User Name</th>
                        {{-- <th>Roles</th> --}}
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($users as $key => $user)

                        <tr class="table-card-row">
                            <td>{{ $key + 1 }}</td>
                    <td>{{ $user->name }}</td>

                    <td>
                        <a href="{{ route('permission.edit', $user->id) }}"><i class="bi bi-pencil-square"></i></a>
                        <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                            <i class="bi bi-trash text-danger ms-2"></i>
                        </button>
                    </td>
                    </tr>

                    @endforeach --}}

                    @foreach($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>

                        <!-- Show Roles -->
                        {{-- <td>
                            @foreach($user->getRoleNames() as $role)
                            <span class="badge bg-primary">{{ $role }}</span>
                            @endforeach
                        </td> --}}

                        <!-- Show Permissions -->
                        <td>
                            @foreach($user->getPermissionNames() as $permission)
                            <span class="badge bg-success">{{ $permission }}</span>
                            @endforeach
                        </td>

                        <td>
                            {{-- <a href="{{ route('permission.edit', $user->id) }}">
                                <i class="fas fa-edit text-warning"></i>
                            </a> --}}
                            <form action="{{ route('permission.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none;">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
