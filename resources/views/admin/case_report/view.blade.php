@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Case Report</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">

                <div class="col-md-2">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Dap ID</h6>
                        <b>{{ $report->auto_id }}</b>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Date</h6>
                        <b>{{ $report->date }}</b>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <h6 class="twelve pt-4">Status</h6>
                        <b>{{ $report->status }}</b>
                    </div>
                </div>
                <div class="col-md-2  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('case-report.edit', $report->id) }}" class="btn btn-primary px-4 py-2"> Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">

                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Raid Type</h6>
                                <h1 class="fourteen">{{ $report->raid_type }}</h1>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Department</h6>
                                <h1 class="fourteen">{{ @$report->department->name }}</h1>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Company</h6>
                                <h1 class="fourteen">{{ $report->company->company_name }}</h1>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Brand</h6>
                                <h1 class="fourteen">{{ $report->brand->brand_name }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Product</h6>
                                <h1 class="fourteen ">{{ $report->product->product_name }}</h1>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <h6 class="twelve pt-4">Location</h6>
                                <h1 class="fourteen ">{{ $report->location }}</h1>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <h6 class="twelve pt-4">Products</h6>
                                <h1 class="fourteen ">{{ $report->product->name }}</h1>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <h6 class="twelve pt-4">Case Detail</h6>
                                <p class="fourteen ">{!! $report->description !!}</p>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div>
                                <h1 class="fourteen ">
                                    @if($report->document)
                                        <img src="{{ asset('storage/'.$report->document) }}" alt="Upload Icon" class="dropzone-icon">
                                    @else
                                         <img src="{{ asset('admin/images/pdf.svg') }}" class="img-fluid" alt="...">
                                    @endif
                                </h1>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

@endsection
