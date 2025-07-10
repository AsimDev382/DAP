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
    <form id="mainForm" action="{{ route('evidence.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Evidence</div>
            </div>

            <div class="col-md-12">
                <div class="mb-3 mt-3">
                    <label for="caseDetail" class="eighteenblack mb-2">Case Detail</label>
                    <p id="caseDetail"></p>
                </div>
            </div>


            @php
            $latestUser = \App\Models\Evidence::orderBy('id', 'desc')->first();
            $nextNumber = $latestUser ? $latestUser->id + 1 : 1;
            $code = 'DP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            @endphp
            <div class="col-md-10">
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
                            <input type="text" name="client_id" value="{{ $code.'-'.'client' }}" name="client_id" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Case Name*</label>
                            {{-- <input type="text" name="case_id" value="{{ old('case_id') }}" class="form-control"> --}}
                            <select name="case_id" class="form-select" aria-label="Default select example">
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
                <div class="container d-flex justify-content-center">
                    <label class="dropzone" style="   height: 100px;" id="dropzoneImg">
                        <input type="file" name="document[]" id="logoInput" accept="image/*" multiple>
                        <div id="placeholderImg">
                            <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                            <div class="label_title">Upload Document</div>
                        </div>
                        {{-- <img id="previewImg" style="display: none;" /> --}}
                    </label>
                </div>
                @error('document')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2 col-6 p-3">
                        <img id="previewImg" class="img-fluid"/>
                    </div>
                </div>
            </div>



            <div class="col-md-12 mb-3">
             <div class="row d-flex justify-content-between">
                <div class="col-md-4">

                </div>
                <div class="col-md-6 text-end"> <a href="{{ route('evidence.index') }}" class="btn btn-cancel me-2">Cancel</a>
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
