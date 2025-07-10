@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row p-3">
        <div class="col-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
                <div class="col-md-1 text-nowrap">
                    <p class="fw-bold fs-5 me-0 m-0">Finance Reports</p>
                </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="finance-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="ReportSearch" placeholder="Search here..." />
                    </div>
                </div>

                <!-- Icons -->
                <div class="col-md-3 d-flex justify-content-end">
                    <div class="d-flex gap-3 align-items-center ">
                        <i class="bi bi-filter fs-3 text-dark" role="button"></i>

                        <div class="sort-button" style="cursor: pointer;">
                            <i class="bi bi-arrow-down-up fs-5 text-dark" id="sortToggle" data-order="desc"></i>
                        </div>

                        @can('create finance report')
                            <a href="{{ route('finance-report.create') }}" type="submit" class="btn btn-primary px-4 py-2">Report</a>
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
                            <th>Sr No</th>
                            <th>DAP ID</th>
                            <th>Investigation Name</th>
                            <th>Company</th>
                            <th>Brand</th>
                            <th>Seized Product</th>
                            <th>Expenses</th>
                            <th>Profit</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="ReportTableBody">
                        @forelse ($reports as $key => $report)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $report->auto_id }}</td>
                            <td>{{ $report->investigation?->invest_name ?? '' }}</td>
                            {{-- <td><a href="{{ route('finance-report.show', $report->id) }}">{{ $report->client_name }}</a></td> --}}
                            <td>{{ @$report->company->company_name }}</td>
                            <td>{{ @$report->brand->brand_name }}</td>
                            <td>{{ @$report->product->product_name }}</td>
                            <td>{{ $report->expenses }}</td>
                            <td>{{ $report->profit }}</td>
                            <td><i class="fa-regular fa-calendar"></i>{{ $report->date }}</td>
                            <td class="text-success">
                                @if($report->status == 'Pending Approval')
                                <span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $report->status }}</span>
                                @elseif($report->status == 'In Progress')
                                <span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $report->status }}</span>
                                @elseif($report->status == 'Approved')
                                <span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $report->status }}</span>
                                @elseif($report->status == 'Closed(Completed)')
                                <span class="text-danger">{{ $report->status }}</span>
                                @elseif($report->status == 'High-Risk-Case')
                                <span class="text-orange"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $report->status }}</span>
                                @elseif($report->status == 'Reopened Cases')
                                <span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $report->status }}</span>
                                @elseif($report->status == 'Rejected')
                                <span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> {{ $report->status }}</span>
                                @endif
                            </td>
                            <td>
                                @can('edit finance report')
                                <a href=""
                                    data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('finance-report.edit', $report->id) }}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                @endcan
                                @can('view finance report')
                                <a href="{{ route('finance-report.show', $report->id) }}"><i class="bi bi-eye"></i></a>
                                @endcan
                                {{-- <button data-bs-toggle="modal" data-id="{{ route('report.destroy', $report->auto_id) }}" data-bs-target="#exampleModal"><i class="bi bi-trash  text-danger ms-2"></i></button> --}}
                                @can('delete finance report')
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $report->id }}">
                                    <i class="bi bi-trash text-danger ms-2"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>


                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $report->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('finance-report.destroy', $report->id) }}" method="POST">
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
    $('#ReportSearch').on('keyup', function () {
        let value = $(this).val().toLowerCase();
        let hasVisible = false;

        // Loop through all rows except the "no data" row
        $('#ReportTableBody tr').each(function () {
            if (!$(this).attr('id')) {
                let match = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(match);
                if (match) hasVisible = true;
            }
        });

        // If no visible rows, show the noDataRow (create it if it doesn't exist)
        if (!hasVisible) {
            if ($('#noDataRow').length === 0) {
                $('#ReportTableBody').append(`
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

        filterReport(newOrder);
    });

    function filterReport(sortOrder) {
        $.ajax({
            url: '{{ route("finance-report.sort") }}',
            type: 'GET',
            data: {
                sortFilter: sortOrder,
                // search: searchText
            },
            success: function(response) {
                $('#ReportTableBody').empty();

                if (response.length > 0) {
                    $.each(response, function(index, report) {

                        let statusBadge = '';
                        switch (report.status) {
                            case 'Pending Approval':
                                statusBadge = `<span class="text-warning"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${report.status}</span>`;
                                break;
                            case 'In Progress':
                                statusBadge = `<span class="text-primary"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${report.status}</span>`;
                                break;
                            case 'Approved':
                                statusBadge = `<span class="text-success"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${report.status}</span>`;
                                break;
                            case 'Closed(Completed)':
                                statusBadge = `<span class="text-danger">${report.status}</span>`;
                                break;
                            case 'High-Risk-Case':
                                statusBadge = `<span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${report.status}</span>`;
                                break;
                            case 'Reopened Cases':
                                statusBadge = `<span class="text-info"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${report.status}</span>`;
                                break;
                            case 'Rejected':
                                statusBadge = `<span class="text-danger"><i class="fa-solid fa-circle" style="font-size: 8px;"></i> ${report.status}</span>`;
                                break;
                        }

                        $('#ReportTableBody').append(`
                            <tr>
                                <td>${report.id}</td>
                                <td>${report.auto_id}</td>
                                <td>${report.investigation ? report.investigation.invest_name : ''}</td>
                                <td>${report.company ? report.company.company_name : ''}</td>
                                <td>${report.brand ? report.brand.brand_name : ''}</td>
                                <td>${report.product ? report.product.product_name : ''}</td>
                                <td>${report.expenses}</td>
                                <td>${report.profit}</td>
                                <td><i class="fa-regular fa-calendar"></i> ${report.date}</td>
                                <td>${statusBadge}</td>
                                <td>
                                    <a href="/finance-report/edit/${report.id}"><i class="bi bi-pencil-square"></i></a>
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal${report.id}">
                                        <i class="bi bi-trash text-danger ms-2"></i>
                                    </button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#ReportTableBody').append('<tr><td colspan="12" class="text-center">No records found.</td></tr>');
                }
            }
        });
    }

    // Initial load
    // filterexpenses(currentOrder, '');

});

</script>

@endsection
