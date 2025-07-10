@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <div class="row px-5">
        <div class="col-md-12">
            <div class="fw-bold fs-4 me-3">Group Profile</div>
        </div>
        <div class="col-md-12 card p-4 mt-3">
            <div class="row d-flex justify-content-between">

                <div class="col-md-8 d-flex">

                    <div class="ms-3">
                        <h6 class="fourteen pt-4">Group Name</h6>
                        <h1 class="twenty">{{ $group->group_name }}</h1>
                    </div>
                </div>

                <div class="col-md-3  d-flex justify-content-end align-items-center">
                    <div> <a href="{{ route('group.edit', $group->id) }}" class="btn btn-primary px-4 py-2">Edit</a></div>
                </div>
            </div>
            <hr>
            <div class="row mt-3">

                <div class="col-md-12">
                    <div class="row d-flex justify-content-between">
                        <div class="col-md-3">
                            <div>
                                <h6 class="twelve pt-4">Group Member</h6>
                                <h1 class="fourteen">{{ $group->user->name }}</h1>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
