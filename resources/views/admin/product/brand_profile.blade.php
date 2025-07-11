@extends('admin.layouts.adminlayout')
@section('main-content')

{{-- <div class="main-content"> --}}

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Brand Profile</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6 d-flex">
                    <div>
                        @if($brand->brand_logo)
                            <img src="{{ asset('storage/'. $brand->brand_logo) }}" class="img-fluid divimg" alt="...">
                        @else
                            <span>No Image</span>
                        @endif
                    </div>
                    <div class="ms-2">
                        <h6 class="sixteenblackk pt-3">Brand Name</h6>
                        <h1 class="eighteenblacke">{{ $brand->brand_name }}</h1>
                    </div>
                </div>
                <div class="col-md-4  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('brand.edit', $brand->id) }}" type="submit" class="btn btn-primary px-5 py-2">Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col-md-3">
                    <p class="sixteenblackk m-0">Company Name</p>
                    <p class="eighteenblacke">{{ $brand->company->company_name }}</p>
                </div>
                <div class="col-md-3">
                    <p class="sixteenblackk m-0">Email</p>
                    <p class="eighteenblacke">{{ $brand->company->company_email }}</p>
                </div>
                <div class="col-md-3">
                    <p class="sixteenblackk m-0">Phone No</p>
                    <p class="eighteenblacke">{{ $brand->company->phone_no }}</p>
                </div>
                <div class="col-md-3">
                    <p class="sixteenblackk m-0">Address</p>
                    <p class="eighteenblacke">{{ $brand->company->company_address }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <p class="sixteenblackk">Brand Details</p>
                    <p class="eighteenblacke">{{ $brand->detail }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <p class="sixteenblackk">Power of Attoney</p>
                </div>
                <div class="col-md-3">
                    <div>
                            {{-- <iframe src="{{ asset('admin/images/pdf.png') }}"> --}}
                                @if($brand->brand_pdf)
                                <a href="{{ asset('storage/'.$brand->brand_pdf) }}" target="_blank">
                                    <img class="pdff" src="{{ asset('admin/images/pdf.png') }}">
                                </a>
                                  @else
                                  <span>No PDF</span>
                                @endif
                            {{-- </iframe> --}}
                        {{-- <img src="{{ asset('admin/images/pdf.png') }}" class="img-fluid" alt="..."> --}}
                    </div>
                </div>

                <div class="col-md-3 d-flex align-items-center">
                    <div>
                        <p class="sixteenblackk m-0">Attorney Date</p>
                        <p class="eighteenblacke">{{ $brand->end_date }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

{{-- </div> --}}

@endsection
