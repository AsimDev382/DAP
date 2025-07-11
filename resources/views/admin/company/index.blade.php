@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-4">
        <div class="col-md-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
                <div class="col-md-1">
                    <p class="fw-bold fs-5 me-3 m-0">Company</p>
                </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="companySearch" placeholder="Search here..." />
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
                        @can('create company')
                        <a href="{{ route('company.create') }}" type="submit" class="btn btn-primary px-5 py-2">Company</a>
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
                <table class="table table-hover mb-0" id="companyTable">
                    <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Company Name</th>
                            <th>Logo</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Address</th>
                            <th>MOU Date</th>
                            <th>MOU Expiry Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="companyTableBody">
                        {{-- @foreach ($companies as $key => $company) --}}
                        @forelse ($companies as $key => $company)

                        <tr class="table-card-row">
                            <td>{{ $key + 1 }}</td>
                            <td><a href="{{ route('company.view', $company->id) }}">{{ $company->company_name }}</a></td>
                            <td>
                                @if($company->company_logo)
                                    <img src="{{ asset('storage/'.$company->company_logo) }}" class="" style="height: 20px; width: 30px;" alt="...">
                                @else
                                No Image
                                @endif
                            </td>
                            <td>{{ $company->company_email }}</td>
                            <td>{{ $company->phone_no }}</td>
                            <td>{{ $company->company_address }}</td>

                            <td><i class="fa-regular fa-calendar"></i> {{ $company->mou_start_date }}</td>
                            <td><i class="fa-regular fa-calendar"></i> {{ $company->mou_end_date }}</td>
                            <td>
                                <span
                                    class="badge toggle-status {{ $company->status === 'Active' ? 'text-bg-success' : 'text-bg-danger' }}"
                                    data-id="{{ $company->id }}"
                                    data-status="{{ $company->status }}"
                                    style="cursor: pointer;">
                                    {{ $company->status }}
                                </span>
                            </td>
                            {{-- <td><a href="feedback.html" class="text-dark"><span class="badge text-bg-success"> {{ $company->status }}</span></a></td> --}}
                            <td>
                                @can('edit company')
                                    {{-- <a href="{{ route('company.edit', $company->id) }}"><i class="bi bi-pencil-square"></i></a> --}}
                                    <a href="#"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('company.edit', $company->id) }}"><i class="bi bi-pencil-square"></i>
                                    </a>&nbsp;&nbsp;&nbsp;
                                @endcan
                                @can('view company')
                                    <a href="{{ route('company.view', $company->id) }}"><i class="bi bi-eye"></i></a>
                                @endcan

                                @can('delete company')
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $company->id }}"><i class="bi bi-trash  text-danger ms-2"></i></button>
                                @endcan
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $company->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('company.destroy', $company->id) }}">
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
                            <td colspan="8" class="text-center">No records found</td>
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
            url: '/company/update-status/' + id,
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
</script>

<script>
    $(document).ready(function () {
        $('#companySearch').on('keyup', function () {
            let value = $(this).val().toLowerCase();
            let hasVisible = false;

            // Loop through all rows except the "no data" row
            $('#companyTableBody tr').each(function () {
                if (!$(this).attr('id')) {
                    let match = $(this).text().toLowerCase().indexOf(value) > -1;
                    $(this).toggle(match);
                    if (match) hasVisible = true;
                }
            });

            // If no visible rows, show the noDataRow (create it if it doesn't exist)
            if (!hasVisible) {
                if ($('#noDataRow').length === 0) {
                    $('#companyTableBody').append(`
                        <tr id="noDataRow">
                            <td colspan="8" class="text-center">No records found</td>
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

            filterCompany(newOrder);
        });

        function filterCompany(sortOrder) {
            $.ajax({
                url: '{{ route("company.sort") }}',
                type: 'GET',
                data: {
                    sortFilter: sortOrder
                },
                success: function(response) {
                    $('#companyTableBody').empty();

                    if (response.length > 0) {
                        $.each(response, function(index, company) {
                            let statusBadge = '';
                            if (company.status === 'Active') {
                                statusBadge = `<span class="badge text-bg-success toggle-status" data-id="${company.id}" data-status="${company.status}" style="cursor: pointer;">${company.status}</span>`;
                            } else {
                                statusBadge = `<span class="badge text-bg-danger toggle-status" data-id="${company.id}" data-status="${company.status}" style="cursor: pointer;">${company.status}</span>`;
                            }

                            let logoUrl = company.company_logo ? `/storage/${company.company_logo}` : '';

                            $('#companyTableBody').append(`
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${company.company_name}</td>
                                    <td><img src="${logoUrl}" style="height: 20px; width: 30px;" alt=""></td>
                                    <td>${company.company_email}</td>
                                    <td>${company.phone_no}</td>
                                    <td>${company.company_address}</td>
                                    <td><i class="fa-regular fa-calendar"></i> ${company.mou_start_date}</td>
                                    <td><i class="fa-regular fa-calendar"></i> ${company.mou_end_date}</td>
                                    <td>${statusBadge}</td>
                                    <td>
                                        <a href="/company/${company.id}/edit"><i class="bi bi-pencil-square"></i></a>
                                        <button data-bs-toggle="modal" data-bs-target="#deleteModal${company.id}">
                                            <i class="bi bi-trash text-danger ms-2"></i>
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#companyTableBody').append('<tr><td colspan="11" class="text-center">No records found.</td></tr>');
                    }
                }
            });
        }
    });


</script>

@endsection
