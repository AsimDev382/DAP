@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Assigned Task Profile</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">
                <div class="col-md-2 d-flex ">

                    <div>
                        <h6 class=" sixteenblackk pt-4">Task Name</h6>
{{-- <h1 class="eighteenblack"><strong>{{ $assignTask->task->task_name }} </strong></h1> --}}
                            @foreach ($tasks as $task)
                            <div class=" d-flex">
                                    <p class="eighteenblacke"><strong>{{ $task->task_name }}</strong></p>
                            </div>
                            @endforeach
                    </div>
                </div>
                <div class="col-md-2 d-flex ">

                    <div>
                        <h6 class="sixteenblack pt-4">Group Name</h6>
                        <h1 class="eighteenblack">{{ $assignTask->group->group_name ?? '' }}</h1>
                    </div>
                </div>
                <div class="col-md-2 d-flex ">

                    <div>
                        <h6 class="sixteenblack pt-4">DAP ID</h6>
                        <h1 class="eighteenblack">{{ $assignTask->auto_id }}</h1>
                    </div>
                </div>
                <div class="col-md-2 d-flex ">

                    <div>
                        <h6 class="sixteenblack pt-4">User Name</h6>
                        <h1 class="eighteenblack">{{ $assignTask->user->name }}</h1>
                    </div>
                </div>
                <div class="col-md-2 d-flex ">

                    <div>
                        <h6 class="sixteenblack pt-4"> Status</h6>
                        <h1 class="eighteenblack">
                            @if($assignTask->status == 'Active')
                            <strong class="text-success">{{ $assignTask->status }}</strong>
                            @else
                            <strong class="text-danger">{{ $assignTask->status }}</strong>
                            @endif
                        </h1>
                    </div>
                </div>
                <div class="col-md-2  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('assign.tasks.edit', $assignTask->id) }}" class="btn btn-primary px-5 py-2">Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3 d-flex justify-content-between">
                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Department</p>
                    <p class="eighteenblacke">{{ $assignTask->department->name }}</p>
                </div>
                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Sub Department</p>
                    <p class="eighteenblacke">{{ $assignTask->department->subDepartment->sub_name }}</p>
                </div>
                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Designation</p>
                    <p class="eighteenblacke">{{ $assignTask->department->head_name }}</p>
                </div>
                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Date</p>
                    <p class="eighteenblacke">{{ $assignTask->assign_date }}</p>
                </div>
                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Expiry Date</p>
                    <p class="eighteenblacke">{{ $assignTask->expiry_date }}</p>
                </div>
                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Location</p>
                    <p class="eighteenblacke">{{ $assignTask->location }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <p class="sixteenblackk m-0">Group Members</p>
                </div>

            </div>
            <div class="row  d-flex justify-content-between">
                <div class="col-md-2">
                    <p class="eighteenblacke m-0">{{ $assignTask->group_member }}</p>
                </div>

            </div>

            <div class="row mt-5">
                <div class="col-md-3">
                    <div>
                        <img src="{{ asset('storage/'. $assignTask->document) }}" class="img-fluid" alt="...">
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
