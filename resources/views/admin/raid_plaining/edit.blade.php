@extends('admin.layouts.adminlayout')
@section('main-content')
@section('style')
   <link rel="stylesheet" href="{{ url('admin/css/style.css') }}">
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<style>
.datepickerdesign ::placeholder {
    color: #c9c9c9;

}
</style>
@endsection

<div class="main-content">

    <!-- Form -->
    <form id="mainForm" action="{{ route('raid.plaining.update', $raid->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Edit Raid Actions</div>
            </div>
            <div class="col-md-10">
                <div class="row d-flex align-items-baseline">

                    <div class="col-md-6">
                        <div class="mt-4">
                            <label class="eighteenblack mb-2">DAP ID</label>
                            <input type="text" class="form-control" name="auto_id" value="{{ $raid->auto_id }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-4">
                            <label class="eighteenblack mb-2">Raid Type*</label>
                            <select class="form-select" name="raid_type" aria-label="Default select example">
                                <option disabled>Select Raid Type</option>
                                <option value="Factory" {{ $raid->raid_type == 'Factory' ? 'selected' : '' }}>Factory</option>
                                <option value="Warehouse" {{ $raid->raid_type == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
                                <option value="Supplier/Distributor" {{ $raid->raid_type == 'Supplier/Distributor' ? 'selected' : '' }}>Supplier/Distributor</option>
                                <option value="Importer" {{ $raid->raid_type == 'Importer' ? 'selected' : '' }}>Importer</option>
                                <option value="Wholesaler" {{ $raid->raid_type == 'Wholesaler' ? 'selected' : '' }}>Wholesaler</option>
                                <option value="Printing Facility" {{ $raid->raid_type == 'Printing Facility' ? 'selected' : '' }}>Printing Facility</option>
                                <option value="Retailer" {{ $raid->raid_type == 'Retailer' ? 'selected' : '' }}>Retailer</option>
                                <option value="Online Seller" {{ $raid->raid_type == 'Online Seller' ? 'selected' : '' }}>Online Seller</option>
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
                    <label class="dropzone" style="   height: 120px;" id="dropzoneImg">
                        <input type="file" name="document" id="logoInput" accept="image/*">
                        <div id="placeholderImg">
                            @if($raid->document)
                            <img src="{{ asset('storage/'.$raid->document) }}" alt="Upload Icon" class="dropzone-icon">
                                @else
                                <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                            @endif
                            <div class="label_title">Upload Document</div>
                        </div>
                        <img id="previewImg" style="display: none;" />
                    </label>
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Company*</label>
                    <select name="company_id" id="company_id" class="form-control">
                        <option disabled>Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ $raid->company_id == $company->id ? 'selected' : '' }}>
                                {{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Brand*</label>
                    <select name="brand_id" id="brand_id" class="form-select">
                        <option disabled>Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ $raid->brand_id == $brand->id ? 'selected' : '' }}>
                                {{ $brand->brand_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Select Products*</label>
                    <select name="product_id" id="product_id" class="form-select">
                        <option disabled>Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $raid->product_id == $product->id ? 'selected' : '' }}>
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
                <div class="">
                    <label class="eighteenblack mb-3">Company*</label>
                    <select class="form-select" name="company_id" aria-label="Default select example">
                        <option selected disabled>Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ $company->id == $raid->company_id ? 'selected': '' }}>{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="">
                    <label class="eighteenblack mb-3">Brand*</label>
                    <select class="form-select" name="brand_id" aria-label="Default select example">
                        <option selected disabled>Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ $brand->id == $raid->brand_id ? 'selected': '' }}>{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="">
                    <label class="eighteenblack mb-3">Products*</label>
                    <select class="form-select" name="product_id" aria-label="Default select example">
                        <option selected disabled>Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ $product->id == $raid->product_id ? 'selected': '' }}>{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div> --}}

            <div class="col-md-4 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Department*</label>
                    <select class="form-select" name="department_id" aria-label="Default select example">
                        <option selected disabled>Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $raid->department_id ? 'selected': '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Sub Department*</label>
                    <select class="form-select" name="sub_department_id" aria-label="Default select example">
                        <option selected disabled>Select Sub Department</option>
                        @foreach ($sub_departments as $sub)
                            <option value="{{ $sub->id }}" {{ $sub->id == $raid->sub_department_id ? 'selected': '' }}>{{ $sub->sub_name }}</option>
                        @endforeach
                    </select>
                    @error('sub_department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="">
                    <label class="eighteenblack mb-2"> Date*</label>
                    <input type="text" name="date" value="{{ $raid->date }}" class="form-control datepickerdesign" placeholder="Enter Date">
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Group*</label>
                    <select class="form-select" name="group_id" aria-label="Default select example">
                        <option selected disabled>Select Group</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}" {{ $group->id == $raid->group_id ? 'selected': '' }}>{{ $group->group_name }}</option>
                        @endforeach
                    </select>
                    @error('group_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Status*</label>
                    <select name="status" class="form-select" aria-label="Default select example">
                        <option disabled>Select Status</option>
                        <option value="Pending Approval" {{ $raid->status == 'Pending Approval' ? 'selected' : '' }}>Pending Approval</option>
                        <option value="In Progress" {{ $raid->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Approved" {{ $raid->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $raid->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="Closed(Completed)" {{ $raid->status == 'Closed(Completed)' ? 'selected' : '' }}>Closed(Completed)</option>
                        <option value="High-Risk-case" {{ $raid->status == 'High-Risk-case' ? 'selected' : '' }}>High-Risk-case</option>
                        <option value="Reopened Cases" {{ $raid->status == 'Reopened Cases' ? 'selected' : '' }}>Reopened Cases</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="">
                    <label class="eighteenblack mb-2">Location*</label>
                    <input type="text" class="form-control" value="{{ $raid->location }}" name="location" placeholder="Enter Location">
                </div>
            </div>
            <div class="mt-3">
                <label class="eighteenblack mb-2">Raid Description (optional)</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ $raid->description }}</textarea>
            </div>



            <div class="col-md-12 mb-3 mt-3 d-flex justify-content-end">

                <div> <a href="{{ route('raid.plaining.index') }}" class="btn btn-cancel me-2">Cancel</a>
                    <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                        Submit
                    </button>
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
    @if(isset($raid))
        loadBrands("{{ $raid->company_id }}", "{{ $raid->brand_id }}", "{{ $raid->product_id }}");
    @endif
});
</script>
@endsection
