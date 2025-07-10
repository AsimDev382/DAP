@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-4">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
        <div class="col-md-1">
            <p class="fw-bold fs-5 me-3 m-0">Groups</p>
        </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="groupSearch" placeholder="Search here..." />
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
                    @can('create department')
                        <a href="{{ route('group.create') }}" class="btn btn-primary px-5 py-2">Group</a>
                    @endcan
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
                            <th>Group Name</th>
                            <th>Total Group Member</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="groupTableBody">
                        @forelse($groups as $key => $group)

                        <tr class="table-card-row">
                            <td>{{ $key + 1 }}</td>
                            <td><a href="{{ route('group.view', $group->id) }}">{{ $group->group_name }}</a></td>
                            <td>{{ $group->user->name }}</td>
                            <td>
                                <span
                                    class="badge toggle-status {{ $group->status === 'Active' ? 'text-bg-success' : 'text-bg-danger' }}"
                                    data-id="{{ $group->id }}"
                                    data-status="{{ $group->status }}"
                                    style="cursor: pointer;">
                                    {{ $group->status }}
                                </span>
                            </td>
                            <td>
                                @can('edit group')
                                    <a href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('group.edit', $group->id) }}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;
                                @endcan

                                @can('view groups')
                                <a href="{{ route('group.view', $group->id) }}"><i class="bi bi-eye"></i></a>
                                @endcan

                                @can('delete group')
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $group->id }}"><i class="bi bi-trash  text-danger ms-2"></i></button>
                                @endcan
                            </td>
                        </tr>

                         <!-- Modal -->
                         <div class="modal fade" id="deleteModal{{ $group->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('group.destroy', $group->id) }}">
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
            url: '/groups/update-status/' + id,
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
    $('#groupSearch').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        let hasVisible = false;

        // Loop through all rows except the "no data" row
        $('#groupTableBody tr').each(function () {
            if (!$(this).attr('id')) {
                let match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) hasVisible = true;
            }
        });

        // If no visible rows, show the noDataRow (create it if it doesn't exist)
        if (!hasVisible) {
            if ($('#noDataRow').length === 0) {
                $('#groupTableBody').append(`
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
        var currentOrder = $(this).attr('data-order');
        var newOrder = currentOrder === 'desc' ? 'asc' : 'desc';
        $(this).attr('data-order', newOrder);

        filterGroup(newOrder);
    });

    function filterGroup(sortOrder) {
        $.ajax({
            url: '{{ url("groups/sort") }}',
            type: 'GET',
            data: {
                sortFilter: sortOrder
            },
            success: function(response) {
                $('#groupTableBody').empty();

                if (response.length > 0) {
                    $.each(response, function(index, groups) {
                        let statusBadge = '';
                        if (groups.status === 'Active') {
                            statusBadge = `<span class="badge text-bg-success toggle-status" data-id="${groups.id}" data-status="${groups.status}" style="cursor: pointer;">${groups.status}</span>`;
                        } else {
                            statusBadge = `<span class="badge text-bg-danger toggle-status" data-id="${groups.id}" data-status="${groups.status}" style="cursor: pointer;">${groups.status}</span>`;
                        }

                        $('#groupTableBody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${groups.group_name}</td>
                                <td>${groups.user.name}</td>
                                <td>${statusBadge}</td>
                                <td>
                                    <a href="/groups/${groups.id}/edit"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a href="/groups/view/${groups.id}"><i class="bi bi-eye"></i></a>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal${groups.id}">
                                        <i class="bi bi-trash text-danger ms-2"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#groupTableBody').append('<tr><td colspan="12" class="text-center">No records found.</td></tr>');
                }
            }
        });
    }
});

</script>

@endsection
