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
    <form id="mainForm" action="{{ route('invoice.update', $invoice->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Edit Invoice</div>
            </div>

            <div class="col-md-12">
                <div class="row d-flex align-items-baseline">
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">DAP ID</label>
                            <input type="text" name="auto_id" class="form-control" value="{{ $invoice->auto_id }}" readonly id="name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Client ID</label>
                            <input type="text" name="client_id" value="{{ $invoice->client_id}}" name="client_id" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Case Name*</label>
                            <select name="case_id" class="form-control">
                                <option selected disabled>Select Case</option>
                                @foreach ($cases as $case)
                                <option value="{{ $case->id }}" {{ $invoice->case_id == $case->id ? 'selected' : '' }}>{{ $case->case_name }}</option>
                                @endforeach
                            </select>
                            @error('case_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div>
                    <label class="eighteenblack mb-2">Case Type*</label>
                    <select class="form-select" name="case_type" aria-label="Default select example">
                        <option selected disabled>Select Case</option>
                        <option value="Targeted" {{ $invoice->case_type =='Targeted' ? 'selected' : '' }}>Targeted</option>
                        <option value="Pro Active" {{ $invoice->case_type == 'Pro Active' ? 'selected' : '' }}>Pro Active</option>
                    </select>
                    @error('case_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="">
                    <label class="eighteenblack mb-2">Company*</label>
                    <select name="company_id" id="company_id" class="form-control">
                        <option disabled>Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ $invoice->company_id == $company->id ? 'selected' : '' }}>
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
                <div class="">
                    <label class="eighteenblack mb-2">Brand*</label>
                    <select name="brand_id" id="brand_id" class="form-select">
                        <option disabled>Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                                {{ $invoice->brand_id == $brand->id ? 'selected' : '' }}>
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
                                {{ $invoice->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->product_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- <div class="col-md-2">
                <div class="mb-3">
                    <label class="eighteenblack">Company*</label>
                    <select name="company_id" class="form-control">
                        <option selected disabled>Select Company</option>
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}" {{ $invoice->company_id == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="mb-3">
                    <label class="eighteenblack">Brand*</label>
                    <select name="brand_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Brand</option>
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $invoice->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="eighteenblack">Products*</label>
                    <select name="product_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Product</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ $invoice->product_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div> --}}

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Currency*</label>
                    <select name="currency_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Currency</option>
                        @foreach ($currencies as $currency)
                        <option value="{{ $currency->id }}" {{ $invoice->currency_id == $currency->id ? 'selected' : '' }}>{{ $currency->currency_name }}</option>
                        @endforeach
                    </select>
                    @error('currency_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Target Category*</label>
                    <select name="target_category" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Category</option>
                        <option value="1">One</option>
                        <option value="2">two</option>
                        <option value="3">Three</option>

                    </select>
                    @error('target_category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Case Priority*</label>
                    <select name="case_priority" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Case Priority</option>
                        <option value="High" {{ $invoice->case_priority == 'High' ? 'selected' : '' }}>High Priority</option>
                        <option value="Medium" {{ $invoice->case_priority == 'Medium' ? 'selected' : '' }}>Medium Priority</option>
                        <option value="Low" {{ $invoice->case_priority == 'Low' ? 'selected' : '' }}>Low Priority</option>

                    </select>
                    @error('case_priority')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Advance Fee*</label>
                    <input type="text" name="advance_fee" class="form-control" value="{{ $invoice->advance_fee }}" placeholder="Enter Advance Fee">
                    @error('advance_fee')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Case Expenses*</label>
                    <select name="case_expense" class="form-select">
                        <option value="Disbursements" {{ $invoice->case_expense == 'Disbursements' ? 'selected' : '' }}>Disbursements</option>
                        <option value="Other Expenses" {{ $invoice->case_expense == 'Other Expenses' ? 'selected' : '' }}>Other Expenses</option>
                    </select>
                    {{-- <input type="text" name="case_expense" class="form-control" value="{{ $invoice->case_expense }}" placeholder="Enter Case Expenses"> --}}
                    @error('case_expense')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Total Amount*</label>
                    <input type="text" name="total_amount" class="form-control" value="{{ $invoice->total_amount }}" placeholder="Enter Total Amount">
                    @error('total_amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Discount*</label>
                    <input type="text" name="discount" value="{{ $invoice->discount }}" class="form-control" placeholder="Enter Discount">
                    @error('discount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Case Location*</label>
                    <input type="text" name="case_location" value="{{ $invoice->case_location }}" class="form-control" id="flag" placeholder="Enter Case Location">
                    @error('case_location')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Start Date*</label>
                    <input type="text" name="start_date" value="{{ $invoice->start_date }}" class="form-control datepickerdesign" placeholder="Start Date">
                    @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-3">
                    <label class="eighteenblack mb-2">End Date*</label>
                    <input type="text" name="end_date" value="{{ $invoice->end_date }}" class="form-control datepickerdesign" placeholder="End Date">
                    @error('end_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Current Status*</label>
                    <select name="status" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Status</option>
                        <option value="Pending Approval" {{ $invoice->status == 'Pending Approval' ? 'selected' : '' }}>Pending Approval</option>
                        <option value="In Progress" {{ $invoice->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Approved" {{ $invoice->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $invoice->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="Closed(Completed)" {{ $invoice->status == 'Closed(Completed)' ? 'selected' : '' }}>Closed(Completed)</option>
                        <option value="High-Risk-case" {{ $invoice->status == 'High-Risk-case' ? 'selected' : '' }}>High-Risk-case</option>
                        <option value="Reopened Cases" {{ $invoice->status == 'Reopened Cases' ? 'selected' : '' }}>Reopened Cases</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
             <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                </div>
                <div class="col-md-6 text-end"> <a href="{{ route('invoice.index') }}" class="btn btn-cancel me-2">Cancel</a>
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
    @if(isset($invoice))
        loadBrands("{{ $invoice->company_id }}", "{{ $invoice->brand_id }}", "{{ $invoice->product_id }}");
    @endif
});
</script>
@endsection
