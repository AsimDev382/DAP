@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-4">
        <div class="col-md-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
        <div class="col-md-1">
            <p class="fw-bold fs-5 me-0 m-0 text-nowrap">Sub Departments</p>
        </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="subdepartmentSearch" placeholder="Search here..." />
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

                    @can('create sub department')
                    <a href="{{ route('sub-department.create') }}" type="submit" class="btn btn-primary px-2 py-2">Sub Department</a>
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
                            <th>Department Name</th>
                            <th>Department Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="subDepartmentTableBody">
                        @forelse($departments as $key => $department)

                        <tr class="table-card-row">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $department->sub_name }}</td>
                            <td>{{ $department->sub_location }}</td>

                            <td>
                                @can('edit sub department')
                                    <a href="{{ route('sub-department.edit', $department->id) }}"><i class="bi bi-pencil-square"></i></a>
                                @endcan
                                @can('delete sub department')
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $department->id }}"><i class="bi bi-trash  text-danger ms-2"></i></button>
                                @endcan
                            </td>
                        </tr>

                         <!-- Modal -->
                         <div class="modal fade" id="deleteModal{{ $department->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('sub-department.destroy', $department->id) }}">
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
            url: '/department/update-status/' + id,
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
    $('#subdepartmentSearch').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        let hasVisible = false;

        // Loop through all rows except the "no data" row
        $('#subdepartmentTableBody tr').each(function () {
            if (!$(this).attr('id')) {
                let match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) hasVisible = true;
            }
        });

        // If no visible rows, show the noDataRow (create it if it doesn't exist)
        if (!hasVisible) {
            if ($('#noDataRow').length === 0) {
                $('#subdepartmentTableBody').append(`
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

        filterSubDepartment(newOrder);
    });

    function filterSubDepartment(sortOrder) {
        $.ajax({
            url: '{{ url("sub-department-sort") }}',
            type: 'GET',
            data: {
                sortFilter: sortOrder
            },
            success: function(response) {
                $('#subDepartmentTableBody').empty();

                if (response.length > 0) {
                    $.each(response, function(index, subdepartment) {

                        $('#subDepartmentTableBody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${subdepartment.sub_name}</td>
                                <td>${subdepartment.sub_location}</td>
                                <td>
                                    <a href="/sub-department/${subdepartment.id}/edit"><i class="bi bi-pencil-square"></i></a>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal${subdepartment.id}">
                                        <i class="bi bi-trash text-danger ms-2"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#subDepartmentTableBody').append('<tr><td colspan="12" class="text-center">No records found.</td></tr>');
                }
            }
        });
    }
});

</script>

@endsection
