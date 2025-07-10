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
    <form id="mainForm" action="{{ route('pending.destruction.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Destruction</div>
            </div>
            <div class="col-md-12">
                <div class="row d-flex align-items-baseline">
                    @php
                        $latestUser = \App\Models\PendingDestruction::orderBy('id', 'desc')->first();
                        $nextNumber = $latestUser ? $latestUser->id + 1 : 1;
                        $code = 'DP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
                    @endphp

                    <div class="col-md-6">
                        <div class="mt-4">
                            <label class="eighteenblack mb-2">DAP ID</label>
                            <input type="text" class="form-control" name="auto_id" value="{{ $code }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-4">
                            <label class="eighteenblack mb-2">Raid Type*</label>
                            <select class="form-select" name="raid_type" aria-label="Default select example">
                                <option disabled {{ old('raid_type') ? '' : 'selected' }}>Select raid Type</option>
                                <option value="Factory" {{ old('raid_type') == 'Factory' ? 'selected' : '' }}>Factory</option>
                                <option value="Warehouse" {{ old('raid_type') == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
                                <option value="Supplier/Distributor" {{ old('raid_type') == 'Supplier/Distributor' ? 'selected' : '' }}>Supplier/Distributor</option>
                                <option value="Importer" {{ old('raid_type') == 'Importer' ? 'selected' : '' }}>Importer</option>
                                <option value="Wholesaler" {{ old('raid_type') == 'Wholesaler' ? 'selected' : '' }}>Wholesaler</option>
                                <option value="Printing Facility" {{ old('raid_type') == 'Printing Facility' ? 'selected' : '' }}>Printing Facility</option>
                                <option value="Retailer" {{ old('raid_type') == 'Retailer' ? 'selected' : '' }}>Retailer</option>
                                <option value="Online Seller" {{ old('raid_type') == 'Online Seller' ? 'selected' : '' }}>Online Seller</option>
                            </select>
                            @error('raid_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="mt-3">
                    <label class="eighteenblack mb-2">Company*</label>
                    <select name="company_id" id="company_id" class="form-control">
                        <option selected disabled>Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
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
                <div class="mt-3">
                    <label class="eighteenblack mb-2">Brand*</label>
                    <select name="brand_id" id="brand_id" class="form-select">
                        <option selected disabled>Select Brand</option>
                    </select>
                    @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mt-3">
                    <label class="eighteenblack mb-2">Select Products*</label>
                    <select name="product_id" id="product_id" class="form-select">
                        <option selected disabled>Select Product</option>
                    </select>
                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- <div class="col-md-4">
                <div class="mt-3">
                    <label class="eighteenblack mb-3">Company*</label>
                    <select class="form-select" name="company_id" aria-label="Default select example">
                        <option selected disabled>Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-3">
                    <label class="eighteenblack mb-3">Brand*</label>
                    <select class="form-select" name="brand_id" aria-label="Default select example">
                        <option selected disabled>Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="mt-3">
                    <label class="eighteenblack mb-2">Products*</label>
                    <select class="form-select" name="product_id" aria-label="Default select example">
                        <option selected disabled>Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
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
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
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
                            <option value="{{ $sub->id }}" {{ old('sub_department_id') == $sub->id ? 'selected' : '' }}>{{ $sub->sub_name }}</option>
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
                    <input type="text" name="date" value="{{ old('date') }}" class="form-control datepickerdesign" placeholder="Enter Date">
                </div>
                @error('date')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Case*</label>
                    <select class="form-select" name="case_id" aria-label="Default select example">
                        <option selected disabled>Select Case</option>
                        @foreach ($cases as $case)
                            <option value="{{ $case->id }}" {{ old('case_id') == $case->id ? 'selected' : '' }}>{{ $case->case_name }}</option>
                        @endforeach
                    </select>
                    @error('case_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Group*</label>
                    <select class="form-select" name="group_id" aria-label="Default select example">
                        <option selected disabled>Select Group</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->group_name }}</option>
                        @endforeach
                    </select>
                    @error('group_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Status*</label>
                    <select name="status" class="form-select" aria-label="Default select example">
                        <option disabled {{ old('status') ? '' : 'selected' }}>Select Status</option>
                        <option value="Pending Approval" {{ old('status') == 'Pending Approval' ? 'selected' : '' }}>Pending Approval</option>
                        <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Approved" {{ old('status') == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ old('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="Closed(Completed)" {{ old('status') == 'Closed(Completed' ? 'selected' : '' }}>Closed(Completed)</option>
                        <option value="High-Risk-case" {{ old('status') == 'High-Risk-case' ? 'selected' : '' }}>High-Risk-case</option>
                        <option value="Reopened Cases" {{ old('status') == 'Reopened Cases' ? 'selected' : '' }}>Reopened Cases</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3 mt-3">
                <div class="">
                    <label class="eighteenblack mb-2">Location*</label>
                    <input type="text" class="form-control" name="location" value="{{ old('location') }}" placeholder="Enter Location">
                </div>
                @error('location')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-3">
                <label class="eighteenblack mb-2">Destruction Description (optional)</label>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
            </div>



            <div class="col-md-12 mb-3 mt-3 d-flex justify-content-end">

                <div> <a href="{{ route('pending.destruction.index') }}" class="btn btn-cancel me-2">Cancel</a>
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
    $(document).ready(function() {
        // When company changes: load brands
        $('#company_id').on('change', function() {
            let companyId = $(this).val();
            $('#brand_id').html('<option selected disabled>Select Brand</option>');
            $('#product_id').html('<option selected disabled>Select Product</option>');

            if (companyId) {
                $.ajax({
                    url: '/get-company-brands/' + companyId
                    , type: 'GET'
                    , success: function(response) {
                        response.brands.forEach(function(brand) {
                            $('#brand_id').append('<option value="' + brand.id + '">' + brand.brand_name + '</option>');
                        });
                    }
                });
            }
        });

        // When brand changes: load products
        $('#brand_id').on('change', function() {
            let brandId = $(this).val();
            $('#product_id').html('<option selected disabled>Select Product</option>');

            if (brandId) {
                $.ajax({
                    url: '/get-brand-products/' + brandId
                    , type: 'GET'
                    , success: function(response) {
                        response.products.forEach(function(product) {
                            $('#product_id').append('<option value="' + product.id + '">' + product.product_name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
