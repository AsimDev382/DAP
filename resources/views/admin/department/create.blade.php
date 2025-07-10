@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <form id="mainForm" action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Department </div>
            </div>
            <div class="col-md-12">
                <div>
                    <label class="eighteenblack mb-2">Company*</label>
                    <select name="company_id" class="form-control" id="">
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
            <div class="col-md-12">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Sub Department*</label>
                    <select name="sub_department_id" class="form-control" id="">
                        <option selected disabled>Select Sub Department</option>
                        @foreach ($sub_department as $department)
                            <option value="{{ $department->id }}" {{ old('sub_department_id') == $department->id ? 'selected' : '' }}>{{ $department->sub_name }}</option>
                        @endforeach
                    </select>
                    @error('sub_department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Department Name*</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Department Name">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Department Head Name*</label>
                    <input type="text" name="head_name" class="form-control" value="{{ old('head_name') }}" placeholder="Enter Department Head Name">
                    @error('head_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Department Location*</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location') }}" placeholder="Enter Department Location">
                    @error('location')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>



            <div class="col-md-12 mb-3 ">
             <div class="row d-flex justify-content-between">
                <div class="col-md-4">

                    <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                        data-url="{{ route('sub-department.create') }}">
                        <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                        Add Sub Departments
                    </a>
                </div>
                <div class="col-md-4 text-end">
                    <button type="button" class="btn btn-cancel me-2">Cancel</button>
                    <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
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

                    <a href="{{ route('sub-department.create') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" name="action" value="SubDepartment">Confirm</button>
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
                <a href="#" class="btn btn-cancel" data-bs-toggle="modal" data-bs-target="#confirmRedirectModal"
                    data-url="{{ route('sub-department.create') }}">
                    <img src="{{ asset('admin/images/add.svg') }}" alt="Icon" class="img-fluid me-3">
                    Add Sub Departments
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
