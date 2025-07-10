@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Invoice</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">

                <div class="col-md-2 d-flex">

                    <div class="ms-3">
                        <h6 class="fourteen pt-4">Case Name</h6>
                        <h1 class="twenty">{{ $invoice->cases->case_name }}</h1>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Dap ID</h6>
                        <b>{{ $invoice->auto_id }}</b>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Start Date</h6>
                        <b>{{ $invoice->start_date }}</b>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Status</h6>
                        <b>{{ $invoice->status }}</b>
                    </div>
                </div>
                <div class="col-md-2  d-flex justify-content-end align-items-center">
                    <div> <a href="#" class="btn btn-primary px-4 py-2"><i class="fa-regular fa-eye"></i> Preview</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">

                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Company</h6>
                                <h1 class="fourteen">{{ $invoice->company->company_name }}</h1>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Brand</h6>
                                <h1 class="fourteen">{{ $invoice->brand->brand_name }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Product</h6>
                                <h1 class="fourteen ">{{ $invoice->product->product_name }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Net Profit</h6>
                                <h1 class="fourteen "></h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Target Name</h6>
                                <h1 class="fourteen ">{{ $invoice->target_category }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Target Address</h6>
                                <h1 class="fourteen ">{{ $invoice->case_location }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Officer</h6>
                                <h1 class="fourteen ">
                                    @foreach ($invoice->company->user as $user)
                                    {{ $user->name }}</h1>
                                    @endforeach
                                </h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Type</h6>
                                <h1 class="fourteen ">{{ $invoice->case_type }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Priority</h6>
                                <h1 class="fourteen ">{{ $invoice->case_priority }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Advance Fee</h6>
                                <h1 class="fourteen ">{{ $invoice->advance_fee }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Expenses</h6>
                                <h1 class="fourteen ">{{ $invoice->case_expense }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Total Amount</h6>
                                <h1 class="fourteen ">{{ $invoice->total_amount }}</h1>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

@endsection
