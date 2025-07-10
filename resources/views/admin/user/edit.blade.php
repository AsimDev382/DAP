@extends('admin.layouts.adminlayout')
@section('main-content')
{{-- <div class="main-content"> --}}

    <!-- Form -->
    <form id="mainForm" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Edit User</div>
            </div>
            <div class="col-md-12">

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="userId" class="form-label mb-2">USER ID</label>
                        <input type="text" name="auto_id" class="form-control" value="{{ $user->auto_id }}" id="userId" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="user_name" class="form-label mb-2">NAME*</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="name" placeholder="">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="name" class="form-label mb-2">Designation*</label>
                        <input type="text" name="designation" class="form-control" value="{{ $user->designation }}" id="designation" placeholder="">
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
                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" id="email" placeholder="">
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <label for="phoneNo" class="form-label mb-2">PHONE NO*</label>
                                        <input type="text" name="user_phone" class="form-control" value="{{ $user->user_phone }}" id="phoneNo" placeholder="+92 123 123 1234">
                                        @error('user_phone')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <label for="company" class="form-label mb-2">Company*</label>
                                        <select name="company_id" class="form-control" id="">
                                            <option selected disabled>Select Company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}" {{ $company->id == $user->company_id ? 'selected' : '' }}>{{ $company->company_name }}</option>
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
                                            <option value="{{ $department->id }}" {{ $company->id == $user->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="department" class="form-control" value="{{ $user->department }}" id="department" placeholder="Enter department"> --}}
                                        @error('department_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="sub_department" class="form-label mb-2">Sub Department*</label>
                                        <select name="sub_department" class="form-control">
                                            <option selected disabled>Select Sub Department</option>
                                            @foreach ($sub_departments as $sub_dpt)
                                            <option value="{{ $sub_dpt->id }}" {{ $sub_dpt->id == $user->sub_department ? 'selected' : '' }}>{{ $sub_dpt->sub_name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input type="text" name="sub_department" class="form-control" value="{{ $user->sub_department }}" id="sub_department" placeholder="Enter sub department"> --}}
                                        @error('sub_department')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="location" class="form-label mb-2">LOCATION*</label>
                                        <input type="text" name="user_location" class="form-control" value="{{ $user->user_location }}" id="location" placeholder="Enter Location">
                                        @error('user_location')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                {{-- {{ dd(asset($user->user_img)) }} --}}

                                <div class="container d-flex justify-content-center">
                                    <label class="dropzone" id="dropzoneImg">
                                        <input type="file" name="user_img" id="logoInput" accept="image/*">
                                        <div id="placeholderImg">
                                            @if($user->user_img)
                                                <img src="{{ asset('storage/'.$user->user_img) }}" alt="Upload Icon" class="dropzone-icon">
                                            @else
                                                <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                                            @endif
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
                            <input type="password" name="password" class="form-control" value="{{ $user->password }}" id="password" placeholder="••••••••">
                            <button class="btn btn-outline-secondary password-toggle" type="button" onclick="togglePassword()">
                                <i class="bi bi-eye-slash" id="toggleIcon"></i>
                            </button>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="confirmPassword" class="form-label mb-2">CONFIRM PASSWORD*</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control" value="{{ $user->password }}" id="confirmPassword" placeholder="••••••••">
                            <button class="btn btn-outline-secondary" type="button" onclick="toggleConfirmPassword()">
                                <i class="bi bi-eye-slash" id="toggleConfirmIcon"></i>
                            </button>
                            @error('passowrd_confirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="address" class="form-label mb-2">ADDRESS*</label>
                        <input type="text" name="user_address" class="form-control" value="{{ $user->user_address }}" id="address" placeholder="Enter Address">
                        @error('user_address')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <div class="mb-3">
                    <label for="userDetail" class="form-label mb-2">USER DETAIL (optional)</label>
                    <textarea class="form-control" name="detail" id="userDetail" rows="5" placeholder="Type User Detail...">{{ $user->detail }}</textarea>
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
