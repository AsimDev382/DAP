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
    <form id="mainForm" action="{{ route('invoice.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Invoice</div>
            </div>
            @php
            $latestUser = \App\Models\Invoice::orderBy('id', 'desc')->first();
            $nextNumber = $latestUser ? $latestUser->id + 1 : 1;
            $code = 'DP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            @endphp
            <div class="col-md-12">
                <div class="row d-flex align-items-baseline">
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">DAP ID</label>
                            <input type="text" name="auto_id" class="form-control" value="{{ $code }}" readonly id="name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Client ID</label>
                            <input type="text" id="ClientId" class="form-control" readonly>
                            <input type="hidden" name="client_id" id="hideClientId">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Case Name*</label>

                            <select name="case_id" class="form-control">
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
                </div>
            </div>
            <div class="col-md-2">
                <div>
                    <label class="eighteenblack mb-2">Case Type*</label>
                    <select class="form-select" name="case_type" aria-label="Default select example">
                        <option selected disabled>Select Case</option>
                        <option value="Targeted" {{ old('case_type') == 'Targeted' ? 'selected' : '' }}>Targeted</option>
                        <option value="Pro Active" {{ old('case_type') == 'Pro Active' ? 'selected' : '' }}>Pro Active</option>
                    </select>
                    @error('case_type')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Company*</label>
                    <select name="company_id" id="Company_id" class="form-control">
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

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Brand*</label>
                    <select name="brand_id" id="brand_id" class="form-select">
                        <option selected disabled>Select Brand</option>
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
                        <option selected disabled>Select Product</option>
                    </select>
                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- <div class="col-md-2">
                <div class="mb-3">
                    <label class="eighteenblack">Company*</label>
                    <select name="company_id" id="CompanyId" class="form-control">
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
            <div class="col-md-2">
                <div class="mb-3">
                    <label class="eighteenblack">Brand*</label>
                    <select name="brand_id" class="form-select" aria-label="Default select example">
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
            <div class="col-md-3">
                <div class="mb-3">
                    <label class="eighteenblack">Products*</label>
                    <select name="product_id" class="form-select" aria-label="Default select example">
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

            <div class="col-md-3">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Currency*</label>
                    <select name="currency_id" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Currency</option>
                        @foreach ($currencies as $currency)
                        <option value="{{ $currency->id }}" {{ old('currency_id') == $currency->id ? 'selected' : '' }}>{{ $currency->currency_name }}</option>
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
                        <option value="High" {{ old('case_priority') == 'High' ? 'selected' : '' }}>High Priority</option>
                        <option value="Medium" {{ old('case_priority') == 'Medium' ? 'selected' : '' }}>Medium Priority</option>
                        <option value="Low" {{ old('case_priority') == 'Low' ? 'selected' : '' }}>Low Priority</option>

                    </select>
                    @error('case_priority')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Advance Fee*</label>
                    <input type="text" name="advance_fee" class="form-control" value="{{ old('advance_fee') }}" placeholder="Enter Advance Fee">
                    @error('advance_fee')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Case Expenses*</label>
                    <select name="case_expense" class="form-select">
                        <option value="Disbursements" {{ old('case_expense') == 'Disbursements' ? 'selected' : '' }}>Disbursements</option>
                        <option value="Other Expenses" {{ old('case_expense') == 'Other Expenses' ? 'selected' : '' }}>Other Expenses</option>
                    </select>
                    @error('case_expense')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Total Amount*</label>
                    <input type="text" name="total_amount" class="form-control" value="{{ old('total_amount') }}" placeholder="Enter Total Amount">
                    @error('total_amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Discount*</label>
                    <input type="text" name="discount" value="{{ old('discount') }}" class="form-control" placeholder="Enter Discount">
                    @error('discount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Case Location*</label>
                    <input type="text" name="case_location" value="{{ old('case_location') }}" class="form-control" id="flag" placeholder="Enter Case Location">
                    @error('case_location')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-2">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Start Date*</label>
                    <input type="text" name="start_date" value="{{ old('start_date') }}" class="form-control datepickerdesign" placeholder="Start Date">
                    @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="my-3">
                    <label class="eighteenblack mb-2">End Date*</label>
                    <input type="text" name="end_date" value="{{ old('end_date') }}" class="form-control datepickerdesign" placeholder="End Date">
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
                        <option value="Pending Approval">Pending Approval</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Closed(Completed)">Closed(Completed)</option>
                        <option value="High-Risk-case">High-Risk-case</option>
                        <option value="Reopened Cases">Reopened Cases</option>
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
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $('#CompanyId').change(function() {
            var CompanyId = $(this).val();

            if (CompanyId) {
                $.ajax({
                    url: '/invoice/get-auto-id-data/' + CompanyId,
                    type: 'GET'
                    , success: function(response) {
                        console.log(response);

                        $('#ClientId').val(response.auto_id);

                        $('#hideClientId').val(response.auto_id);
                    }
                    , error: function() {
                        alert('Error fetching user date.');
                    }
                });
            } else {
                $('#UserClientId, #UserClientName').val('');
            }
        });
    });

</script>
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
