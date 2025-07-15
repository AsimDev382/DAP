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
{{-- <div class="main-content"> --}}

<!-- Form -->
<form id="mainForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row px-4">
        <div class="col-12 mb-4 ">
            <!-- Title -->
            <div class="fw-bold fs-4 me-3">Add Product </div>
        </div>
        <div class="col-md-10 px-3 pt-3">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <label class="eighteenblack mb-2">Company*</label>
                        <select name="company_id" id="company_id" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select Company</option>
                            @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                        @error('company_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="my-3">
                        <label class="eighteenblack mb-2">Product Name*</label>
                        <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}" placeholder="Enter Product name">
                        @error('product_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class="eighteenblack mb-2">Brand Name*</label>
                        <select name="brand_id" id="brand_id" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select Brand</option>
                            {{-- @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach --}}
                        </select>
                        @error('brand_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="my-3">
                        <label class="eighteenblack mb-2">Product Category*</label>
                        <select name="product_category" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select Product Category</option>
                            <option>Nutella</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        @error('product_category')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 px-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="container d-flex justify-content-center">
                        <label class="dropzone" id="dropzoneImg">
                            <input type="file" name="product_img[]" id="logoInput" multiple accept="image/*">
                            <div id="placeholderImg">
                                <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                                <div class="label_title">Upload Product</div>
                            </div>
                        </label>
                        @error('product_img')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="">
                        <label class="eighteenblack mb-2 mt-2">Trademark Expiry Date</label>
                        <input type="text" name="trademark_date" value="{{ old('trademark_date') }}" class="form-control datepickerdesign" placeholder="Enter Trademark Expiry Date">
                        @error('trademark_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <label class="eighteenblack mb-2 mt-2">Copyright Expiry Date</label>
                        <input type="text" name="copyright_date" value="{{ old('copyright_date') }}" class="form-control datepickerdesign" placeholder="Enter Copyright Expiry Date">
                        @error('copyright_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <label class="eighteenblack mb-2 mt-2">Patient Expiry Date</label>
                        <input type="text" name="patient_date" class="form-control datepickerdesign" value="{{ old('patient_date') }}" placeholder="Enter Patient Expiry Date">
                        @error('patient_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                {{-- <div class="col-md-2 col-6 p-3"> --}}
                    {{-- <img id="previewImg" class="img-fluid" /> --}}
                    <div class="row mt-3" id="imagePreviewContainer"></div>
                {{-- </div> --}}

            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" checked value="" id="checkDefault">

                <label class="form-check-label" for="checkDefault">
                    Email Alert Pre/post expiry
                </label>
            </div>
        </div>
        <div class="col-md-12">
            <div class="mb-3 mt-3">
                <label for="userDetail" class="eighteenblack mb-2">Product Details (optional)</label>
                <textarea class="form-control" name="product_detail" id="productdetail" rows="Product Details (optional)5" placeholder="Type product details...">{{ old('product_detail') }}</textarea>
            </div>
        </div>
        <div class="col-md-12 mb-3 d-flex justify-content-between">
            <div>

                <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                    data-url="{{ route('case.create') }}">
                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                    Add Case
                </a>
            </div>
            <div> <a href="{{ route('product.index') }}" class="btn btn-cancel me-2">Cancel</a>
                <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                    Submit
                </button>
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

                <a href="{{ route('case.create') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" name="action" value="Case">Confirm</button>
            </div>
            </div>
        </div>
    </div>

</form>

<div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h6 class="modal-title" id="confirmSubmitModalLabel" style="color: #161616;">Are you sure want to submit this form?</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                    data-url="{{ route('case.create') }}">
                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                    Add Case
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
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script> --}}

<script>
    document.getElementById('logoInput').addEventListener('change', function (event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('imagePreviewContainer');

        // Clear previous previews
        previewContainer.innerHTML = '';

        Array.from(files).forEach(file => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();

            reader.onload = function (e) {
                const col = document.createElement('div');
                col.classList.add('col-md-2', 'col-6', 'p-3');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-fluid', 'rounded');

                col.appendChild(img);
                previewContainer.appendChild(col);
            };

            reader.readAsDataURL(file);
        });
    });
</script>
<script>
    $(document).ready(function() {
        // When company changes: load brands
        $('#company_id').on('change', function() {
            let companyId = $(this).val();
            alert('ok')
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
    });
</script>

@endsection
