@extends('admin.layouts.adminlayout')
@section('main-content')

{{-- <div class="main-content"> --}}

<div class="row px-5">
    <div class="col-md-12">
        <div class="fw-bold fs-4 me-3">Product Profile</div>
    </div>
    <div class="col-md-12 card p-4 mt-3">
        <div class="row d-flex justify-content-between">
            <div class="col-md-6 d-flex">
                @if($product->images->first())
                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" class="img-fluid divimg rounded">
                @endif
                {{-- <div><img src="{{ asset('storage/'. $product->images[0]->image_pah) }}" class="img-fluid divimg" alt="..."></div> --}}
            <div class="ms-2">
                <h6 class="sixteenblackk pt-3">Product Name</h6>
                <h1 class="eighteenblacke">{{ $product->product_name }}</h1>
            </div>
        </div>
        <div class="col-md-4  d-flex justify-content-end align-items-center">
            <div> <a href="{{ route('product.edit', $product->id) }}" type="submit" class="btn btn-primary px-5 py-2">Edit</a></div>
        </div>
    </div>
    <hr>

    <div class="row mt-3 ">
        <div class="col">
            <p class="sixteenblackk m-0">Company Name</p>
            <p class="eighteenblacke">{{ $product->company->company_name }}</p>
        </div>
        <div class="col">
            <p class="sixteenblackk m-0">Brand Name</p>
            <p class="eighteenblackee">{{ $product->brand->brand_name }}</p>
        </div>
        <div class="col">
            <p class="sixteenblackk m-0">Email</p>
            <p class="eighteenblacke">{{ $product->company->company_email }}</p>
        </div>
        <div class="col">
            <p class="sixteenblackk m-0">Phone No</p>
            <p class="eighteenblacke">{{ $product->company->phone_no }}</p>
        </div>
        <div class="col">
            <p class="sixteenblackk m-0">Address</p>
            <p class="eighteenblacke">{{ $product->company->company_address }}</p>
        </div>
    </div>



    <div class="row mt-3">

        <div class="col-md-3">
            <div class="d-flex">
                @foreach($product->images as $img)
                <img src="{{ asset('storage/'. $img->image_path) }}" class="p-2 rounded" style="width: 150px;">
                @endforeach
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <p class="sixteenblackk">Product Details</p>
            <p class="eighteenblacke">{{ $product->product_detail }}</p>
        </div>
    </div>

</div>

</div>

{{-- </div> --}}

@endsection
