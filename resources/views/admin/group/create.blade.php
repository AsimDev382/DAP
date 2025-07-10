@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <form id="mainForm" action="{{ route('group.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Group </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Group Name*</label>
                    <input type="text" name="group_name" value="{{ old('group_name') }}" class="form-control" placeholder="Enter Group Name">
                    @error('group_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Department*</label>
                    <select name="department_id" class="form-control" id="">
                        <option selected disabled>Select Sub Group</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Sub Department*</label>
                    <select name="sub_department_id" class="form-control" id="">
                        <option selected disabled>Select Sub Group</option>
                        @foreach ($sub_departments as $sub)
                            <option value="{{ $sub->id }}" {{ old('sub_department_id') == $sub->id ? 'selected' : '' }}>{{ $sub->sub_name }}</option>
                        @endforeach
                    </select>
                    @error('sub_department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
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

            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Group Member*</label>
                    <select class="form-select" name="user_id" aria-label="Default select example">
                        <option selected disabled>Select Group Member</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>



            <div class="col-md-12 mb-3 ">
             <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                    {{-- <button class="btn btn-cancel">
                        <img src="{{ asset('admin/images/add.svg') }}" alt=" Icon" class="img-fluid me-3">Add Sub Groups
                    </button> --}}
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('group.index') }}" class="btn btn-cancel me-2">Cancel</a>
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
