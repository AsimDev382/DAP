@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Task</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">

                <div class="col-md-3 d-flex">

                    <div class="ms-3">
                        <h6 class="fourteen pt-4">Task Name</h6>
                        <h1 class="twenty">{{ $task->task_name }}</h1>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Dap ID</h6>
                        <strong>{{ $task->auto_id }}</strong>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Status</h6>
                        <strong>{{ $task->status }}</strong>
                    </div>
                </div>
                <div class="col-md-3  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary px-4 py-2">Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">

                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Department</h6>
                                <h1 class="fourteen">{{ $task->department->name }}</h1>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Sub Department</h6>
                                <h1 class="fourteen">{{ $task->subDepartment->sub_name }}</h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Date</h6>
                                <h1 class="fourteen ">{{ $task->start_date }}</h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Expiry Date</h6>
                                <h1 class="fourteen ">{{ $task->expiry_date }}</h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Location</h6>
                                <h1 class="fourteen ">{{ $task->location }}</h1>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-md-12">
                    <p class="m-0 twenty">User Details</p>
                    <p class="m-0 fourteen">{{ $task->task_description }}</p>
                </div>
            </div>

             <div class="row mt-3 d-flex justify-content-between">

                <div class="col-md-3 mt-3">
                    <div>
                        @if($task->document)
                        <img src="{{ asset('storage/'.$task->document) }}" class="img-fluid" class="rounded" alt="UserImg">
                        @else
                        <img src="{{ asset('admin/images/pdf.svg') }}" class="img-fluid" alt="...">
                        @endif
                    </div>
                </div>
            </div>


        </div>

    </div>


</div>

@endsection
