@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Company Profile</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6 d-flex align-items-center">
                    @if($company->company_logo)
                    <div style="height: 100px; widht: 100px;"> <img src="{{ asset('storage/'.$company->company_logo) }}" class="rounded" style="object-fit: contain;height: 100px; widht: 200px;" alt="UserImg"></div>
                    @else
                    <div><img src="{{ asset('admin//images/hilallogo.svg') }}" class="img-fluid" alt="..."></div>
                    @endif
                    <div class="ms-2">
                        <h6 class=" sixteenblackk pt-4">Company Name</h6>
                        <h1 class="eighteenblacke"><strong>{{ $company->company_name }}</strong></h1>
                    </div>
                </div>
                <div class="col-md-4  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('company.edit', $company->id) }}" type="submit" class="btn btn-primary px-5 py-2">Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">
                <div class="col-md-3">
                    <p class="sixteenblackk m-0">Email</p>
                    <p class="eighteenblacke">{{ $company->company_email }}</p>
                </div>
                <div class="col-md-3">
                    <p class="sixteenblackk m-0">Phone No</p>
                    <p class="eighteenblacke">{{ $company->phone_no }}</p>
                </div>
                <div class="col-md-3">
                    <p class="sixteenblackk m-0">Address</p>
                    <p class="eighteenblacke">{{ $company->company_address }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <p class="sixteenblackk">Company Details</p>
                    <p class="eighteenblacke">{{ $company->company_detail }}</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <p class="sixteenblackk">MOU</p>
                </div>
                <div class="col-md-3">
                    <div>

                        @if($company->company_pdf)
                        <a href="{{ asset('storage/'.$company->company_pdf) }}" target="_blank">
                            <img src="{{ asset('admin/images/pdf.png') }}" width="50px" alt="company_pdf">
                        </a>
                        {{-- <div> <img src="{{ asset('storage/'.$company->company_pdf) }}" alt="company_pdf"></div> --}}
                    @else
                    <img src="{{ asset('admin/images/pdf.svg') }}" class="img-fluid" alt="...">
                    @endif
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-center">
                <div>
                    <p class="sixteenblackk m-0">Mou Date</p>
                    <p class="eighteenblacke">{{ $company->mou_start_date }}</p>
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-center">
                <div>
                    <p class="sixteenblackk m-0">Mou Expiry Date</p>
                    <p class="eighteenblacke">{{ $company->mou_end_date }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <!-- Nav Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab">
                    User Accounts
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab">
                    Brand
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab">
                    Products
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- Tab 1 -->
            <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Designation</th>
                            <th>Mobile/Phone</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Sub Department</th>
                            <th>Location</th>
                            <th>Company Name</th>
                            <th>Last Login on</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $key => $user)

                        <tr class="table-card-row">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->auto_id }}</td>
                            <td> {{ $user->name }} </td>
                            <td>{{ $user->designation }}</td>
                            <td>{{ $user->user_phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->department->name }}</td>
                            <td>{{ $user->subDepartment->sub_name }}</td>
                            <td>{{ $user->user_location }}</td>
                            <td>{{ @$user->company->company_name }}</td>
                            <td>{{ $user->created_at }}</td>

                            <td>
                                @can('edit user')
                                <a href="{{ route('user.edit', $user->id) }}"><i class="bi bi-pencil-square"></i></a>&nbsp;&nbsp;&nbsp;
                                @endcan

                                @can('delete user')
                                <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                    <i class="bi bi-trash text-danger ms-2"></i>
                                </button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tab 2 Brand Table -->
            <div class="tab-pane fade" id="tab2" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Brand Name</th>
                                <th>Brand Logo</th>
                                <th>Company Email</th>
                                <th>Total Cases</th>
                                <th>Approved Cases</th>
                                <th>Pending Cases</th>
                                <th>Not Approved</th>
                                <th>In-Hand Cases</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key => $brand)

                            <tr class="table-card-row">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $brand->brand_name }}</td>
                                <td><img src="{{ asset('storage/'.$brand->brand_logo) }}" class="" style="height: 20px; width: 30px;" alt="..."></td>
                                <td>{{ $brand->company->company_email ?? '' }}</td>
                                <td>{{ $brand->case->count() }}</td>
                                <td>{{ $brand->approved_count }}</td>
                                <td>{{ $brand->pending_count }}</td>
                                <td>{{ $brand->closed_count }}</td>
                                <td>{{ $brand->in_progress_count }}</td>

                                <td>
                                    @can('edit brand')
                                    <a href="{{ route('brand.edit', $brand->id) }}"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('delete brand')
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $brand->id }}"><i class="bi bi-trash  text-danger ms-2"></i></button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab 3 Product table -->
            <div class="tab-pane fade" id="tab3" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Sr #</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Brand Name</th>
                                <th>Company Name</th>
                                <th>Total Cases</th>
                                <th>Approved Cases</th>
                                <th>Pending Cases</th>
                                <th>Not Approved</th>
                                <th>In-Hand Cases</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)

                            <tr class="table-card-row">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>
                                    @foreach($product->images as $img)
                                    <img src="{{ asset('storage/'. $img->image_path) }}" class="" style="height: 20px; width: 30px;">
                                    @endforeach
                                </td>
                                <td>{{ $product->brand->brand_name }}</td>
                                <td>{{ $product->company->company_name }}</td>
                                <td>{{ $product->case->count() }}</td>
                                <td>{{ $product->approved_count }}</td>
                                <td>{{ $product->pending_count }}</td>
                                <td>{{ $product->closed_count }}</td>
                                <td>{{ $product->in_progress_count }}</td>

                                <td>
                                    @can('edit product')
                                    <a href="{{ route('product.edit', $product->id) }}"><i class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('delete product')
                                    <button data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}"><i class="bi bi-trash  text-danger ms-2"></i></button>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


</div>

@endsection
