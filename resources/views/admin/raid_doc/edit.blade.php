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
    <form id="mainForm" action="{{ route('raid.doc.update', $raid->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Documents</div>
            </div>
            <div class="col-md-10">
                <div class="row d-flex align-items-baseline">

                    <div class="col-md-6">
                        <div class="mt-4">
                            <label class="eighteenblack mb-2">DAP ID</label>
                            <input type="text" class="form-control" value="{{ $raid->auto_id }}" name="auto_id" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mt-4">
                            <label class="eighteenblack mb-2">Raid Type*</label>
                            <select class="form-select" name="raid_type" aria-label="Default select example">
                                <option selected disabled>Select Raid Type</option>
                                <option value="Factory" {{ $raid->raid_type == 'Factory' ? 'selected' : '' }}>Factory</option>
                                <option value="Warehouse" {{ $raid->raid_type == 'Warehouse' ? 'selected' : '' }}>Warehouse</option>
                                <option value="Supplier/Distributor" {{ $raid->raid_type == 'Supplier/Distributor' ? 'selected' : '' }}>Supplier/Distributor</option>
                                <option value="Importer" {{ $raid->raid_type == 'Importer' ? 'selected' : '' }}>Importer</option>
                                <option value="Wholesaler" {{ $raid->raid_type == 'Wholesaler' ? 'selected' : '' }}>Wholesaler</option>
                                <option value="Printing Facility" {{ $raid->raid_type == 'Printing Facility' ? 'selected' : '' }}>Printing Facility</option>
                                <option value="Retailer" {{ $raid->raid_type == 'Retailer' ? 'selected' : '' }}>Retailer</option>
                                <option value="Online Seller" {{ $raid->raid_type == 'Online Seller' ? 'selected' : '' }}>Online Seller</option>
                            </select>
                            @error('raid_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="container d-flex justify-content-center">
                    <label class="dropzone" style="   height: 120px;" id="dropzoneImg">
                        <input type="file" name="document" id="logoInput" accept="image/*">
                        <div id="placeholderImg">
                            {{-- <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon"> --}}
                            @if($raid->document)
                            <img src="{{ asset('storage/'.$raid->document) }}" alt="Upload Icon" class="dropzone-icon">
                                @else
                                <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                            @endif
                            <div class="label_title">Upload Document</div>
                        </div>
                        <img id="previewImg" style="display: none;" />
                    </label>
                </div>
            </div>

            <div class="col-md-4 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Department*</label>
                    <select class="form-select" name="department_id" aria-label="Default select example">
                        <option selected disabled>Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $raid->department_id ? 'selected': '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Sub Department*</label>
                    <select class="form-select" name="sub_department_id" aria-label="Default select example">
                        <option selected disabled>Select Sub Department</option>
                        @foreach ($sub_departments as $sub)
                            <option value="{{ $sub->id }}" {{ $sub->id == $raid->sub_department_id ? 'selected': '' }}>{{ $sub->sub_name }}</option>
                        @endforeach
                    </select>
                    @error('sub_department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Case*</label>
                    <select class="form-select" name="case_id" aria-label="Default select example">
                        <option selected disabled>Select Case</option>
                        @foreach ($cases as $case)
                            <option value="{{ $case->id }}">{{ $case->case_name }}</option>
                        @endforeach
                    </select>
                    @error('case_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-3 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Group*</label>
                    <select class="form-select" name="group_id" aria-label="Default select example">
                        <option selected disabled>Select Group</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}" {{ $group->id == $raid->group_id ? 'selected': '' }}>{{ $group->group_name }}</option>
                        @endforeach
                    </select>
                    @error('group_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3 mt-3">
                <div>
                    <label class="eighteenblack mb-2">Status*</label>
                    <select name="status" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Status</option>
                        <option value="Pending Approval" {{ $raid->status == 'Pending Approval' ? 'selected' : '' }}>Pending Approval</option>
                        <option value="In Progress" {{ $raid->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Approved" {{ $raid->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $raid->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="Closed(Completed)" {{ $raid->status == 'Closed(Completed)' ? 'selected' : '' }}>Closed(Completed)</option>
                        <option value="High-Risk-case" {{ $raid->status == 'High-Risk-case' ? 'selected' : '' }}>High-Risk-case</option>
                        <option value="Reopened Cases" {{ $raid->status == 'Reopened Cases' ? 'selected' : '' }}>Reopened Cases</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-3 mt-3">
                <div class="">
                    <label class="eighteenblack mb-2">Date*</label>
                    <input type="text" value="{{ $raid->date }}" class="form-control datepickerdesign" name="date" placeholder="Enter Date">
                </div>
            </div>

            <div class="col-md-3 mt-3">
                <div class="">
                    <label class="eighteenblack mb-2">Location*</label>
                    <input type="text" class="form-control" value="{{ $raid->location }}" name="location" placeholder="Enter Location">
                </div>
            </div>

            <div class="col-md-12 mb-3 mt-3 d-flex justify-content-end">

                <div> <a href="{{ route('raid.doc.index') }}" class="btn btn-cancel me-2">Cancel</a>
                    <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                        Submit
                    </button>
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

@endsection
