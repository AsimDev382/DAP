@extends('admin.layouts.adminlayout')
@section('main-content')
    <div class="main-content">

        <!-- Form -->
        <form id="mainForm" action="{{ route('case.update', $case->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row px-4">
                <div class="col-12 mb-4 ">
                    <!-- Title -->
                    <div class="fw-bold fs-4 me-3">Add Case</div>
                </div>
                <div class="col-md-10">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-md-6">
                            <div class="my-3">
                                <label class="eighteenblack mb-2">DAP ID</label>
                                <input type="text" name="auto_id" class="form-control" value="{{ $case->auto_id }}"
                                    disabled id="name">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="my-3">
                                <label class="eighteenblack mb-2">Case Type*</label>
                                <select class="form-select" name="case_type" aria-label="Default select example">
                                    <option selected>Nutella</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="container d-flex justify-content-center">
                        <label class="dropzone" style="   height: 100px;" id="dropzoneImg">
                            <input type="file" name="document" id="logoInput" accept="image/*">
                            <div id="placeholderImg">
                                @if ($case->document)
                                    <img src="{{ asset('storage/' . $case->document) }}" alt="Upload Icon"
                                        class="dropzone-icon">
                                @else
                                    <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                                @endif
                                <div class="label_title">Upload company <br>Logo here</div>
                            </div>
                            <img id="previewImg" style="display: none;" />
                        </label>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="eighteenblack mb-2">Company*</label>
                        <select name="company_id" id="company_id" class="form-control">
                            <option disabled>Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}"
                                    {{ $case->company_id == $company->id ? 'selected' : '' }}>
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
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $case->brand_id == $brand->id ? 'selected' : '' }}>
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
                        <label class="eighteenblack mb-3">Select Products*</label>
                        <select name="product_id" id="product_id" class="form-select">
                            <option disabled>Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ $case->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->product_name }}
                                </option>
                            @endforeach
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
                            <option value="Market" @if ($case->target_category == 'Market') selected @endif>Market</option>
                            <option value="Customs" @if ($case->target_category == 'Customs') selected @endif>Pakistan Customs</option>

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
                            <option selected disabled>Select Case Priority</option>
                            <option value="High" @if ($case->case_priority == 'High') selected @endif>High Priority</option>
                            <option value="Medium" @if ($case->case_priority == 'Medium') selected @endif>Medium Priority
                            </option>
                            <option value="Low" @if ($case->case_priority == 'Low') selected @endif>Low Priority</option>

                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="my-3">
                        <label class="eighteenblack mb-2">Case Location*</label>
                        <input type="text" value="{{ $case->case_location }}" name="case_location"
                            class="form-control" id="flag">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="my-3">
                        <label class="eighteenblack mb-2">Start Date</label>
                        <input type="text" value="{{ $case->start_date }}" name="start_date"
                            class="form-control datepickerdesign">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="my-3">
                        <label class="eighteenblack mb-2">End Date</label>
                        <input type="text" value="{{ $case->end_date }}" name="end_date"
                            class="form-control datepickerdesign">
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="mb-3 mt-3">
                        <label for="userDetail" class="eighteenblack mb-2">case Description (optional)</label>
                        <textarea name="description" class="form-control" id="companydetail" rows="Company Details (optional)5"
                            placeholder="Type company details...">{{ $case->description }}</textarea>
                    </div>
                </div>



                <div class="col-md-12 mb-3 ">
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
    <script>
        $(document).ready(function() {
            // Load brands when company is selected or on edit
            function loadBrands(companyId, selectedBrandId = null, selectedProductId = null) {
                $('#brand_id').html('<option selected disabled>Select Brand</option>');
                $('#product_id').html('<option selected disabled>Select Product</option>');

                if (companyId) {
                    $.ajax({
                        url: '/get-company-brands/' + companyId,
                        type: 'GET',
                        success: function(response) {
                            response.brands.forEach(function(brand) {
                                let selected = (brand.id == selectedBrandId) ? 'selected' : '';
                                $('#brand_id').append('<option value="' + brand.id + '" ' +
                                    selected + '>' + brand.brand_name + '</option>');
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
                        success: function(response) {
                            response.products.forEach(function(product) {
                                let selected = (product.id == selectedProductId) ? 'selected' :
                                    '';
                                $('#product_id').append('<option value="' + product.id + '" ' +
                                    selected + '>' + product.product_name + '</option>');
                            });
                        }
                    });
                }
            }

            // On company change, load brands
            $('#company_id').on('change', function() {
                const companyId = $(this).val();
                loadBrands(companyId);
            });

            // On brand change, load products
            $('#brand_id').on('change', function() {
                const brandId = $(this).val();
                loadProducts(brandId);
            });

            // On page load (Edit)
            @if (isset($case))
                loadBrands("{{ $case->company_id }}", "{{ $case->brand_id }}", "{{ $case->product_id }}");
            @endif
        });
    </script>
@endsection
