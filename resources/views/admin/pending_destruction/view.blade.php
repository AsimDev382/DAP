@extends('admin.layouts.adminlayout')
@section('main-content')

    <div class="main-content">

        <div class="row px-5">
            <div class="col-md-12">
                <div class="fw-bold fs-4 me-3">Destruction View</div>
            </div>
            <div class="col-md-12 card p-4 mt-3">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-2 d-flex ">

                        <div>
                            <h6 class=" sixteenblack pt-4">Investigation Name</h6>
                            <h1 class="fourteen"><strong>{{ $pending_des->cases->case_name ?? '' }}</strong></h1>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex ">

                        <div>
                            <h6 class="sixteenblack pt-4">DAP ID</h6>
                            <h1 class="fourteen">{{ $pending_des->auto_id }}</h1>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex ">

                        <div>
                            <h6 class="sixteenblack pt-4">Date</h6>
                            <h1 class="fourteen">{{ $pending_des->date }}</h1>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex ">

                        <div>
                            <h6 class="sixteenblack pt-4"> Status</h6>
                            <h1 class="fourteen"><strong class="text-success">{{ $pending_des->status }}</strong></h1>
                        </div>
                    </div>
                    <div class="col-md-2  d-flex justify-content-end align-items-center">
                        <div> <a href="{{ route('pending.destruction.edit', $pending_des->id) }}" class="btn btn-primary px-5 py-2">Edit</a></div>
                    </div>
                </div>
                <hr>
                <div class="row mt-3 d-flex justify-content-between">
                    <div class="col-md-2">
                        <p class="sixteenblack m-0">Raid Type</p>
                        <p class="fourteen">{{ $pending_des->raid_type }}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblack m-0">Department</p>
                        <p class="fourteen">{{ $pending_des->department->name ?? '' }}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblack m-0">Company Name</p>
                        <p class="fourteen">{{ $pending_des->company->company_name ?? '' }}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblack m-0">Brand Name</p>
                        <p class="fourteen">{{ $pending_des->brand->brand_name ?? '' }}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblack m-0">Location</p>
                        <p class="fourteen">{{ $pending_des->location }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="sixteenblack m-0">Products</p>
                    </div>

                </div>
                <div class="row  d-flex justify-content-between">
                    <div class="col-md-2">
                        <p class="fourteen m-0">{{ $pending_des->product->product_name ?? '' }}</p>
                    </div>
                    {{-- <div class="col-md-2">
                        <p class="sixteenblack m-0">Group Member 02</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblack m-0">Group Member 03</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblack m-0">Group Member 04</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblack m-0">Group Member 05</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblack m-0">Group Member 06</p>
                    </div> --}}

                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="m-0 sixteenblack">Case Details</p>
                        @if ($pending_des->cases)
                            <p class="fourteen m-0">{{ $pending_des->cases->description }}</p>
                        @else
                            <p>No case found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
