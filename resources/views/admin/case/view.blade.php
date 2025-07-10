@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Case</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">
                <div class="col-md-2  ">

                    <div>
                        <h6 class="fourteen twenty pt-4">Company Name</h6>
                        <h1 class="twenty">{{ $company->company_name }}</h1>
                    </div>
                </div>
                <div class="col-md-9  ">

                    <div class="row">
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">DAP ID</h6>
                                <h1 class="fourteen">{{ $case->auto_id }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Client ID</h6>
                                <h1 class="fourteen">{{ $case->client_id }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2 p-0">
                            <div>
                                <h6 class="twelve pt-4">Start Date</h6>
                                <h1 class="fourteen">{{ $case->start_date }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2 p-0">
                            <div>
                                <h6 class="twelve pt-4">Submitted Date</h6>
                                <h1 class="fourteen">{{ $case->end_date }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2 p-0">
                            <div>
                                <h6 class="twelve pt-4">Approved Date</h6>
                                <h1 class="fourteen">{{ $case->end_date }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Status</h6>
                                <h1 class="fourteen text-success">{{ $case->status }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1  d-flex justify-content-end align-items-center">
                    <div> <button type="submit" class="btn btn-primary px-4 py-2">Edit</button></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Product</h6>
                                            <h1 class="fourteen ">{{ $product->product_name }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Brand</h6>
                                            <h1 class="fourteen ">{{ $brand->brand_name }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Company</h6>
                                            <h1 class="fourteen ">{{ $company->company_name }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Case Type</h6>
                                            <h1 class="fourteen ">{{ $case->case_type }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Target Name</h6>
                                            <h1 class="fourteen "></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Target Category</h6>
                                            <h1 class="fourteen">{{ $case->target_category }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Target Address</h6>
                                            <h1 class="fourteen"></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Target GPS Location</h6>
                                            <h1 class="fourteen "></h1>
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
                                <h6 class="twelve pt-4">Proactive Case Officer</h6>
                                <h1 class="fourteen "></h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Initial Investigation Officer</h6>
                                <h1 class="fourteen "></h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">In Depth Investigation Officer</h6>
                                <h1 class="fourteen "></h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Enforcement Officer</h6>
                                <h1 class="fourteen "></h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Priority</h6>
                                <h1 class="fourteen ">{{ $case->case_priority }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Deadline </h6>
                                <h1 class="fourteen text-danger">{{ $case->end_date }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div>
                                            <h6 class="twelve pt-4">Proactive start Date</h6>
                                            <h1 class="fourteen ">{{ $case->start_date }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <h6 class="twelve pt-4">Proactive completion Date</h6>
                                            <h1 class="fourteen ">{{ $case->end_date }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <h6 class="twelve pt-4">In Depth Start Date</h6>
                                            <h1 class="fourteen "></h1>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">In Depth Complete Date</h6>
                                            <h1 class="fourteen "></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Enforcement Start Date</h6>
                                            <h1 class="fourteen"></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Enforcement Completion Date</h6>
                                            <h1 class="fourteen"></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Destruction Date</h6>
                                            <h1 class="fourteen "></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div>
                                            <h6 class="twelve pt-4">Case Fee</h6>
                                            <h1 class="fourteen ">{{ $case->case_fee }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <h6 class="twelve pt-4">Case Expenses</h6>
                                            <h1 class="fourteen "></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <h6 class="twelve pt-4">Net Profit</h6>
                                            <h1 class="fourteen "></h1>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Invoice Status</h6>
                                            <h1 class="fourteen text-success">{{ $case->status }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Task Overdue</h6>
                                            <h1 class="fourteen"></h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Next Task </h6>
                                            <h1 class="fourteen">{{ $case->task }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Flag </h6>
                                            <h1 class="fourteen "> {{ $case->flag }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="m-0 twenty">Case Details</p>
                    <p class="m-0 fourteen">{{ $case->description }}</p>
                </div>
            </div>

            <div class="row mt-3 d-flex justify-content-between">

                <div class="col-md-3">
                    <div>
                        <img src="{{ asset('admin/images/pdf.svg') }}" class="img-fluid" alt="...">
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-center justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">View Feedback</button>
                </div>
            </div>
        </div>

    </div>


</div>

@endsection
