@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Raid Documentation</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">
                <div class="col-md-2 d-flex ">

                    <div>
                        <h6 class=" sixteenblackk pt-4">Raid Type</h6>
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
                        <h6 class="sixteenblackk pt-4">Date</h6>
                        <h1 class="eighteenblacke">{{ $raid->date }}</h1>
                    </div>
                </div>
                <div class="col-md-2 d-flex ">

                    <div>
                        <h6 class="sixteenblackk pt-4">Status</h6>
                        <h1 class="eighteenblacke">{{ $raid->status }}</h1>
                    </div>
                </div>

                <div class="col-md-2  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('raid.doc.edit', $raid->id) }}" class="btn btn-primary px-5 py-2">Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3 d-flex justify-content-between">
                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Department</p>
                    <p class="eighteenblacke">{{ $raid->department->name }}</p>
                </div>

                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Sub Department</p>
                    <p class="eighteenblacke">{{ $raid->subDepartment->sub_name ?? '' }}</p>
                </div>
                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Group</p>
                    <p class="eighteenblacke">{{ $raid->group->group_name ?? '' }}</p>
                </div>
                <div class="col-md-2">
                    <p class="sixteenblackk m-0">Location</p>
                    <p class="eighteenblacke">{{ $raid->location }}</p>
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
                    {{-- <button class="btn btn-primary mt-4">Download All</button> --}}
                </div>

            </div>

        </div>

    </div>
</div>

</div>


@endsection
