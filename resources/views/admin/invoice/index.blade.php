@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row p-3">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
                <div class="col-md-1 text-nowrap">
                    <p class="fw-bold fs-5 me-0 m-0">Invoices</p>
                </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="InvoiceSearch" placeholder="Search here..." />
                    </div>
                </div>

                <!-- Icons -->
                <div class="col-md-3 d-flex justify-content-end">
                    <div class="d-flex gap-3 align-items-center ">
                        <i class="bi bi-filter fs-3 text-dark" role="button"></i>

                        <div class="sort-button" style="cursor: pointer;">
                            <i class="bi bi-arrow-down-up fs-5 text-dark" id="sortToggle" data-order="desc"></i>
                        </div>

                        @can('create invoices')
                            <a href="{{ route('invoice.create') }}" type="submit" class="btn btn-primary px-4 py-2">New invoice</a>
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
                            <th>Case Type</th>
                            <th>Case Priority</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="invoiceTableBody">
                        @forelse ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->auto_id }}</td>
                            <td>{{ $invoice->client_id }}</td>
                            <td>
                                <a href="{{ route('invoice.show', $invoice->id) }}">{{ $invoice->cases->case_name }}</a>
                            </td>
                            <td>{{ @$invoice->product->product_name }}</td>
                            <td>{{ @$invoice->brand->brand_name }}</td>
                            <td>{{ @$invoice->company->company_name }}</td>
                            <td>{{ $invoice->case_type }}</td>
                            <td>{{ $invoice->case_priority }}</td>
                            <td><i class="fa-regular fa-calendar"></i>{{ $invoice->start_date }}</td>
                            <td>{{ $invoice->total_amount }}</td>
                            <td class="text-success">
                                @if($invoice->status == 'Pending Approval')
                                <span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $invoice->status }}</span>
                                @elseif($invoice->status == 'In Progress')
                                <span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $invoice->status }}</span>
                                @elseif($invoice->status == 'Approved')
                                <span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $invoice->status }}</span>
                                @elseif($invoice->status == 'Closed(Completed)')
                                <span class="text-danger">{{ $invoice->status }}</span>
                                @elseif($invoice->status == 'High-Risk-Cases')
                                <span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $invoice->status }}</span>
                                @elseif($invoice->status == 'Reopened Cases')
                                <span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $invoice->status }}</span>
                                @elseif($invoice->status == 'Rejected')
                                <span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $invoice->status }}</span>
                                @endif
                            </td>
                            <td>
                                @can('edit invoices')
                                <a href="#"
                                    data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('invoice.edit', $invoice->id) }}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                @endcan
                                @can('view invoices')
                                <a href="{{ route('invoice.show', $invoice->id) }}"><i class="bi bi-eye"></i></a>
                                @endcan
                                {{-- <button data-bs-toggle="modal" data-id="{{ route('invoice.destroy', $invoice->auto_id) }}" data-bs-target="#exampleModal"><i class="bi bi-trash  text-danger ms-2"></i></button> --}}
                                @can('delete invoices')
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $invoice->id }}">
                                    <i class="bi bi-trash text-danger ms-2"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>


                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $invoice->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST">
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
    $('#invoiceSearch').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        let hasVisible = false;

        // Loop through all rows except the "no data" row
        $('#invoiceTableBody tr').each(function () {
            if (!$(this).attr('id')) {
                let match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) hasVisible = true;
            }
        });

        // If no visible rows, show the noDataRow (create it if it doesn't exist)
        if (!hasVisible) {
            if ($('#noDataRow').length === 0) {
                $('#invoiceTableBody').append(`
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

        filterInvoice(newOrder);
        // filterCases(currentOrder, $('#caseSearch').val());
    });

    // $('#caseSearch').on('input', function() {
    //     let searchText = $(this).val();
    //     filterCases(currentOrder, searchText);
    // });

    function filterInvoice(sortOrder) {
        $.ajax({
            url: '{{ route("invoice.sort") }}',
            type: 'GET',
            data: {
                sortFilter: sortOrder,
                // search: searchText
            },
            success: function(response) {
                $('#invoiceTableBody').empty();

                if (response.length > 0) {
                    $.each(response, function(index, invoice) {

                        let statusBadge = '';
                        switch (invoice.status) {
                            case 'Pending Approval':
                                statusBadge = `<span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${invoice.status}</span>`;
                                break;
                            case 'In Progress':
                                statusBadge = `<span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${invoice.status}</span>`;
                                break;
                            case 'Approved':
                                statusBadge = `<span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${invoice.status}</span>`;
                                break;
                            case 'Closed(Completed)':
                                statusBadge = `<span class="text-danger">${invoice.status}</span>`;
                                break;
                            case 'High-Risk-Cases':
                                statusBadge = `<span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${invoice.status}</span>`;
                                break;
                            case 'Reopened Cases':
                                statusBadge = `<span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${invoice.status}</span>`;
                                break;
                            case 'Rejected':
                                statusBadge = `<span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${invoice.status}</span>`;
                                break;
                        }

                        $('#invoiceTableBody').append(`
                            <tr>
                                <td>${invoice.auto_id}</td>
                                <td>${invoice.client_id}</td>
                                <td>${invoice.cases.case_name}</td>
                                <td>${invoice.product ? invoice.product.product_name : ''}</td>
                                <td>${invoice.brand ? invoice.brand.brand_name : ''}</td>
                                <td>${invoice.company ? invoice.company.company_name : ''}</td>
                                <td>${invoice.case_type}</td>
                                <td>${invoice.case_priority}</td>
                                <td>${invoice.total_amount}</td>
                                <td><i class="fa-regular fa-calendar"></i> ${invoice.start_date}</td>
                                <td>${statusBadge}</td>
                                <td>
                                    <a href="/invoice/edit/${invoice.id}"><i class="bi bi-pencil-square"></i></a>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal${invoice.id}">
                                        <i class="bi bi-trash text-danger ms-2"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#invoiceTableBody').append('<tr><td colspan="12" class="text-center">No records found.</td></tr>');
                }
            }
        });
    }

    // Initial load
    // filterexpenses(currentOrder, '');

});

</script>

@endsection
