@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <form action="{{ route('brand.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Edit Brand</div>
            </div>
            <div class="col-md-10 p-3">
                <div class="row">
                    <div class="col-md-6">
                        <div>
                            <label class="eighteenblack mb-2">Company Name</label>
                            {{-- <input type="text" name="company_name" class="form-control" id="name" placeholder="HPDC"> --}}
                            <select name="company_id" class="form-control" id="">
                                <option selected disabled>Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ $company->id == $brand->company_id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Power of Attorney (Start Date)</label>
                            <input type="text" name="start_date" value="{{ $brand->start_date }}" class="form-control datepickerdesign" placeholder="Enter Start Date">
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" checked value="" id="checkDefault">
                            <label class="form-check-label" for="checkDefault">
                                Email Alert Pre/post expiry
                            </label>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div>
                            <label class="eighteenblack mb-2">Brand Name</label>
                            <input type="text" name="brand_name" value="{{ $brand->brand_name }}" class="form-control" id="name" placeholder="Enter Brand Name">
                            @error('brand_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Power of Attorney (Expiry Date)</label>
                            <input type="text" name="end_date" value="{{ $brand->end_date }}" class="form-control datepickerdesign" placeholder="Enter Expiry Date">
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>


                </div>
                <div class="col-md-12">
                    <div class="mb-3 mt-3">
                        <label for="userDetail" class="eighteenblack mb-2">USER DETAIL (optional)</label>
                        <textarea name="detail" class="form-control" id="companydetail" rows="Company Details (optional)5" placeholder="Type company details...">{{ $brand->detail }}</textarea>
                    </div>
                </div>

            </div>
            <div class="col-md-2 px-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="container d-flex justify-content-center">
                            <label class="dropzone" id="dropzoneImg">
                                <input type="file" name="brand_logo" id="logoInput" accept="image/*">
                                <div id="placeholderImg">
                                    @if($brand->brand_logo)
                                        <img src="{{ asset('storage/'.$brand->brand_logo) }}" alt="Upload Icon" class="dropzone-icon">
                                    @else
                                        <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                                    @endif
                                    {{-- <img src="{{ asset('storage/'. $brand->brand_logo) }}" alt="Upload Icon" class="dropzone-icon"> --}}
                                    <div class="label_title">Upload Brand <br>Logo here</div>
                                </div>
                                <img id="previewImg" style="display: none;" />
                            </label>
                        </div>


                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="container d-flex justify-content-center">
                            <label class="dropzone" id="dropzonePdf">
                                <input type="file" name="brand_pdf" id="logoInput2" accept="application/pdf">
                                <div id="placeholderPdf">

                                    @if($brand->brand_pdf)
                                    <a href="{{ asset('storage/'. $brand->brand_pdf) }}" target="_blank"><img src="{{ asset('admin/images/pdf.png') }}" width="30px"></a>
                                        {{-- <img src="{{ asset('storage/'.$company->company_pdf) }}" alt="Upload Icon" class="dropzone-icon"> --}}
                                    @else
                                        <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                                    @endif

                                    {{-- <img src="{{ asset('storage/'. $brand->brand_pdf) }}" alt="Upload Icon" class="dropzone-icon"> --}}
                                    <div class="label_title">Upload Brand <br>PDF here</div>
                                </div>
                                <span id="pdfFilename" class="text-dark mt-2" style="display:none;"></span>
                            </label>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-12 mb-3 mt-3 d-flex justify-content-between">
                <div>
                    <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                        data-url="{{ route('product.create') }}">
                        <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                        Add Product
                    </a>
                </div>
                <div>
                    <a href="{{ route('brand.index') }}" type="button" class="btn btn-cancel me-2">Cancel</a>
                    <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-brand="product" data-bs-target="#confirmSubmitModal">Submit</button>
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

                    <a href="{{ route('product.create') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" name="action" value="Product">Confirm</button>
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
                <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal" data-url="{{ route('product.create') }}">
                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                    Add Product
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
    document.addEventListener("DOMContentLoaded", function() {
        const hamburger = document.getElementById("hamburger");
        const sidebar = document.getElementById("sidebar");
        const closeBtn = document.getElementById("closeBtn");

        hamburger.addEventListener("click", function() {
            sidebar.classList.add("active");
        });

        closeBtn.addEventListener("click", function() {
            sidebar.classList.remove("active");
        });
    });
</script>
@endsection
