@extends('admin.layouts.adminlayout')
@section('main-content')
@section('style')
   <link rel="stylesheet" href="{{ url('admin/css/style.css') }}">
 <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

 <style>
        .datepickerdesign ::placeholder {
            color: #c9c9c9;

        }

        .dropdown-toggle::after {
            display: inline-block;
            margin-left: 9.255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;
        }
        .dropdown-toggle-group::after {
            display: inline-block;
            margin-left: 13.255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;
        }

        .dropdown-menu {
            --bs-dropdown-zindex: 1000;
            --bs-dropdown-min-width: 20rem;
            --bs-dropdown-padding-x: 0;
            --bs-dropdown-padding-y: 0.5rem;
            --bs-dropdown-spacer: 0.125rem;
            --bs-dropdown-font-size: 1rem;
            --bs-dropdown-color: var(--bs-body-color);
            --bs-dropdown-bg: var(--bs-body-bg);
            --bs-dropdown-border-color: var(--bs-border-color-translucent);
            --bs-dropdown-border-radius: var(--bs-border-radius);
            --bs-dropdown-border-width: var(--bs-border-width);
            --bs-dropdown-inner-border-radius: calc(var(--bs-border-radius) - var(--bs-border-width));
            --bs-dropdown-divider-bg: var(--bs-border-color-translucent);
            --bs-dropdown-divider-margin-y: 0.5rem;
            --bs-dropdown-box-shadow: var(--bs-box-shadow);
            --bs-dropdown-link-color: var(--bs-body-color);
            --bs-dropdown-link-hover-color: var(--bs-body-color);
            --bs-dropdown-link-hover-bg: var(--bs-tertiary-bg);
            --bs-dropdown-link-active-color: #fff;
            --bs-dropdown-link-active-bg: #0d6efd;
            --bs-dropdown-link-disabled-color: var(--bs-tertiary-color);
            --bs-dropdown-item-padding-x: 1rem;
            --bs-dropdown-item-padding-y: 0.25rem;
            --bs-dropdown-header-color: #6c757d;
            --bs-dropdown-header-padding-x: 1rem;
            --bs-dropdown-header-padding-y: 0.5rem;
            position: absolute;
            z-index: var(--bs-dropdown-zindex);
            display: none;
            min-width: var(--bs-dropdown-min-width);
            padding: var(--bs-dropdown-padding-y) var(--bs-dropdown-padding-x);
            margin: 0;
            font-size: var(--bs-dropdown-font-size);
            color: var(--bs-dropdown-color);
            text-align: left;
            list-style: none;
            background-color: var(--bs-dropdown-bg);
            background-clip: padding-box;
            border: var(--bs-dropdown-border-width) solid var(--bs-dropdown-border-color);
            border-radius: var(--bs-dropdown-border-radius);
        }

        #select-dropdown {
            width: 100%;
            border-radius: 5px;
            border: var(--bs-border-width) solid var(--bs-border-color);
            padding: 5px;
            "

        }
    </style>
