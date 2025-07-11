@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Investigation Profile</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">
                <div class="col-md-2">

                    <div>
                        <h6 class="twelve pt-4">Case Name</h6>
                        <h1 class="twenty">{{ $investigation->invest_name }}</h1>
                    </div>
                </div>
                <div class="col-md-9">

                    <div class="row">
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Client ID</h6>
                                <h1 class="fourteen">{{ $investigation->client_id }}</h1>
                            </div>
                        </div>
                        <div class="col-md-3 p-0">
                            <div>
                                <h6 class="twelve pt-4">Date</h6>
                                <h1 class="fourteen">{{ $investigation->task_start_date }}</h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Current Status</h6>
                                <h1 class="fourteen text-success">
                                @if($investigation->current_status == 'Pending Approval')
                                <span class="text-warning">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'In Progress')
                                <span class="text-primary">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'Approved')
                                <span class="text-success">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'Closed(Completed)')
                                <span class="text-danger">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'High-Risk-case')
                                <span class="text-orange">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'Reopened Cases')
                                <span class="text-info">{{ $investigation->current_status }}</span>
                                @elseif($investigation->current_status == 'Rejected')
                                <span class="text-danger">{{ $investigation->current_status }}</span>
                                @endif
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('investigation.edit', $investigation->id) }}" type="submit" class="btn btn-primary px-4 py-2">Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div>
                                            <h6 class="twelve pt-4">DAP ID</h6>
                                            <h1 class="fourteen ">{{ $investigation->auto_id }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <h6 class="twelve pt-4">Case Type</h6>
                                            <h1 class="fourteen ">{{ $investigation->case_type }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <h6 class="twelve pt-4">Company Name</h6>
                                            <h1 class="fourteen ">{{ $investigation->company->company_name }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <h6 class="twelve pt-4">Brand Name</h6>
                                            <h1 class="fourteen ">{{ $investigation->brand->brand_name }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <h6 class="twelve pt-4">Product</h6>
                                            <h1 class="fourteen ">{{ $investigation->product->product_name }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">

                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Location</h6>
                                <h1 class="fourteen ">{{ $investigation->location }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Assign Case</h6>
                                <h1 class="fourteen ">{{ $investigation->case->case_name }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Task Start Date</h6>
                                <h1 class="fourteen ">{{ $investigation->task_start_date }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Task Deadline</h6>
                                <h1 class="fourteen ">{{ $investigation->task_deadline }}</h1>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <h6 class="twelve pt-4">Case Detail</h6>
                                <h1 class="fourteen ">{{ $investigation->case->description }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-3 mt-5">
                    <div>
                        <img src="{{ asset('admin/images/pdf.svg') }}" class="img-fluid" alt="...">
                    </div>
                </div>

        </div>

    </div>


</div>

@endsection
