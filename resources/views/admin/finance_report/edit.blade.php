@extends('admin.layouts.adminlayout')
@section('main-content')
@section('style')
   <link rel="stylesheet" href="{{ url('admin/css/style.css') }}">
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

<style>
.datepickerdesign ::placeholder {
    color: #c9c9c9;

}
</style>
@endsection
<div class="main-content">

    <!-- Form -->
    <form id="mainForm" action="{{ route('finance-report.update', $report->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Edit Finance Report</div>
            </div>

            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row d-flex align-items-baseline">
                            <div class="col-md-12">
                                <div class="row d-flex align-items-baseline">
                                    <div class="col-md-12">
                                        <div class="">
                                            <label class="eighteenblack mb-2">DAP ID</label>
                                            <input type="text" name="auto_id" class="form-control" value="{{ $report->auto_id }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <label class="eighteenblack mb-2">Raid Type*</label>
                            <select class="form-select" name="raid_type" aria-label="Default select example">
                                <option selected>Select Raid Type</option>
                                <option value="Factory" {{ $report->raid_type == 'Factory' ? 'selected' : '' }}>Factory</option>
                                <option value="Warehouse" {{ $report->raid_type == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
                                <option value="Supplier/Distributor" {{ $report->raid_type == 'Supplier/Distributor' ? 'selected' : '' }}>Supplier/Distributor</option>
                                <option value="Importer" {{ $report->raid_type == 'Importer' ? 'selected' : '' }}>Importer</option>
                                <option value="Wholesaler" {{ $report->raid_type == 'Wholesaler' ? 'selected' : '' }}>Wholesaler</option>
                                <option value="Printing Facility" {{ $report->raid_type == 'Printing Facility' ? 'selected' : '' }}>Printing Facility</option>
                                <option value="Retailer" {{ $report->raid_type == 'Retailer' ? 'selected' : '' }}>Retailer</option>
                                <option value="Online Seller" {{ $report->raid_type == 'Online Seller' ? 'selected' : '' }}>Online Seller</option>
                            </select>
                            @error('raid_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <div class="container d-flex justify-content-center">
                    <label class="dropzone" style="   height: 100px;" id="dropzoneImg">
                        <input type="file" name="document" id="logoInput" accept="image/*">
                        <div id="placeholderImg">
                            @if($report->document)
                            <img src="{{ asset('storage/'.$report->document) }}" alt="Upload Icon" class="dropzone-icon">
                                @else
                                <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                            @endif
                            <div class="label_title">Upload Document</div>
                        </div>
                        <img id="previewImg" style="display: none;" />
                    </label>
                </div>
                @error('document')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Company*</label>
                    <select name="company_id" id="company_id" class="form-control">
                        <option disabled>Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ $report->company_id == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Brand*</label>
                    <select name="brand_id" id="brand_id" class="form-select">
                        <option disabled>Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ $report->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brand_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Select Products*</label>
                    <select name="product_id" id="product_id" class="form-select">
                        <option disabled>Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $report->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack">Company*</label>
                    <select name="company_id" class="form-control">
                        <option selected disabled>Select Company</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $company->id == $report->company_id ? 'selected': '' }}>{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack">Brand*</label>
                    <select name="brand_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Brand</option>
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $report->brand_id ? 'selected': '' }}>{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack">Products*</label>
                    <select name="product_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Product</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $product->id == $report->product_id ? 'selected': '' }}>{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div> --}}

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Department*</label>
                    <select name="department_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Department</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $department->id == $report->department_id ? 'selected': '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Sub Department*</label>
                    <select name="sub_department_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Sub Department</option>
                        @foreach ($subDepartments as $sub)
                        <option value="{{ $sub->id }}" {{ $sub->id == $report->sub_department_id ? 'selected': '' }}>{{ $sub->sub_name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="">
                    <label class="eighteenblack mb-2">Date*</label>
                    <input type="text" name="date" value="{{ $report->date }}" class="form-control datepickerdesign" placeholder="Enter Date">
                    @error('date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

             <div class="row">
                <div class="col mb-3">
                    <label class="eighteenblack mb-2">Group*</label>
                    <select name="group_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Group</option>
                        @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ $group->id == $report->group_id ? 'selected': '' }}>{{ $group->group_name }}</option>
                        @endforeach
                    </select>
                    @error('group_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col mb-3">
                    <label class="eighteenblack mb-2">Status*</label>
                    <select name="status" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Status</option>
                        <option value="Pending Approval" {{ $report->status == 'Pending Approval' ? 'selected' : '' }}>Pending Approval</option>
                        <option value="In Progress" {{ $report->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Approved" {{ $report->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $report->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="Closed(Completed)" {{ $report->status == 'Closed(Completed)' ? 'selected' : '' }}>Closed(Completed)</option>
                        <option value="High-Risk-Case" {{ $report->status == 'High-Risk-Case' ? 'selected' : '' }}>High-Risk-case</option>
                        <option value="Reopened Cases" {{ $report->status == 'Reopened Cases' ? 'selected' : '' }}>Reopened Cases</option>
                    </select>
                    @error('status')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col mb-3">
                    <label class="eighteenblack mb-2">Location*</label>
                    <input type="text" name="location" value="{{ $report->location }}" class="form-control" placeholder="Enter Location">
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col mb-3">
                    <label class="eighteenblack mb-2">Expenses*</label>
                    <input type="text" name="expenses" value="{{ $report->expenses }}" class="form-control" placeholder="Enter Expenses">
                    @error('expenses')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col mb-3">
                    <label class="eighteenblack mb-2">Profit*</label>
                    <input type="text" name="profit" value="{{ $report->profit }}" class="form-control" placeholder="Enter Profit">
                    @error('profit')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3 mt-3">
                    <label class="eighteenblack mb-2">Description (optional)</label>
                    <textarea name="description" class="form-control" id="summernote">{{ $report->description }}</textarea>
                </div>
            </div>



            <div class="col-md-12">
             <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                </div>
                <div class="col-md-6 text-end"> <a href="{{ route('finance-report.index') }}" class="btn btn-cancel me-2">Cancel</a>
                    <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                        Submit
                    </button>
                </div>
             </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h6 class="modal-title" id="confirmSubmitModalLabel" style="color: #161616;">Confirm Submision</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <span style="font-size: 18px;">Are you sure want to submit this form?</span>
            </div>

            <div class="modal-footer justify-content-between">
                <div class="float-left">
                    <input type="checkbox"> Don't show again
                </div>

                <div class="float-left">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const totalInput = document.querySelector('input[name="total_amount"]');
        const payedInput = document.querySelector('input[name="payed_amount"]');
        const balanceInput = document.querySelector('input[name="balance"]');

        function calculateBalance() {
            const total = parseFloat(totalInput.value) || 0;
            const payed = parseFloat(payedInput.value) || 0;
            const balance = total - payed;
            balanceInput.value = balance.toFixed(2);
        }

        totalInput.addEventListener('input', calculateBalance);
        payedInput.addEventListener('input', calculateBalance);
    });
</script>
<script>
    $(document).ready(function () {
    // Load brands when company is selected or on edit
    function loadBrands(companyId, selectedBrandId = null, selectedProductId = null) {
        $('#brand_id').html('<option selected disabled>Select Brand</option>');
        $('#product_id').html('<option selected disabled>Select Product</option>');

        if (companyId) {
            $.ajax({
                url: '/get-company-brands/' + companyId,
                type: 'GET',
                success: function (response) {
                    response.brands.forEach(function (brand) {
                        let selected = (brand.id == selectedBrandId) ? 'selected' : '';
                        $('#brand_id').append('<option value="' + brand.id + '" ' + selected + '>' + brand.brand_name + '</option>');
                    });

                    // If brand was preselected, load its products too
                    if (selectedBrandId) {
                        loadProducts(selectedBrandId, selectedProductId);
                    }
                }
            });
        }
    }

    // Load products when brand is selected
    function loadProducts(brandId, selectedProductId = null) {
        $('#product_id').html('<option selected disabled>Select Product</option>');

        if (brandId) {
            $.ajax({
                url: '/get-brand-products/' + brandId,
                type: 'GET',
                success: function (response) {
                    response.products.forEach(function (product) {
                        let selected = (product.id == selectedProductId) ? 'selected' : '';
                        $('#product_id').append('<option value="' + product.id + '" ' + selected + '>' + product.product_name + '</option>');
                    });
                }
            });
        }
    }

    // On company change, load brands
    $('#company_id').on('change', function () {
        const companyId = $(this).val();
        loadBrands(companyId);
    });

    // On brand change, load products
    $('#brand_id').on('change', function () {
        const brandId = $(this).val();
        loadProducts(brandId);
    });

    // On page load (Edit)
    @if(isset($report))
        loadBrands("{{ $report->company_id }}", "{{ $report->brand_id }}", "{{ $report->product_id }}");
    @endif
});
</script>
@endsection
