@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-4">
        <div class="col-md-12 mb-4 case-bar ">
            <div class="row d-flex align-items-center justify-content-between  gap-3">

                <!-- Title -->
        <div class="col-md-1">
            <p class="fw-bold fs-5 me-3 m-0">Product</p>
        </div>

                <!-- Search -->
                <div class="col-md-6">
                    <div class="case-search flex-grow-1">
                        <i class="fas fa-search"></i>
                        <input type="text" class="form-control" id="productSearch" placeholder="Search here..." />
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

                    @can('create product')
                    <a href="{{ route('product.create') }}" type="submit" class="btn btn-primary px-5 py-2">Product</a>
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
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Brand Name</th>
                            <th>Company Name</th>
                            <th>Total Cases</th>
                            <th>Approved Cases</th>
                            <th>Pending Cases</th>
                            <th>Not Approved</th>
                            <th>In-Hand Cases</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        @forelse ($products as $key => $product)

                        <tr class="table-card-row">
                            <td>{{ $key + 1 }}</td>
                            <td><a href="{{ route('product.profile', $product->id) }}">{{ $product->product_name }}</a></td>
                            <td>
                                @if($product->images->count())
                                    @foreach($product->images as $img)
                                        <img src="{{ asset('storage/' . $img->image_path) }}" style="height: 20px; width: 30px;">
                                    @endforeach
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $product->brand->brand_name }}</td>
                            <td>{{ $product->company->company_name }}</td>
                            <td>{{ $product->case->count() }}</td>
                            <td>{{ $product->approved_count }}</td>
                            <td>{{ $product->pending_count }}</td>
                            <td>{{ $product->closed_count }}</td>
                            <td>{{ $product->in_progress_count }}</td>
                            <td>
                                <span
                                    class="badge toggle-status {{ $product->status === 'Active' ? 'text-bg-success' : 'text-bg-danger' }}"
                                    data-id="{{ $product->id }}"
                                    data-status="{{ $product->status }}"
                                    style="cursor: pointer;">
                                    {{ $product->status }}
                                </span>
                              {{-- <span class="badge toggle-status text-bg-success" style="cursor: pointer;">Active</span> --}}
                            </td>
                            <td>
                                @can('edit product')
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#confirmEditModal"
                                        data-url="{{ route('product.edit', $product->id) }}"><i class="bi bi-pencil-square"></i></a>
                                @endcan
                                @can('delete product')
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}"><i class="bi bi-trash text-danger ms-2"></i></button>
                                @endcan
                            </td>
                            {{-- <td><i class="bi bi-pencil-square"></i> <i class="bi bi-trash  text-danger ms-2"></i></td> --}}
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('product.destroy', $product->id) }}">
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
                            <td class="text-center" colspan="12">No records found</td>
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
            url: '/product/update-status/' + id,
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
        $('#productSearch').on('keyup', function () {
            let value = $(this).val().toLowerCase();
            let hasVisible = false;

            // Loop through all rows except the "no data" row
            $('#productTableBody tr').each(function () {
                if (!$(this).attr('id')) {
                    let match = $(this).text().toLowerCase().indexOf(value) > -1;
                    $(this).toggle(match);
                    if (match) hasVisible = true;
                }
            });

            // If no visible rows, show the noDataRow (create it if it doesn't exist)
            if (!hasVisible) {
                if ($('#noDataRow').length === 0) {
                    $('#productTableBody').append(`
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

        filterProduct(newOrder);
    });

    function filterProduct(sortOrder) {
        $.ajax({
            url: '{{ route("product.sort") }}',
            type: 'GET',
            data: {
                sortFilter: sortOrder
            },
            success: function(response) {
                $('#productTableBody').empty();

                if (response.length > 0) {
                    $.each(response, function(index, product) {
                        // Images rendering loop
                        let productImages = '';
                        if (product.images && product.images.length > 0) {
                            $.each(product.images, function(i, img) {
                                productImages += `<img src="/storage/${img.image_path}" style="height: 20px; width: 30px;"> `;
                            });
                        }

                        // Status badge
                        let statusBadge = `<span class="badge toggle-status ${product.status === 'Active' ? 'text-bg-success' : 'text-bg-danger'}"
                            data-id="${product.id}" data-status="${product.status}" style="cursor: pointer;">${product.status}</span>`;

                        // Build table row
                        $('#productTableBody').append(`
                            <tr class="table-card-row">
                                <td>${index + 1}</td>
                                <td>${product.product_name}</td>
                                <td>${productImages}</td>
                                <td><a href="/product/brand/${product.brand_id}/profile">${product.brand_name}</a></td>
                                <td>${product.company_name}</td>
                                <td>${product.case_count}</td>
                                <td>${product.approved_count}</td>
                                <td>${product.pending_count}</td>
                                <td>${product.closed_count}</td>
                                <td>${product.in_progress_count}</td>
                                <td>${statusBadge}</td>
                                <td>
                                    ${product.can_edit ? `<a href="/product/${product.id}/edit"><i class="bi bi-pencil-square"></i></a>` : ''}
                                    ${product.can_delete ? `<button data-bs-toggle="modal" data-bs-target="#deleteModal${product.id}"><i class="bi bi-trash text-danger ms-2"></i></button>` : ''}
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    $('#productTableBody').append('<tr><td colspan="12" class="text-center">No records found.</td></tr>');
                }
            }
        });
    }
});

</script>

@endsection
