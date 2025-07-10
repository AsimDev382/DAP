@extends('admin.layouts.adminlayout')
@section('main-content')

{{-- <div class="main-content"> --}}

<!-- Form -->
<form id="mainForm" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row px-4">
        <div class="col-12 mb-4 ">
            <!-- Title -->
            <div class="fw-bold fs-4 me-3">Add User </div>
        </div>
        <div class="col-md-12">

            @php
            $latestUser = \App\Models\USerAccount::orderBy('id', 'desc')->first();
            $nextNumber = $latestUser ? $latestUser->id + 1 : 1;
            $code = 'DP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            @endphp

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="userId" class="form-label mb-2">USER ID</label>
                    <input type="text" name="auto_id" class="form-control" id="userId" value="{{ $code }}" readonly>
                </div>
                <div class="col-md-4">
                    <label for="name" class="form-label mb-2">NAME*</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name" placeholder="example:(name)">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="name" class="form-label mb-2">Designation*</label>
                    <input type="text" name="designation" value="{{old('designation')}}" class="form-control" id="designation" placeholder="">
                    @error('designation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="email" class="form-label mb-2">EMAIL*</label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="example@gmail.com">
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="phoneNo" class="form-label mb-2">PHONE NO*</label>
                                    <input type="text" name="user_phone" value="{{old('user_phone')}}" class="form-control" id="phoneNo" placeholder="+92 123 123 1234">
                                    @error('phone_no')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="company" class="form-label mb-2">Company*</label>
                                    <select name="company_id" class="form-control">
                                        <option selected disabled>Select Company</option>
                                        @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label for="department_id" class="form-label mb-2">Department*</label>
                                    <select name="department_id" class="form-control">
                                        <option selected disabled>Select Department</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" name="department" value="{{old('department')}}" class="form-control" id="department" placeholder="Enter department"> --}}
                                    @error('department_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label for="sub_department" class="form-label mb-2">Sub Department*</label>
                                    <select name="sub_department" class="form-control">
                                        <option selected disabled>Select Sub Department</option>
                                        @foreach ($sub_departments as $sub_dpt)
                                        <option value="{{ $sub_dpt->id }}">{{ $sub_dpt->sub_name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" name="sub_department" value="{{old('sub_department')}}" class="form-control" id="sub_department" placeholder="Enter sub department"> --}}
                                    @error('sub_department')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mt-4">
                                    <label for="location" class="form-label mb-2">LOCATION*</label>
                                    <input type="text" name="user_location" value="{{old('user_location')}}" class="form-control" id="location" placeholder="Enter Location">
                                    @error('user_location')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">

                            <div class="container d-flex justify-content-center">
                                <label class="dropzone" id="dropzoneImg">
                                    <input type="file" name="user_img" id="logoInput" accept="image/*">
                                    <div id="placeholderImg">
                                        <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                                        <div class="label_title">Upload User <br>Logo here</div>
                                    </div>
                                    <img id="previewImg" style="display: none;" />
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="password" class="form-label mb-2">PASSWORD*</label>
                    <div class="input-group">
                        <input type="password" name="password" value="{{old('password')}}" class="form-control" id="password" placeholder="••••••••" autocomplete="new-password">
                        <button class="btn btn-outline-secondary password-toggle" type="button" onclick="togglePassword()">
                            <i class="bi bi-eye-slash" id="toggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="confirmPassword" class="form-label mb-2">CONFIRM PASSWORD*</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" placeholder="••••••••">
                        <button class="btn btn-outline-secondary" type="button" onclick="toggleConfirmPassword()">
                            <i class="bi bi-eye-slash" id="toggleConfirmIcon"></i>
                        </button>
                    </div>
                    @error('passowrd_confirmed')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="address" class="form-label mb-2">ADDRESS*</label>
                    <input type="text" name="user_address" value="{{old('user_address')}}" class="form-control" id="address" placeholder="Enter Address">
                    @error('user_address')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>



            <div class="mb-3">
                <label for="userDetail" class="form-label mb-2">USER DETAIL (optional)</label>
                <textarea class="form-control" name="detail" id="userDetail" rows="5" placeholder="Type User Detail..."></textarea>
            </div>

            <div class="d-flex justify-content-end mb-lg-5">
                <a href="{{ route('user.index') }}" type="button" class="btn btn-cancel me-2">Cancel</a>
                <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                    Submit
                </button>
            </div>
        </div>
    </div>
</form>

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
