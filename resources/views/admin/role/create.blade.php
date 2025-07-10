@extends('admin.layouts.adminlayout')
@section('main-content')

<div class="main-content">

    <form action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row px-4">
            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Add Role </div>
            </div>

            <div class="col-md-12">
                <div class="my-3">
                    <label class="eighteenblack mb-3">Role Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Role Name">

                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <div class="col-md-12 mb-3 ">
             <div class="row d-flex justify-content-between">
                <div class="col-md-4">
                    {{-- <button class="btn btn-cancel">
                        <img src="{{ asset('admin/images/add.svg') }}" alt=" Icon" class="img-fluid me-3">Add Sub Departments
                    </button> --}}
                </div>
                <div class="col-md-4 text-end">
                    <button type="button" class="btn btn-cancel me-2">Cancel</button>
                    <button type="submit" class="btn btn-primary px-5 py-2">Submit</button>
                </div>
             </div>
            </div>
        </div>
    </form>
</div>

@endsection