@endsection
<div class="main-content">

     <!-- Form -->
    <form id="mainForm" action="{{ route('assign.tasks.update', $assignTask->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf

        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Edit Assign Task</div>
            </div>
            <div class="col-md-10">
                <div class="row d-flex align-items-baseline">

                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack ">DAP ID</label>
                            <input type="text" class="form-control" value="{{ $assignTask->auto_id }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-3">
                            <label class="eighteenblack ">Case Name*</label>
                            {{-- <input type="text" class="form-control"> --}}
                            <select name="case_management_id" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select Case Name</option>
                            @foreach ($cases as $cases)
                            <option value="{{ $cases->id }}" {{ $cases->id == $assignTask->case_management_id ? 'selected': '' }}>{{ $cases->case_name }}</option>
                            @endforeach
                        </select>
                        @error('case_management_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div>
                            <label class="eighteenblack">Task Name*</label>
                            <div class="dropdown" id="select-dropdown">
                                <button class=" distancecheck dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Task
                                </button>
                                <ul class="dropdown-menu p-2 px-4" aria-labelledby="dropdownMenuButton">
                                    @foreach ($tasks as $task)
                                        <li>
                                            <div class="form-check dropdown-item">
                                                <input class="form-check-input custom-checkbox" type="checkbox"
                                                    value="{{ $task->id }}" {{ in_array($task->id, explode(',', $assignTask->task_id)) ? 'checked' : '' }} id="5kmdistance" name="task_id[]">
                                                <label class="form-check-label"
                                                    for="5kmdistance">{{ $task->task_name }}</label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            @error('task_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-2">
                <div class="container d-flex justify-content-center">
                    <label class="dropzone" style="   height: 120px;" id="dropzoneImg">
                        <input type="file" id="logoInput" name="document" accept="image/*">
                        <div id="placeholderImg">
                            @if($assignTask->document)
                                <img src="{{ asset('storage/'.$assignTask->document) }}" class="dropzone-icon">
                            @else
                                <img src="{{ asset('admin/images/Icon.svg') }}" alt="Upload Icon" class="dropzone-icon">
                            @endif
                            <div class="label_title">Upload Document</div>
                        </div>
                        <img id="previewImg" style="display: none;" />
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="">
                    <label class="eighteenblack mb-3">Department*</label>
                    <select name="department_id" class="form-select" aria-label="Default select example">
                            <option selected disabled>Select Department</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $assignTask->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>
            </div>
            {{-- <div class="col-md-3">
                <div class="">
                    <label class="eighteenblack mb-3">Designation</label>
                    <input type="text" class="form-control" value="{{ $assignTask->department->head_name }}" placeholder="Enter Designation">
                </div>
            </div> --}}

            <div class="col-md-4">
                <div>
                    <label class="eighteenblack mb-3">Group*</label>
                    <div class="dropdown" id="select-dropdown">
                        <button class=" distancecheck dropdown-toggle-group" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Select Group
                        </button>
                        <ul class="dropdown-menu p-2 px-4" aria-labelledby="dropdownMenuButton">
                            @foreach ($groups as $group)
                                <li>
                                    <div class="form-check dropdown-item">
                                        <input class="form-check-input custom-checkbox" type="checkbox"
                                            value="{{ $group->id }}" {{ in_array($group->id, explode(',', $assignTask->group_id)) ? 'checked' : '' }} id="5kmdistance" name="group_id[]">
                                        <label class="form-check-label"
                                            for="5kmdistance">{{ $group->group_name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @error('group_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4">
                <div>
                    <label class="eighteenblack mb-3">Group Member*</label>
                    <div class="dropdown" id="select-dropdown">
                        <button class=" distancecheck dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Select Group Member
                        </button>
                        <ul class="dropdown-menu p-2 px-4" aria-labelledby="dropdownMenuButton">
                            @foreach ($users as $user)
                                <li>
                                    <div class="form-check dropdown-item">
                                        <input class="form-check-input custom-checkbox" type="checkbox"
                                            value="{{ $user->id }}" {{ in_array($user->id, explode(',', $assignTask->user_id)) ? 'checked' : '' }} id="5kmdistance" name="user_id[]">
                                        <label class="form-check-label" for="5kmdistance">{{ $user->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @error('user_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-4 mt-3">
                <div class="">
                    <label class="eighteenblack mb-3">Assign Date*</label>
                    <input type="text" name="assign_date" value="{{ $assignTask->assign_date }}" class="form-control datepickerdesign" placeholder="Assign Date">
                    @error('assign_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="">
                    <label class="eighteenblack mb-3">Expiry Date*</label>
                    <input type="text" name="expiry_date" value="{{ $assignTask->expiry_date }}" class="form-control datepickerdesign" placeholder="Expiry Date">
                    @error('expiry_date')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="">
                    <label class="eighteenblack mb-3">Location*</label>
                    <input type="text" name="location" value="{{ $assignTask->location }}" class="form-control" placeholder="Enter Location">
                    @error('location')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-12 mb-3 mt-3 d-flex justify-content-between">
                <div>
                    {{-- <a href="{{ route('tasks.create') }}" class="btn btn-cancel">
                        <img src="{{ asset('admin/images/add.svg') }}" alt=" Icon" class="img-fluid me-3">Add Task
                    </a> --}}
                </div>
                <div> <a href="{{ route('assign.tasks.index') }}" class="btn btn-cancel me-2">Cancel</a>
                    <button type="button" class="btn btn-primary px-5 py-2" data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">Submit</button>
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
