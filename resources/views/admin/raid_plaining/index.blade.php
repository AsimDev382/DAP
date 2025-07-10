
@extends('admin.layouts.adminlayout')
@section('main-content')


    <div class="main-content">
        <div class="row px-4">
            <div class="col-12 mb-4 case-bar ">
                <div class="row d-flex align-items-center justify-content-between  gap-3">

                    <!-- Title -->
                    <div class="col-md-2">
                        <p class="fw-bold fs-5 me-3 m-0">Raid Planing</p>
                    </div>

                    <!-- Search -->
                    <div class="col-md-5">
                        <div class="case-search flex-grow-1">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" id="raidSearch" placeholder="Search here..." />
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
                            @can('create raid plaining & execution')
                                <a href="{{ route('raid.plaining.create') }}" type="submit" class="btn btn-primary px-4 py-2">Raid Action</a>
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
                                <th>Raid Type</th>
                                <th>Department</th>
                                <th>Case DAP ID</th>
                                <th> Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="raidTableBody">
                            @forelse($raid_plainings as $key => $raid)

                            <tr class="table-card-row">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $raid->auto_id }}</td>
                                <td>{{ $raid->raid_type }}</td>
                                <td>{{ $raid->department->name }}</td>
                                <td>{{ $raid->auto_id }}</td>
                                <td>{{ $raid->date }}</td>

                                <td class="text-success">
                                    @if($raid->status == 'Pending Approval')
                                    <span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $raid->status }}</span>
                                    @elseif($raid->status == 'In Progress')
                                    <span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $raid->status }}</span>
                                    @elseif($raid->status == 'Approved')
                                    <span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $raid->status }}</span>
                                    @elseif($raid->status == 'Closed(Completed)')
                                    <span class="text-danger">{{ $raid->status }}</span>
                                    @elseif($raid->status == 'High-Risk-case')
                                    <span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $raid->status }}</span>
                                    @elseif($raid->status == 'Reopened Cases')
                                    <span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $raid->status }}</span>
                                    @elseif($raid->status == 'Rejected')
                                    <span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $raid->status }}</span>
                                    @endif
                                </td>

                                <td>
                                    @can('edit raid plaining & execution')
                                    <a href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('raid.plaining.edit', $raid->id) }}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    @endcan
                                    @can('view raid plaining & execution')
                                    <a href="{{ route('raid.plaining.view', $raid->id) }}"><i class="bi bi-eye"></i></a>
                                    @endcan
                                    @can('delete raid plaining & execution')
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $raid->id }}">
                                        <i class="bi bi-trash text-danger ms-2"></i>
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $raid->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="{{ route('raid.plaining.destroy', $raid->id) }}">
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
                                <td class=" text-center">No records found</td>
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
    // Searching filter
$(document).ready(function () {
    $('#raidSearch').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        let hasVisible = false;

        // Loop through all rows except the "no data" row
        $('#raidTableBody tr').each(function () {
            if (!$(this).attr('id')) {
                let match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) hasVisible = true;
            }
        });

        // If no visible rows, show the noDataRow (create it if it doesn't exist)
        if (!hasVisible) {
            if ($('#noDataRow').length === 0) {
                $('#raidTableBody').append(`
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
            url: '{{ url("raid-plaining/sort") }}',
            type: 'GET',
            data: {
                sortFilter: sortOrder
            },
            success: function(response) {
                $('#raidTableBody').empty();

                if (response.length > 0) {
                    $.each(response, function(index, raids) {
                        let statusBadge = '';
                        switch (raids.status) {
                            case 'Pending Approval':
                                statusBadge = `<span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${raids.status}</span>`;
                                break;
                            case 'In Progress':
                                statusBadge = `<span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${raids.status}</span>`;
                                break;
                            case 'Approved':
                                statusBadge = `<span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${raids.status}</span>`;
                                break;
                            case 'Closed(Completed)':
                                statusBadge = `<span class="text-danger">${raids.status}</span>`;
                                break;
                            case 'High-Risk-case':
                                statusBadge = `<span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${raids.status}</span>`;
                                break;
                            case 'Reopened Cases':
                                statusBadge = `<span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${raids.status}</span>`;
                                break;
                            case 'Rejected':
                                statusBadge = `<span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${raids.status}</span>`;
                                break;
                        }

                        $('#raidTableBody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${raids.auto_id}</td>
                                <td>${raids.raid_type}</td>
                                <td>${raids.department.name}</td>
                                <td>${raids.auto_id}</td>
                                <td>${raids.date}</td>
                                <td>${statusBadge}</td>
                                <td>
                                    <a href="/raid-plaining/${raids.id}/edit"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a href="/raid-plaining/view/${raids.id}"><i class="bi bi-eye"></i></a>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal${raids.id}">
                                        <i class="bi bi-trash text-danger ms-2"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#raidTableBody').append('<tr><td colspan="12" class="text-center">No records found.</td></tr>');
                }
            }
        });
    }
});

</script>

@endsection
