@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Case</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">
                <div class="col-md-2">

                    <div>
                        <h6 class="fourteen twenty pt-4">Case Name</h6>
                        <h1 class="twenty">{{ $case->case_name }}</h1>
                    </div>
                </div>
                <div class="col-md-9">

                    <div class="row">
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Client ID</h6>
                                <h1 class="fourteen">{{ $evidence->client_id }}</h1>
                            </div>
                        </div>
                        <div class="col-md-3 p-0">
                            <div>
                                <h6 class="twelve pt-4">Date</h6>
                                <h1 class="fourteen">{{ $case->start_date }}</h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Status</h6>
                                <h1 class="fourteen text-success">
                                @if($case->status == 'Pending Approval')
                                <span class="text-warning">{{ $case->status }}</span>
                                @elseif($case->status == 'In Progress')
                                <span class="text-primary">{{ $case->status }}</span>
                                @elseif($case->status == 'Approved')
                                <span class="text-success">{{ $case->status }}</span>
                                @elseif($case->status == 'Closed(Completed)')
                                <span class="text-danger">{{ $case->status }}</span>
                                @elseif($case->status == 'High-Risk-case')
                                <span class="text-orange">{{ $case->status }}</span>
                                @elseif($case->status == 'Reopened Cases')
                                <span class="text-info">{{ $case->status }}</span>
                                @elseif($case->status == 'Rejected')
                                <span class="text-danger">{{ $case->status }}</span>
                                @endif
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('evidence.edit', $evidence->id) }}" type="submit" class="btn btn-primary px-4 py-2">Edit</a></div>
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
                                            <h1 class="fourteen ">{{ $case->auto_id }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <h6 class="twelve pt-4">Case Type</h6>
                                            <h1 class="fourteen ">{{ $case->case_type }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <h6 class="twelve pt-4">Company Name</h6>
                                            <h1 class="fourteen ">{{ $case->company->company_name }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <h6 class="twelve pt-4">Brand Name</h6>
                                            <h1 class="fourteen ">{{ $case->brand->brand_name }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <h6 class="twelve pt-4">Product</h6>
                                            <h1 class="fourteen ">{{ $case->product->product_name }}</h1>
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
                                <h1 class="fourteen ">{{ $case->case_location }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Task Start Date</h6>
                                <h1 class="fourteen ">{{ $case->start_date }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Task Deadline</h6>
                                <h1 class="fourteen ">{{ $case->end_date }}</h1>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div>
                        <h6 class="twelve pt-4">Evidence</h6>
                        @if($evidence->document)
                            <img src="{{ asset('storage/'.$evidence->document) }}" class="img-fluid" alt="...">
                            @else
                            <img src="{{ asset('admin/images/pdf.svg') }}" class="img-fluid" alt="...">
                            @endif
                    </div>
                </div>

            </div>

            <div class="row mt-3 d-flex justify-content-between">
                <div class="col-md-12">
                    <p class="m-0 twenty">Case Details</p>
                    <p class="m-0 fourteen">{{ $case->description }}</p>
                </div>

            </div>
        </div>

    </div>


</div>

@endsection
