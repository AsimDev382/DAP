@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-4">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
                <div class="col-md-1">
                    <p class="fw-bold fs-5 me-3 m-0">Investigation</p>
                </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="investSearch" placeholder="Search here..." />
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

                        @can('create investigation')
                        <a href="{{ route('investigation.create') }}" type="submit" class="btn btn-primary px-5 py-2">Investigation</a>
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
                            <th>Case Name</th>
                            <th>Case Type</th>
                            <th>Product</th>
                            <th>Brand</th>
                            <th>Company</th>
                            <th>Officer</th>
                            <th>Current Status</th>
                            <th>Next Task</th>
                            <th>Status Date</th>
                            <th>Dead Line</th>
                            {{-- <th>Task Over Due</th> --}}
                            <th>Flag</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="investTableBody">
                        @forelse ($investigations as $key => $investigation)

                        <tr class="table-card-row">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $investigation->auto_id }}</td>
                            <td>{{ $investigation->case->case_name }}</td>
                            <td>{{ $investigation->case_type }}</td>
                            <td>{{ @$investigation->product->product_name }}</td>
                            <td>{{ @$investigation->brand->brand_name }}</td>
                            <td>{{ @$investigation->company->company_name }}</td>
                            <td>{{ $investigation->assign_case }}</td>
                            <td class="text-success">
                                @if($investigation->current_status == 'Pending Approval')
                                <span class="text-warning">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'In Progress')
                                <span class="text-primary">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'Approved')
                                <span class="text-success">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'Closed(Completed)')
                                <span class="text-danger">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'High-Risk-case')
                                <span class="text-orange">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'Reopened Cases')
                                <span class="text-info">{{ $investigation->current_status }}</span>
                                @endif
                            </td>
                            <td>{{ @$investigation->case->task }}</td>
                            <td>{{ $investigation->task_start_date }}</td>
                            <td>{{ $investigation->task_deadline }}</td>
                            {{-- <td></td> --}}
                            <td>
                                {{-- <img src="{{ asset('admin/images/tablelogo.svg') }}" class="" style="height: 20px; width: 30px;" alt="..."> --}}
                                {{ @$investigation->case->flag }}
                            </td>
                            <td>
                                @can('edit investigation')
                                    <a href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('investigation.edit', $investigation->id) }}"><i class="bi bi-pencil-square"></i></a>
                                @endcan
                                {{-- <button data-bs-toggle="modal" data-id="{{ route('investigation.destroy', $investigation->auto_id) }}" data-bs-target="#exampleModal"><i class="bi bi-trash  text-danger ms-2"></i></button> --}}
                                @can('delete investigation')
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $investigation->id }}">
                                    <i class="bi bi-trash text-danger ms-2"></i>
                                </button>
                                @endcan
                            </td>
                            {{-- <td><i class="bi bi-pencil-square"></i> <i class="bi bi-trash  text-danger ms-2"></i></td> --}}
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $investigation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('investigation.destroy', $investigation->id) }}">
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
                            <td colspan="15" class="text-center">No records found</td>
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
    $('#investSearch').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        let hasVisible = false;

        // Loop through all rows except the "no data" row
        $('#investTableBody tr').each(function () {
            if (!$(this).attr('id')) {
                let match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) hasVisible = true;
            }
        });

        // If no visible rows, show the noDataRow (create it if it doesn't exist)
        if (!hasVisible) {
            if ($('#noDataRow').length === 0) {
                $('#investTableBody').append(`
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

        filterInvest(newOrder);
    });

    function filterInvest(sortOrder) {
        $.ajax({
            url: '{{ route("investigation.sort") }}',
            type: 'GET',
            data: {
                sortFilter: sortOrder
            },
            success: function(response) {
                $('#investTableBody').empty();

                if (response.length > 0) {
                    $.each(response, function(index, investigation) {
                        let statusBadge = '';
                        switch (investigation.current_status) {
                            case 'Pending Approval':
                                statusBadge = `<span class="text-warning">${investigation.current_status}</span>`;
                                break;
                            case 'In Progress':
                                statusBadge = `<span class="text-primary">${investigation.current_status}</span>`;
                                break;
                            case 'Approvde':
                                statusBadge = `<span class="text-success">${investigation.current_status}</span>`;
                                break;
                            case 'Closed(Completed)':
                                statusBadge = `<span class="text-danger">${investigation.current_status}</span>`;
                                break;
                            case 'High-Risk-case':
                                statusBadge = `<span class="text-orange">${investigation.current_status}</span>`;
                                break;
                            case 'Reopened Cases':
                                statusBadge = `<span class="text-info">${investigation.current_status}</span>`;
                                break;
                            default:
                                statusBadge = investigation.current_status;
                        }

                        $('#investTableBody').append(`
                            <tr class="table-card-row">
                                <td>${index + 1}</td>
                                <td>${investigation.auto_id}</td>
                                <td>${investigation.case_name}</td>
                                <td>${investigation.case_type}</td>
                                <td>${investigation.product?.product_name ?? ''}</td>
                                <td>${investigation.brand?.brand_name ?? ''}</td>
                                <td>${investigation.company?.company_name ?? ''}</td>
                                <td>${investigation.assign_case}</td>
                                <td class="text-success">${statusBadge}</td>
                                <td>${investigation.case?.task ?? ''}</td>
                                <td>${investigation.task_start_date}</td>
                                <td>${investigation.task_deadline}</td>
                                <td>${investigation.case?.flag ?? ''}</td>
                                <td>
                                    ${investigation.can_edit ? `<a href="/investigation/${investigation.id}/edit"><i class="bi bi-pencil-square"></i></a>` : ''}
                                    ${investigation.can_delete ? `
                                        <button data-bs-toggle="modal" data-bs-target="#deleteModal${investigation.id}">
                                            <i class="bi bi-trash text-danger ms-2"></i>
                                        </button>
                                    ` : ''}
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#investTableBody').append('<tr><td colspan="15" class="text-center">No records found.</td></tr>');
                }
            }
        });
    }
});

</script>

@endsection
