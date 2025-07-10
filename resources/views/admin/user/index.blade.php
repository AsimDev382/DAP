@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row p-3">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
                <div class="col-md-1 text-nowrap">
                    <p class="fw-bold fs-5 me-0 m-0">User Management</p>
                </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="userSearch" placeholder="Search here..." />
                    </div>
                </div>

                <!-- Icons -->
                <div class="col-md-3 d-flex justify-content-end">
                    <div class="d-flex gap-3 align-items-center ">
                        <i class="bi bi-filter fs-3 text-dark" role="button"></i>
                        {{-- <i class="bi bi-arrow-down-up fs-5 text-dark" role="button"></i> --}}
                        <div class="sort-button" style="cursor: pointer;">
                            <i class="bi bi-arrow-down-up fs-5 text-dark" id="sortToggle" data-order="desc"></i>
                        </div>

                        @can('create user')
                            <a href="{{ route('user.create') }}" type="submit" class="btn btn-primary px-3 py-2">Add User</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table align-middle text-center">
                  <thead class="table-light">
                    <tr>
                      <th>Sr #</th>
                      <th>User ID</th>
                      <th>User Name</th>
                      <th>Mobile/Phone</th>
                      <th>Email</th>
                      <th>Location</th>
                      <th>Company Name</th>
                      <th>Last Login</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="userTableBody">
                    @forelse ($users as $key => $user)

                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $user->auto_id }}</td>
                      <td>
                       <a href="{{ route('user.view', $user->id) }}"> {{ $user->name }}</a>
                    </td>
                      <td>{{ $user->user_phone }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->user_location }}</td>
                      <td>{{ @$user->company->company_name }}</td>
                      <td>{{ $user->created_at }}</td>

                      <td>
                        <span
                            class="badge toggle-status {{ $user->status === 'Active' ? 'text-bg-success' : 'text-bg-danger' }}"
                            data-id="{{ $user->id }}"
                            data-status="{{ $user->status }}"
                            style="cursor: pointer;">
                            {{ $user->status }}
                        </span>
                        </td>
                        <td>
                            @can('edit user')
                            <a href="#"
                                data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('user.edit', $user->id) }}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;
                            @endcan
                            @can('view user')
                            <a href="{{ route('user.view', $user->id) }}"><i class="bi bi-eye"></i></a>
                            @endcan
                            {{-- <button data-bs-toggle="modal" data-id="{{ route('user.destroy', $user->auto_id) }}" data-bs-target="#exampleModal"><i class="bi bi-trash  text-danger ms-2"></i></button> --}}
                            @can('delete user')
                            <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                <i class="bi bi-trash text-danger ms-2"></i>
                            </button>
                            @endcan
                        </td>
                    </tr>

                     <!-- Modal -->
                     <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="{{ route('user.destroy', $user->id) }}">
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

                    @empty
                        <tr id="noDataRow">
                            <td class="text-center">No records found</td>
                        </tr>
                    @endforelse

                  </tbody>
                </table>
              </div>

        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    $(document).on('click', '.toggle-status', function () {
        let span = $(this);
        let id = span.data('id');
        let currentStatus = span.data('status');

        $.ajax({
            url: '/user/update-status/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: currentStatus
            },
            success: function (response) {
                span.text(response.status);
                span.data('status', response.status);

                if (response.status === 'Active') {
                    span.removeClass('text-bg-danger').addClass('text-bg-success');
                } else {
                    span.removeClass('text-bg-success').addClass('text-bg-danger');
                }
            }
        });
    });



    // Searching filter
    $(document).ready(function () {
        $('#userSearch').on('keyup', function () {
            let value = $(this).val().toLowerCase();
            let hasVisible = false;

            // Loop through all rows except the "no data" row
            $('#userTableBody tr').each(function () {
                if (!$(this).attr('id')) {
                    let match = $(this).text().toLowerCase().indexOf(value) > -1;
                    $(this).toggle(match);
                    if (match) hasVisible = true;
                }
            });

            // If no visible rows, show the noDataRow (create it if it doesn't exist)
            if (!hasVisible) {
                if ($('#noDataRow').length === 0) {
                    $('#userTableBody').append(`
                        <tr id="noDataRow">
                            <td colspan="12" class="text-center">No records found</td>
                        </tr>
                    `);
                } else {
                    $('#noDataRow').show();
                }
            } else {
                $('#noDataRow').hide();
            }
        });
    });




    // Sorting Filter

    $(document).ready(function() {
        $('#sortToggle').on('click', function() {
            // Toggle order value
            var currentOrder = $(this).attr('data-order');
            var newOrder = currentOrder === 'desc' ? 'asc' : 'desc';
            $(this).attr('data-order', newOrder);

            filterUser(newOrder);
        });

        function filterUser(sortOrder) {
            $.ajax({
                url: '{{ route("user.sort") }}',
                type: 'GET',
                data: {
                    sortFilter: sortOrder
                },
                success: function(response) {
                    $('#userTableBody').empty();

                    if (response.length > 0) {
                        $.each(response, function(index, user) {
                            let statusBadge = '';
                            if (user.status === 'Active') {
                                statusBadge = `<span class="badge text-bg-success toggle-status" data-id="${user.id}" data-status="${user.status}" style="cursor: pointer;">${user.status}</span>`;
                            } else {
                                statusBadge = `<span class="badge text-bg-danger toggle-status" data-id="${user.id}" data-status="${user.status}" style="cursor: pointer;">${user.status}</span>`;
                            }

                            let logoUrl = user.user_logo ? `/storage/${user.user_logo}` : '';

                            $('#userTableBody').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${user.auto_id}</td>
                                    <td>${user.name}</td>
                                    <td>${user.user_phone}</td>
                                    <td>${user.email}</td>
                                    <td>${user.user_location}</td>
                                    <td>${user.company.company_name}</td>
                                    <td><i class="fa-regular fa-calendar"></i> ${user.created_at}</td>
                                    <td>${statusBadge}</td>
                                    <td>
                                        <a href="/user/${user.id}/edit"><i class="bi bi-pencil-square"></i></a>
                                        <button data-bs-toggle="modal" data-bs-target="#deleteModal${user.id}">
                                            <i class="bi bi-trash text-danger ms-2"></i>
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#userTableBody').append('<tr><td colspan="11" class="text-center">No records found.</td></tr>');
                    }
                }
            });
        }
    });
</script>

@endsection
