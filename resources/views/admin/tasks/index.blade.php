@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row p-3">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
                <div class="col-md-1 text-nowrap">
                    <p class="fw-bold fs-5 me-0 m-0">Tasks</p>
                </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="taskSearch" placeholder="Search here..." />
                    </div>
                </div>

                <!-- Icons -->
                <div class="col-md-3 d-flex justify-content-end">
                    <div class="d-flex gap-3 align-items-center ">
                        <i class="bi bi-filter fs-3 text-dark" role="button"></i>

                        <div class="sort-button" style="cursor: pointer;">
                            <i class="bi bi-arrow-down-up fs-5 text-dark" id="sortToggle" data-order="desc"></i>
                        </div>

                        @can('create assign task')
                            <a href="{{ route('tasks.create') }}" type="submit" class="btn btn-primary px-4 py-2">Add Task</a>
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
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>DAP ID</th>
                            <th>Task Name</th>
                            <th>Department</th>
                            <th>Sub Department</th>
                            <th>Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="taskTableBody">
                        @forelse ($tasks as $task)
                        <tr>
                            <td>{{ $task->auto_id }}</td>
                            <td>
                                <a href="{{ route('tasks.view', $task->id) }}">{{ $task->task_name }}</a>
                            </td>
                            <td>{{ @$task->department->name }}</td>
                            <td>{{ @$task->subdepartment->sub_name }}</td>
                            <td><i class="fa-regular fa-calendar"></i>{{ $task->start_date }}</td>
                            <td><i class="fa-regular fa-calendar"></i>{{ $task->expiry_date }}</td>
                            <td class="text-success">
                                @if($task->status == 'Pending Approval')
                                <span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $task->status }}</span>
                                @elseif($task->status == 'In Progress')
                                <span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $task->status }}</span>
                                @elseif($task->status == 'Approved')
                                <span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $task->status }}</span>
                                @elseif($task->status == 'Closed(Completed)')
                                <span class="text-danger">{{ $task->status }}</span>
                                @elseif($task->status == 'High-Risk-task')
                                <span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $task->status }}</span>
                                @elseif($task->status == 'Reopened tasks')
                                <span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $task->status }}</span>
                                @elseif($task->status == 'Rejected')
                                <span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $task->status }}</span>
                                @endif
                            </td>
                            <td>
                                @can('edit assign task')
                                <a href="#"
                                    data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('tasks.edit', $task->id) }}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;
                                @endcan
                                @can('view assign task')
                                <a href="{{ route('tasks.view', $task->id) }}"><i class="bi bi-eye"></i></a>
                                @endcan
                                {{-- <button data-bs-toggle="modal" data-id="{{ route('task.destroy', $task->auto_id) }}" data-bs-target="#exampleModal"><i class="bi bi-trash  text-danger ms-2"></i></button> --}}
                                @can('delete assign task')
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">
                                    <i class="bi bi-trash text-danger ms-2"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>


                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('tasks.destroy', $task->id) }}">
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
                            <td colspan="12" class="text-center">No records found</td>
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
<script>
// Searching filter
$(document).ready(function () {
    $('#taskSearch').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        let hasVisible = false;

        // Loop through all rows except the "no data" row
        $('#taskTableBody tr').each(function () {
            if (!$(this).attr('id')) {
                let match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) hasVisible = true;
            }
        });

        // If no visible rows, show the noDataRow (create it if it doesn't exist)
        if (!hasVisible) {
            if ($('#noDataRow').length === 0) {
                $('#taskTableBody').append(`
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


// Sorting

$(document).ready(function() {
    $('#sortToggle').on('click', function() {
        // Toggle order value
        var currentOrder = $(this).attr('data-order');
        var newOrder = currentOrder === 'desc' ? 'asc' : 'desc';
        $(this).attr('data-order', newOrder);

        filterTask(newOrder);
    });

    function filterTask(sortOrder) {
        $.ajax({
            url: '{{ route("tasks.sort") }}',
            type: 'GET',
            data: {
                sortFilter: sortOrder,
                // search: searchText
            },
            success: function(response) {
                $('#taskTableBody').empty();

                if (response.length > 0) {
                    $.each(response, function(index, tasks) {
                        let statusBadge = '';
                        switch (tasks.status) {
                            case 'Pending Approval':
                                statusBadge = `<span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${tasks.status}</span>`;
                                break;
                            case 'In Progress':
                                statusBadge = `<span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${tasks.status}</span>`;
                                break;
                            case 'Approved':
                                statusBadge = `<span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${tasks.status}</span>`;
                                break;
                            case 'Closed(Completed)':
                                statusBadge = `<span class="text-danger">${tasks.status}</span>`;
                                break;
                            case 'High-Risk-case':
                                statusBadge = `<span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${tasks.status}</span>`;
                                break;
                            case 'Reopened Cases':
                                statusBadge = `<span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${tasks.status}</span>`;
                                break;
                            case 'Rejected':
                                statusBadge = `<span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${tasks.status}</span>`;
                                break;
                        }



                        $('#taskTableBody').append(`
                            <tr>
                                <td>${tasks.auto_id}</td>
                                <td>${tasks.task_name}</td>
                                <td>${tasks.department ? tasks.department.name : ''}</td>
                                <td>${tasks.sub_department ? tasks.sub_department.sub_name : ''}</td>
                                <td><i class="fa-regular fa-calendar"></i>${tasks.start_date}</td>
                                <td><i class="fa-regular fa-calendar"></i>${tasks.expiry_date}</td>
                                <td>${statusBadge}</td>
                                <td>
                                    <a href="/tasks/${tasks.id}/edit"><i class="bi bi-pencil-square"></i></a>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal${tasks.id}">
                                        <i class="bi bi-trash text-danger ms-2"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#taskTableBody').append('<tr><td colspan="11" class="text-center">No records found.</td></tr>');
                }
            }
        });
    }

    // Initial load
    // filterCases(currentOrder, '');

});

</script>

@endsection
