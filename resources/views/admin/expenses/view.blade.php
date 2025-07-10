@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Expenses</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">

                <div class="col-md-2 d-flex">

                    <div class="ms-3">
                        <h6 class="fourteen pt-4">Case Name</h6>
                        <h1 class="twenty">{{ $expense->cases->case_name }}</h1>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Dap ID</h6>
                        <b>{{ $expense->auto_id }}</b>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Start Date</h6>
                        <b>{{ $expense->start_date }}</b>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Status</h6>
                        <b>{{ $expense->status }}</b>
                    </div>
                </div>
                <div class="col-md-2  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-primary px-4 py-2">Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">

                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Company</h6>
                                <h1 class="fourteen">{{ $expense->company->company_name }}</h1>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Brand</h6>
                                <h1 class="fourteen">{{ $expense->brand->brand_name }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Product</h6>
                                <h1 class="fourteen ">{{ $expense->product->product_name }}</h1>
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
                                <h1 class="fourteen ">{{ $expense->target_category }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Target Address</h6>
                                <h1 class="fourteen ">{{ $expense->case_location }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Officer</h6>
                                <h1 class="fourteen ">
                                    @foreach ($expense->company->user as $user)
                                    {{ $user->name }}</h1>
                                    @endforeach
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Type</h6>
                                <h1 class="fourteen ">{{ $expense->case_type }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Priority</h6>
                                <h1 class="fourteen ">{{ $expense->case_priority }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Expenses</h6>
                                <h1 class="fourteen ">{{ $expense->case_expense }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Case Profit</h6>
                                <h1 class="fourteen ">{{ $expense->total_amount - $expense->case_expense }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Total Amount</h6>
                                <h1 class="fourteen ">{{ $expense->total_amount }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Disbursement</h6>
                                <h1 class="fourteen ">{{ $expense->disbursement }}</h1>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

@endsection
