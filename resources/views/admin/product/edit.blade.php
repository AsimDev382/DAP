@extends('admin.layouts.adminlayout')
@section('main-content')

{{-- <div class="main-content"> --}}

<!-- Form -->
<form id="mainForm" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row px-4">
        <div class="col-12 mb-4 ">
            <!-- Title -->
            <div class="fw-bold fs-4 me-3">Edit Product </div>
        </div>
        <div class="col-md-10 px-3 pt-3">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <label class="eighteenblack mb-2">Company*</label>
                        <select name="company_id" id="company_id" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ $company->id == $product->company_id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-3">
                        <label class="eighteenblack mb-2">Product Name*</label>
                        <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control" id="name" placeholder="Enter Product name">
                        @error('product_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class="eighteenblack mb-2">Brand Name*</label>
                        <select name="brand_id" id="brand_id" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select Company</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <label class="eighteenblack mb-2">Product Category*</label>
                        <select name="product_category" class="form-select" aria-label="Default select example">
                            <option selected>Nutella</option>
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
                                <div class="label_title">Upload Product <br>Logo here</div>
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
                        <input type="text" name="trademark_date" value="{{ $product->trademark_date }}" class="form-control datepickerdesign">
                        @error('trademark_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <label class="eighteenblack mb-2 mt-2">Copyright Expiry Date</label>
                        <input type="text" name="copyright_date" value="{{ $product->copyright_date }}" class="form-control datepickerdesign">
                        @error('copyright_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="">
                        <label class="eighteenblack mb-2 mt-2">Patient Expiry Date</label>
                        <input type="text" name="patient_date" value="{{ $product->patient_date }}" class="form-control datepickerdesign">
                        @error('patient_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                @foreach($product->images as $img)
                <div class="col-md-2 col-6 p-3">
                    <img src="{{ asset('storage/'. $img->image_path) }}" class="img-fluid" alt="...">
                </div>
                @endforeach
                <div class="row mt-3" id="imagePreviewContainer"></div>
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
                <textarea class="form-control" name="product_detail" id="productdetail" rows="Product Details (optional)5" placeholder="Type product details...">{{ $product->product_detail }}</textarea>
            </div>
        </div>
        <div class="col-md-12 mb-3 d-flex justify-content-between">
            <div class="col-md-5">
                <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                    data-url="{{ route('case.create') }}">
                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                    Add Case
                </a>
            </div>
            <div class="col-md-5 text-end"> <button type="button" class="btn btn-cancel me-2">Cancel</button>
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
    @if(isset($product))
        loadBrands("{{ $product->company_id }}", "{{ $product->brand_id }}", "{{ $product->product_id }}");
    @endif
});
</script>
@endsection
