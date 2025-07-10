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
    <form id="mainForm" action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Task</div>
            </div>
            <div class="col-md-10">
                <div class="row d-flex align-items-baseline">
                    <div class="col-md-5">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">DAP ID</label>
                            <input type="text" name="auto_id" class="form-control" value="{{ $task->auto_id }}" readonly id="name">
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="my-3">
                            <label class="eighteenblack mb-2">Task Name*</label>
                            <input type="text" name="task_name" value="{{ $task->task_name }}" class="form-control">
                            @error('task_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-2">
                        <div class="container d-flex justify-content-center">
                            <label class="dropzone" style="   height: 100px;" id="dropzoneImg">
                                <input type="file" name="document" id="logoInput" accept="image/*">
                                <div id="placeholderImg">
                                    @if($task->document)
                                    <a href="{{ asset('storage/'.$task->document) }}" target="_blank"><img src="{{ asset('admin/images/pdf.png') }}" alt="Upload Icon" width="50px" class="dropzone-icon"></a>
                                    @else
                                    <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                                    @endif
                                    {{-- <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon"> --}}
                                    <div class="label_title">Upload Task Document</div>
                                </div>
                                <img id="previewImg" style="display: none;" />
                            </label>
                        </div>
                        @error('document')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>




            <div class="col-md-4">
                <div class="mb-3">
                    <label class="eighteenblack mb-2">Department*</label>
                    <select name="department_id" class="form-control">
                        <option selected disabled>Select Department</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $department->id == $task->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
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
                    <select name="sub_department_id" class="form-control">
                        <option selected disabled>Select Sub Department</option>
                        @foreach ($subdepartments as $subdepartments)
                        <option value="{{ $subdepartments->id }}" {{ $subdepartments->id == $task->sub_department_id ? 'selected' : '' }}>{{ $subdepartments->sub_name }}</option>
                        @endforeach
                    </select>
                    @error('sub_department_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

             <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Status*</label>

                    <select name="status" class="form-select" aria-label="Default select example">
                        <option selected disabled>Select Status</option>
                        <option value="Pending Approval" {{ $task->status == 'Pending Approval' ? 'selected' : '' }}>Pending Approval</option>
                        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Approved" {{ $task->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ $task->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="Closed(Completed)" {{ $task->status == 'Closed(Completed)' ? 'selected' : '' }}>Closed(Completed)</option>
                        <option value="High-Risk-case" {{ $task->status == 'High-Risk-case' ? 'selected' : '' }}>High-Risk-case</option>
                        <option value="Reopened Cases" {{ $task->status == 'Reopened Cases' ? 'selected' : '' }}>Reopened Cases</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>



            <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Date*</label>
                    <input type="text" name="start_date" value="{{ $task->start_date }}" class="form-control datepickerdesign">
                    @error('start_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Expiry Date*</label>
                    <input type="text" name="expiry_date" value="{{ $task->expiry_date }}" class="form-control datepickerdesign">
                    @error('expiry_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-4">
                <div class="my-3">
                    <label class="eighteenblack mb-2">Task Location*</label>
                    <input type="text" name="task_location" value="{{ $task->task_location }}" class="form-control" placeholder="Enter Task Location">
                    @error('task_location')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-12">
                <div class="mb-3 mt-3">
                    <label for="" class="eighteenblack mb-2">Task Description (optional)</label>
                    <textarea name="task_description" class="form-control" rows="Task Details (optional)5" placeholder="Type Task details...">{{ $task->task_description }}</textarea>
                </div>
            </div>



            <div class="col-md-12 mb-3   ">
             <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                    {{-- <a href="{{ route('investigation.create') }}" class="btn btn-cancel">
                        <img src="{{ asset('admin/images/add.svg') }}" alt=" Icon" class="img-fluid me-3">Add Investigation
                    </a> --}}
                </div>
                <div class="col-md-6 text-end"> <a href="{{ route('tasks.index') }}" class="btn btn-cancel me-2">Cancel</a>
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

@endsection
