@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row p-3">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
                <div class="col-md-1 text-nowrap">
                    <p class="fw-bold fs-5 me-0 m-0">Expenses</p>
                </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="ExpensesSearch" placeholder="Search here..." />
                    </div>
                </div>

                <!-- Icons -->
                <div class="col-md-3 d-flex justify-content-end">
                    <div class="d-flex gap-3 align-items-center ">
                        <i class="bi bi-filter fs-3 text-dark" role="button"></i>

                        <div class="sort-button" style="cursor: pointer;">
                            <i class="bi bi-arrow-down-up fs-5 text-dark" id="sortToggle" data-order="desc"></i>
                        </div>

                        @can('create profit & expences')
                            <a href="{{ route('expenses.create') }}" type="submit" class="btn btn-primary px-4 py-2">Add Expenses</a>
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
                            <th>Client ID</th>
                            <th>Case Name</th>
                            <th>Products</th>
                            <th>Brand</th>
                            <th>Company</th>
                            <th>Total Amount</th>
                            <th>Expenses</th>
                            <th>Profit</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Desbursement</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="ExpensesTableBody">
                        @forelse ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->auto_id }}</td>
                            <td>{{ $expense->client_id }}</td>
                            <td>
                                <a href="{{ route('expenses.show', $expense->id) }}">{{ $expense->cases->case_name }}</a>
                            </td>
                            <td>{{ @$expense->product->product_name }}</td>
                            <td>{{ @$expense->brand->brand_name }}</td>
                            <td>{{ @$expense->company->company_name }}</td>
                            <td>{{ $expense->total_amount }}</td>
                            <td>{{ $expense->case_expense }}</td>
                            <td>{{ $expense->total_amount - $expense->case_expense }}</td>
                            <td><i class="fa-regular fa-calendar"></i>{{ $expense->start_date }}</td>
                            <td class="text-success">
                                @if($expense->status == 'Pending Approval')
                                <span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $expense->status }}</span>
                                @elseif($expense->status == 'In Progress')
                                <span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $expense->status }}</span>
                                @elseif($expense->status == 'Approved')
                                <span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $expense->status }}</span>
                                @elseif($expense->status == 'Closed(Completed)')
                                <span class="text-danger">{{ $expense->status }}</span>
                                @elseif($expense->status == 'High-Risk-Cases')
                                <span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $expense->status }}</span>
                                @elseif($expense->status == 'Reopened Cases')
                                <span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $expense->status }}</span>
                                @elseif($expense->status == 'Rejected')
                                <span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $expense->status }}</span>
                                @endif
                            </td>
                            <td>
                                <span
                                    class="badge toggle-status {{ $expense->desbursement === 'Active' ? 'text-bg-success' : 'text-bg-danger' }}"
                                    data-id="{{ $expense->id }}"
                                    data-desbursement="{{ $expense->desbursement }}"
                                    style="cursor: pointer;">
                                    {{ $expense->desbursement }}
                                </span>
                            </td>
                            <td>
                                @can('edit profit & expences')
                                <a href="#"
                                    data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('expenses.edit', $expense->id) }}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                @endcan
                                @can('view profit & expences')
                                <a href="{{ route('expenses.show', $expense->id) }}"><i class="bi bi-eye"></i></a>
                                @endcan
                                {{-- <button data-bs-toggle="modal" data-id="{{ route('expense.destroy', $expense->auto_id) }}" data-bs-target="#exampleModal"><i class="bi bi-trash  text-danger ms-2"></i></button> --}}
                                @can('delete profit & expences')
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $expense->id }}">
                                    <i class="bi bi-trash text-danger ms-2"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>


                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $expense->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('expenses.destroy', $expense->id) }}">
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

