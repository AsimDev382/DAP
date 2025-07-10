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
    <form id="mainForm" action="{{ route('case.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Case</div>
            </div>
            @php
                $latestUser = \App\Models\CaseManagement::orderBy('id', 'desc')->first();
                $nextNumber = $latestUser ? $latestUser->id + 1 : 1;
                $code = 'DP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            @endphp
            <div class="col-md-10">
                <div class="row d-flex align-items-baseline">
                    <div class="col-md-6">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">DAP ID</label>
                            <input type="text" name="auto_id" class="form-control" value="{{ $code }}"
                                readonly id="name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div>
                            <label class="eighteenblack mb-2">Case Type*</label>
                            <select class="form-select" name="case_type" aria-label="Default select example">
                                <option selected disabled>Select Case</option>
                                <option value="Targeted">Targeted</option>
                                <option value="Pro Active">Pro Active</option>
                            </select>
                            @error('case_type')
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
                            <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                            <div class="label_title">Upload Case <br>Logo here</div>
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
                        <option selected disabled>Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ old('company_id') == $company->id ? 'selected' : '' }}>
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
                        <option selected disabled>Select Brand</option>
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
                        <option selected disabled>Select Product</option>
                    </select>
                    @error('product_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Target Category*</label>
                    <select name="target_category" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Category</option>
                        <option value="Market">Market</option>
                        <option value="Customs">Pakistan Customs</option>
                    </select>
                    @error('target_category')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Case Priority*</label>
                    <select name="case_priority" class="form-select" aria-label="Default select example">
                        <option disabled {{ old('case_priority') ? '' : 'selected' }}>Select Case Priority</option>
                        <option value="High" {{ old('case_priority') == 'High' ? 'selected' : '' }}>High Priority
                        </option>
                        <option value="Medium" {{ old('case_priority') == 'Medium' ? 'selected' : '' }}>Medium
                            Priority</option>
                        <option value="Low" {{ old('case_priority') == 'Low' ? 'selected' : '' }}>Low Priority
                        </option>
                    </select>
                    @error('case_priority')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Case Location*</label>
                    <input type="text" name="case_location" value="{{ old('case_location') }}"
                        class="form-control" id="flag" placeholder="Enter Case Location">
                    @error('case_location')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-6">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Start Date</label>
                    <input type="text" name="start_date" value="{{ old('start_date') }}"
                        class="form-control datepickerdesign">
                    @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="my-3">
                    <label class="eighteenblack mb-2">End Date</label>
                    <input type="text" name="end_date" value="{{ old('end_date') }}"
                        class="form-control datepickerdesign">
                    @error('end_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3 mt-3">
                    <label for="userDetail" class="eighteenblack mb-2">Case Description (optional)</label>
                    <textarea name="description" class="form-control" id="companydetail" rows="Case Details (optional)5"
                        placeholder="Type company details..."></textarea>
                </div>
            </div>



            <div class="col-md-12 mb-3   ">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-4">
                        <a href="#" class="btn btn-cancel" data-bs-toggle="modal"
                            data-bs-target="#confirmRedirectModal" data-url="{{ route('investigation.create') }}">
                            <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                            Add Investigation
                        </a>
                    </div>
                    <div class="col-md-6 text-end"> <a href="{{ route('case.index') }}"
                            class="btn btn-cancel me-2">Cancel</a>
                        <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal"
                            data-bs-target="#confirmSubmitModal">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmRedirectModal" tabindex="-1" aria-labelledby="confirmRedirectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmRedirectModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to submit this data?
                </div>
                <div class="modal-footer">

                    <a href="{{ route('investigation.create') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" name="action" value="Investigation">Confirm</button>
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
                <h6 class="modal-title" id="confirmSubmitModalLabel" style="color: #161616;">Are you sure want to submit this form?</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <a href="#" class="btn btn-cancel" data-bs-toggle="modal"
                    data-bs-target="#confirmRedirectModal" data-url="{{ route('investigation.create') }}">
                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                    Add Investigation
                </a>
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
                    url: '/get-company-brands/' + companyId,
                    type: 'GET',
                    success: function(response) {
                        response.brands.forEach(function(brand) {
                            $('#brand_id').append('<option value="' + brand.id +
                                '">' + brand.brand_name + '</option>');
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
                    url: '/get-brand-products/' + brandId,
                    type: 'GET',
                    success: function(response) {
                        response.products.forEach(function(product) {
                            $('#product_id').append('<option value="' + product.id +
                                '">' + product.product_name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
