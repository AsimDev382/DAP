@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">
    <div class="row px-4">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between flex-nowrap gap-3">

                <!-- Title -->
                <div class="col-2">
                    <p class="fw-bold fs-5 me-3 m-0">Assign Task</p>
                </div>

                <!-- Search -->
                <div class="col-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="taskSearch" placeholder="Search here..." />
                    </div>
                </div>

                <!-- Icons -->
                <div class="col-4 d-flex justify-content-center">
                    <div class="d-flex gap-3 align-items-center ">
                        <i class="bi bi-filter fs-3 text-dark" role="button"></i>

                        <div class="sort-button" style="cursor: pointer;">
                            <i class="bi bi-arrow-down-up fs-5 text-dark" id="sortToggle" data-order="desc"></i>
                        </div>

                        @can('create task')
                        <a href="{{ route('assign.tasks.create') }}" class="btn btn-primary px-5 py-2">Assign Task</a>
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
                            <th>Sr #</th>
                            <th>DAP ID</th>
                            <th>Task Name</th>
                            <th>User Name</th>
                            <th>Department</th>
                            {{-- <th>Case name</th> --}}
                            <th>Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="taskTableBody">
                        @forelse ($tasks as $key => $task)

                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $task->auto_id }}</td>
                            <td>
                                <a href="{{ route('assign.tasks.view', $task->id) }}">
                                    {{-- {{ explode(',', $task->task->task_name) }} --}}
                                    @foreach ($task->task_names as $taskName)
                                    <li>{{ $taskName }}</li>
                                    @endforeach
                                </a>
                            </td>
                            <td>
                                {{-- {{ $task->group->group_name ?? '' }} --}}
                                @foreach ($task->user_names as $userName)
                                <li>{{ $userName }}</li>
                                @endforeach
                            </td>
                            <td>{{ $task->department->name }}</td>
                            {{-- <td>{{ $task->case->case_name   }}</td> --}}
                            <td><i class="fa-regular fa-calendar"></i>{{ $task->assign_date }}</td>
                            <td><i class="fa-regular fa-calendar"></i>{{ $task->expiry_date }}</td>
                            <td>
                                <span class="badge toggle-status {{ $task->status === 'Active' ? 'text-bg-success' : 'text-bg-danger' }}" data-id="{{ $task->id }}" data-status="{{ $task->status }}" style="cursor: pointer;">
                                    {{ $task->status }}
                                </span>

                            </td>

                            <td>
                                {{-- @can('edit assign task') --}}
                                <a href="#"
                                    data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('assign.tasks.edit', $task->id) }}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                {{-- @endcan --}}
                                @can('view assign task')
                                <a href="{{ route('assign.tasks.view', $task->id) }}"><i class="bi bi-eye"></i></a>
                                @endcan
                                @can('delete assign task')
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $task->id }}">
                                    <i class="bi bi-trash text-danger ms-2"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>


                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('assign.tasks.destroy', $task->id) }}">
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
    $(document).on('click', '.toggle-status', function() {
        let span = $(this);
        let id = span.data('id');
        let currentStatus = span.data('status');

        $.ajax({
            url: '/assign-tasks/update-status/' + id
            , type: 'POST'
            , data: {
                _token: '{{ csrf_token() }}'
                , status: currentStatus
            }
            , success: function(response) {
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

</script>
<script>
    // Searching filter
    $(document).ready(function() {
        $('#taskSearch').on('keyup', function() {
            let value = $(this).val().toLowerCase();
            let hasVisible = false;

            // Loop through all rows except the "no data" row
            $('#taskTableBody tr').each(function() {
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
        // let currentOrder = 'desc'; // default
        $('#sortToggle').on('click', function() {
            // Toggle order value
            var currentOrder = $(this).attr('data-order');
            var newOrder = currentOrder === 'desc' ? 'asc' : 'desc';
            $(this).attr('data-order', newOrder);

            filtertask(newOrder);
            // filterCases(currentOrder, $('#caseSearch').val());
        });

        // $('#caseSearch').on('input', function() {
        //     let searchText = $(this).val();
        //     filterCases(currentOrder, searchText);
        // });

        function filtertask(sortOrder) {
            $.ajax({
                url: '{{ route("assign.tasks.sort") }}'
                , type: 'GET'
                , data: {
                    sortFilter: sortOrder
                }
                , success: function(response) {
                    $('#taskTableBody').empty();

                    if (response.length > 0) {
                        $.each(response, function(index, task) {
                            console.log(task);

                            let taskNames = '';
                            if (task.task_names && task.task_names.length > 0) {
                                task.task_names.forEach(function(name) {
                                    taskNames += `<li>${name}</li>`;
                                });
                            }

                            let userNames = '';
                            if (task.user_names && task.user_names.length > 0) {
                                task.user_names.forEach(function(name) {
                                    userNames += `<li>${name}</li>`;
                                });
                            }

                            let statusBadgeClass = task.status === 'Active' ? 'text-bg-success' : 'text-bg-danger';

                            $('#taskTableBody').append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${task.auto_id}</td>
                            <td><a href="/assign/tasks/view/${task.id}">${taskNames}</a></td>
                            <td>${userNames}</td>
                            <td>${task.department?.name ?? ''}</td>
                            <td><i class="fa-regular fa-calendar"></i> ${task.assign_date}</td>
                            <td><i class="fa-regular fa-calendar"></i> ${task.expiry_date}</td>
                            <td>
                                <span class="badge toggle-status ${statusBadgeClass}"
                                      data-id="${task.id}"
                                      data-status="${task.status}"
                                      style="cursor: pointer;">
                                    ${task.status}
                                </span>
                            </td>
                            <td>
                                <a href="/assign/tasks/edit/${task.id}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;
                                <a href="/assign/tasks/view/${task.id}"><i class="bi bi-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal${task.id}">
                                    <i class="bi bi-trash text-danger ms-2"></i>
                                </button>
                            </td>
                        </tr>
                    `);
                        });
                    } else {
                        $('#taskTableBody').append('<tr><td colspan="10" class="text-center">No records found.</td></tr>');
                    }
                }
                , error: function(xhr) {
                    console.error('Error fetching tasks:', xhr.responseText);
                }
            });
        }


        // Initial load
        // filterCases(currentOrder, '');

    });

</script>

@endsection
