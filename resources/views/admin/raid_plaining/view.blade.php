@extends('admin.layouts.adminlayout')
@section('main-content')

    <div class="main-content">

        <div class="row px-5">
            <div class="col-md-12">
                <div class="fw-bold fs-4 me-3">Raid Actions</div>
            </div>
            <div class="col-md-12 card p-4 mt-3">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-2 d-flex ">

                        <div>
                            <h6 class="sixteenblackk pt-4">Raid Type</h6>
                            <h1 class="eighteenblacke"><strong>{{ $raid->raid_type }}</strong></h1>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex ">

                        <div>
                            <h6 class="sixteenblackk pt-4">DAP ID</h6>
                            <h1 class="eighteenblacke">{{ $raid->auto_id }}</h1>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex ">

                        <div>
                            <h6 class="sixteenblackk pt-4">Group Name</h6>
                            <h1 class="eighteenblacke">{{ $raid->group->group_name ?? '' }}</h1>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex ">

                        <div>
                            <h6 class="sixteenblackk pt-4">Date</h6>
                            <h1 class="eighteenblacke">{{ $raid->date }}</h1>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex ">

                        <div>
                            <h6 class="sixteenblackk pt-4"> Status</h6>
                            <h1 class="eighteenblacke"><strong class="text-success">{{ $raid->status }}</strong></h1>
                        </div>
                    </div>
                    <div class="col-md-2  d-flex justify-content-end align-items-center">
                        <div> <a href="{{ route('raid.plaining.edit', $raid->id) }}" class="btn btn-primary px-5 py-2">Edit</a></div>
                    </div>
                </div>
                <hr>
                <div class="row mt-3 d-flex justify-content-between">
                    <div class="col-md-2">
                        <p class="sixteenblackk m-0">Department</p>
                        <p class="eighteenblacke">{{ $raid->department->name }}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblackk m-0">Case DAP ID</p>
                        @if ($raid->cases)
                            <p class="eighteenblacke">{{ $raid->cases->auto_id }}</p>
                        @else
                            <p>No case found</p>
                        @endif
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblackk m-0">Company Name</p>
                        <p class="eighteenblacke">{{ $raid->company->company_name ?? '' }}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblackk m-0">Brand Name</p>
                        <p class="eighteenblacke">{{ $raid->brand->brand_name ?? '' }}</p>
                    </div>
                    <div class="col-md-2">
                        <p class="sixteenblackk m-0">Location</p>
                        <p class="eighteenblacke">{{ $raid->location }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="sixteenblackk m-0">Products</p>
                    </div>

                </div>
                <div class="row  d-flex justify-content-between">
                    <div class="col-md-2">
                        <p class="eighteenblacke m-0">{{ $raid->user->name ?? '' }}</p>
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
                        <p class="m-0 sixteenblackk">Case Details</p>
                        @if ($raid->cases)
                            <p class="eighteenblacke m-0">{{ $raid->cases->description }}</p>
                        @else
                            <p>No case found</p>
                        @endif
                    </div>
                </div>
                <div class="row mt-5">

                    <div class="col-md-3">
                        <div>
                            @if($raid->document)
                                <img src="{{ asset('storage/'.$raid->document) }}" class="img-fluid" alt="...">
                            @else
                                <img src="{{ asset('admin/images/pdf.svg') }}" class="img-fluid" alt="...">
                            @endif
                        </div>
                    </div>



                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="thirtyeightblack">Raid Actions performed</p>

                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>Investigation ID</th>
                                    <th>Investigation Name</th>
                                    <th>Raid Type</th>
                                    <th>Department</th>
                                    <th>Case DAP ID</th>
                                    <th> Date</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr class="table-card-row">
                                    <td>01</td>
                                    <td>8345</td>
                                    <td>Abc Investigation</td>
                                    <td>Monitoring</td>
                                    <td>Investigation</td>
                                    <td>8345</td>
                                    <td>01-01-2026</td>

                                    <td><i class="bi bi-pencil-square"></i> <i class="bi bi-trash  text-danger ms-2"></i></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>


@endsection
