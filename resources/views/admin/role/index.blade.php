@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-4">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
        <div class="col-md-1">
            <p class="fw-bold fs-5 me-3 m-0">Roles</p>
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
                    <a href="{{ route('role.create') }}" type="submit" class="btn btn-primary px-5 py-2">Role</a>

                    {{-- <a href="{{ route('department.create') }}" type="submit" class="btn btn-primary px-5 py-2">Department</a   > --}}
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
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)

                        <tr class="table-card-row">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $role->name }}</td>

                            <td>
                                <a href="{{ route('role.edit', $role->id) }}"><i class="bi bi-pencil-square"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $role->id }}"><i class="bi bi-trash  text-danger ms-2"></i></button>
                            </td>
                        </tr>

                         <!-- Modal -->
                         <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('role.destroy', $role->id) }}">
                                @csrf
                                @method('DELETE')
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <i class="bi bi-trash text-danger"></i>&nbsp;
                                            <h1 class="modal-title fs-6 text-dark text-gray" id="exampleModalLabel">Delete</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <small>Are you sure want to delete? This action cannot be undone.</small>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