$(document).on('click', '.toggle-status', function () {
    let span = $(this);
    let id = span.data('id');
    let currentStatus = span.data('desbursement');

    $.ajax({
        url: '/expenses/update-status/' + id,
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            desbursement: currentStatus
        },
        success: function (response) {
            span.text(response.desbursement);
            span.data('desbursement', response.desbursement);

            if (response.desbursement === 'Active') {
                span.removeClass('text-bg-danger').addClass('text-bg-success');
            } else {
                span.removeClass('text-bg-success').addClass('text-bg-danger');
            }
        }
    });
});


// Searching filter
$(document).ready(function () {
    $('#ExpensesSearch').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        let hasVisible = false;

        // Loop through all rows except the "no data" row
        $('#ExpensesTableBody tr').each(function () {
            if (!$(this).attr('id')) {
                let match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) hasVisible = true;
            }
        });

        // If no visible rows, show the noDataRow (create it if it doesn't exist)
        if (!hasVisible) {
            if ($('#noDataRow').length === 0) {
                $('#ExpensesSearch').append(`
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

        filterExpences(newOrder);
        // filterCases(currentOrder, $('#caseSearch').val());
    });

    // $('#caseSearch').on('input', function() {
    //     let searchText = $(this).val();
    //     filterCases(currentOrder, searchText);
    // });

    function filterExpences(sortOrder) {
        $.ajax({
            url: '{{ route("expenses.sort") }}',
            type: 'GET',
            data: {
                sortFilter: sortOrder,
                // search: searchText
            },
            success: function(response) {
                $('#ExpensesTableBody').empty();

                if (response.length > 0) {
                    $.each(response, function(index, expenses) {
                        let statusClass = expenses.desbursement === 'Active' ? 'text-bg-success' : 'text-bg-danger';
                        let statusdesbursement = `
                            <span class="badge toggle-status ${statusClass}"
                                  data-id="${expenses.id}"
                                  data-desbursement="${expenses.desbursement}"
                                  style="cursor: pointer;">
                                ${expenses.desbursement}
                            </span>`;

                        let statusBadge = '';
                        switch (expenses.status) {
                            case 'Pending Approval':
                                statusBadge = `<span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${expenses.status}</span>`;
                                break;
                            case 'In Progress':
                                statusBadge = `<span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${expenses.status}</span>`;
                                break;
                            case 'Approved':
                                statusBadge = `<span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${expenses.status}</span>`;
                                break;
                            case 'Closed(Completed)':
                                statusBadge = `<span class="text-danger">${expenses.status}</span>`;
                                break;
                            case 'High-Risk-case':
                                statusBadge = `<span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${expenses.status}</span>`;
                                break;
                            case 'Reopened expenses':
                                statusBadge = `<span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${expenses.status}</span>`;
                                break;
                            case 'Rejected':
                                statusBadge = `<span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${expenses.status}</span>`;
                                break;
                        }

                        $('#ExpensesTableBody').append(`
                            <tr>
                                <td>${expenses.auto_id}</td>
                                <td>${expenses.client_id}</td>
                                <td>${expenses.cases.case_name}</td>
                                <td>${expenses.product ? expenses.product.product_name : ''}</td>
                                <td>${expenses.brand ? expenses.brand.brand_name : ''}</td>
                                <td>${expenses.company ? expenses.company.company_name : ''}</td>
                                <td>${expenses.total_amount}</td>
                                <td>${expenses.case_expense}</td>
                                <td>profit</td>
                                <td><i class="fa-regular fa-calendar"></i> ${expenses.start_date}</td>
                                <td>${statusBadge}</td>
                                <td>${statusdesbursement}</td>
                                <td>
                                    <a href="/expenses/edit/${expenses.id}"><i class="bi bi-pencil-square"></i></a>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal${expenses.id}">
                                        <i class="bi bi-trash text-danger ms-2"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#ExpensesTableBody').append('<tr><td colspan="12" class="text-center">No records found.</td></tr>');
                }
            }
        });
    }

    // Initial load
    // filterexpenses(currentOrder, '');

});

</script>

@endsection
