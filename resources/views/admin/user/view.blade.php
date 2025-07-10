@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">User</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">
                {{-- <div class="col-md-2">

                    <div>
                        @if($user->user_img)
                            <img src="{{ asset('storage/'.$user->user_img) }}" alt="UserImg">
                        @else
                            <img src="{{ asset('admin/images/avatar.png') }}" alt="Profile" width="80px">
                        @endif
                    </div>
                </div> --}}
                <div class="col-md-3 d-flex">
                    <div>
                        @if($user->user_img)
                            <img src="{{ asset('storage/'.$user->user_img) }}" alt="UserImg">
                        @else
                            <img src="{{ asset('admin/images/avatar.png') }}" alt="Profile" width="80px">
                        @endif
                    </div>
                    <div class="ms-3">
                        <h6 class="fourteen pt-4">User Name</h6>
                        <h1 class="twenty">{{ $user->name }}</h1>
                    </div>
                </div>
            <div class="col-md-3">
                            <div class="text-center">
                                <h6 class="twelve pt-4">User ID</h6>
                                <h1 class="twenty">{{ $user->auto_id }}</h1>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h6 class="twelve pt-4">Designation</h6>
                                <h1 class="twenty">{{ $user->designation }}</h1>
                            </div>
                        </div>
                <div class="col-md-3  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary px-4 py-2">Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">

                            <div class="col-md-12">
                                <div class="row d-flex justify-content-between">
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Email</h6>
                                            <h1 class="fourteen">{{ $user->email }}</h1>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Last Login</h6>
                                            <h1 class="fourteen">{{ $user->created_at }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Location</h6>
                                            <h1 class="fourteen ">{{ $user->user_location }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Company</h6>
                                            <h1 class="fourteen ">{{ $user->company->company_name }}</h1>
                                        </div>
                                    </div>

                                </div>
                                <div class="row ">
                                 <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Department</h6>
                                            <h1 class="fourteen ">{{ $user->department->name }}</h1>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <h6 class="twelve pt-4">Sub Department</h6>
                                            <h1 class="fourteen ">{{ $user->subDepartment->sub_name }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>


                <div class="col-md-12">
                    <p class="m-0 twenty">User Details</p>
                    <p class="m-0 fourteen">{{ $user->detail }}</p>
                </div>
            </div>
        </div>

    </div>


</div>

@endsection
