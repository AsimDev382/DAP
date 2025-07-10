@extends('admin.layouts.adminlayout')
@section('main-content')
@section('style')
<style>
    div .text-danger{
        font-size: 14px;
    }
</style>
@endsection
{{-- <div class="main-content"> --}}
<form id="mainForm" action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row px-4">
        <div class="col-12 mb-4 ">
            <!-- Title -->
            <div class="fw-bold fs-4 me-3">Add Company </div>
        </div>
        <div class="col-md-10 p-3">
            <div class="row">
                <div class="col-md-6">
                    <div>
                        <label class="eighteenblack mb-2">Company Name*</label>
                        <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" id="name" placeholder="HPDC">
                        @error('company_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <label class="eighteenblack mb-2">Email*</label>
                        <input type="email" name="company_email" class="form-control" value="{{ old('company_email') }}" id="name" placeholder="Enter email">
                        @error('company_email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="my-3">
                        <label class="eighteenblack mb-3">Password</label>
                        <div class="input-group">
                        <input type="password" name="password" class="form-control" value="{{ old('company_name') }}" id="password" placeholder="Enter Password">
                    <button class="btn btn-outline-secondary password-toggle" type="button" onclick="togglePassword()">
                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div> --}}
            <div class="my-3">
                <label class="eighteenblack mb-2">MOU Date</label>
                <input type="text" name="mou_start_date" value="{{ old('mou_start_date') }}" class="form-control datepickerdesign" placeholder="Enter MOU Date">
                @error('mou_start_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" value="" checked id="checkDefault">

                <label class="form-check-label" for="checkDefault">
                    Email Alert Pre/post expiry
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <label class="eighteenblack mb-2">Address*</label>
                <input type="text" name="company_address" class="form-control" value="{{ old('company_address') }}" id="name" placeholder="Enter Address">
                @error('company_address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="my-3">
                <label class="eighteenblack mb-2">Phone No*</label>
                <input type="text" name="phone_no" class="form-control" value="{{ old('phone_no') }}" id="name" placeholder="Enter Phone No">
                @error('phone_no')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="my-3">
                        <label class="eighteenblack mb-3">Confirm Password</label>
                        <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('company_name') }}" id="confirmPassword" placeholder="Confirm Password">
            <button class="btn btn-outline-secondary" type="button" onclick="toggleConfirmPassword()">
                <i class="bi bi-eye-slash" id="toggleConfirmIcon"></i>
            </button>
        </div>
        @error('password_confirmation')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div> --}}
    <div class="my-3">
        <label class="eighteenblack mb-2">MOU Expire Date</label>
        <input type="text" name="mou_end_date" value="{{ old('mou_end_date') }}" class="form-control datepickerdesign" placeholder="Enter MOU Expire Date">
        @error('mou_end_date')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    </div>
    </div>

    </div>
    <div class="col-md-2 px-2">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="container d-flex justify-content-center">
                    <label class="dropzone" id="dropzoneImg">
                        <input type="file" name="company_logo" id="logoInput" accept="image/*">
                        <div class="" id="placeholderImg">
                            <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                            <div class="label_title">Upload Company <br>Logo here</div>
                        </div>
                        <img id="previewImg" style="display: none;" />
                    </label>
                </div>
                {{-- <div class="container d-flex justify-content-center">
                            <label class="dropzone" id="dropzoneImg">
                                <input type="file" name="company_logo" id="logoInput" accept="image/*">
                                <div class="image">
                                    <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                <div class="label_title">Upload Company <br>Logo here</div>
            </div>
            <img id="previewImg" style="display: none;" />
            </label>
        </div> --}}
    </div>


    <div class="col-md-12 mt-3">

        <div class="container d-flex justify-content-center">
            <label class="dropzone" id="dropzonePdf">
                <input type="file" name="company_pdf" id="logoInput2" accept="application/pdf">
                <div id="placeholderPdf">
                    <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                    <div class="label_title">Upload company <br>PDF here</div>
                </div>
                <span id="pdfFilename" class="text-dark mt-2" style="display:none;"></span>
            </label>
        </div>
    </div>
    </div>

    </div>
    <div class="col-md-12">
        <div class="mb-3 mt-3">
            <label for="userDetail" class="eighteenblack mb-2">Company Detail (optional)</label>
            <textarea class="form-control" name="company_detail" id="companydetail" rows="Company Details (optional)5" placeholder="Type company details...">{{ old('company_detail') }}</textarea>
        </div>
    </div>
    <div class="col-md-12 mb-3 d-flex justify-content-between">
        <div>
            {{-- <a href="{{ route('brand.create') }}" class="btn btn-cancel">
            <img src="{{ asset('admin/images/add.svg') }}" alt=" Icon" class="img-fluid me-3">Add Brand
            </a> --}}
            <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal" data-url="{{ route('brand.create') }}">
                <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                Add Brand
            </a>
        </div>
        <div> <a href="{{ route('company.index') }}" type="button" class="btn btn-cancel me-2">Cancel</a>
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

                <a href="{{ route('brand.create') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary" name="action" value="Brand">Confirm</button>
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
                <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal" data-url="{{ route('brand.create') }}">
                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                    Add Brand
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
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    }

    function toggleConfirmPassword() {
        const passwordInput = document.getElementById('confirmPassword');
        const toggleIcon = document.getElementById('toggleConfirmIcon');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    }

</script>
@endsection
