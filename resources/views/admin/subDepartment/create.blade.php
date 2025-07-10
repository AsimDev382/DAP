@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <form id="mainForm" action="{{ route('sub-department.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Sub Department </div>
            </div>

            <div class="col-md-12">
                <div class="mt-3">
                    <label class="eighteenblack mb-2">Department Name*</label>
                    <input type="text" name="sub_name" class="form-control" value="{{ old('sub_name') }}" placeholder="Enter Department Name">
                    @error('sub_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Department Location*</label>
                    <input type="text" name="sub_location" class="form-control" value="{{ old('sub_location') }}" placeholder="Enter Department Location">
                    @error('sub_location')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>



            <div class="col-md-12 mb-3 ">
             <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                </div>
                <div  class="col-md-6 text-end">
                    <button type="button" class="btn btn-cancel me-2">Cancel</button>
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
