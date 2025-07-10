{{-- <x-app-layout> --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot> --}}

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"> --}}
            {{-- <div class="">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div> --}}

@extends('admin.layouts.adminlayout')
@section('main-content')


    <div class="main-content">


        <div class="row px-4">

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 alert alert-success w-100"
                >{{ __('Profile Updated Successfully.') }}</p>
            @endif


            <div class="col-12 mb-4 ">
                <!-- Title -->
                <div class="fw-bold fs-4 me-3">Profile</div>
            </div>
            <div class="col-md-12 card profile-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="profile-img-wrapper">
                        {{-- <img src="{{ asset('admin/images/avatar.png') }}" alt="Profile" class="profile-img "> --}}
                        @if($user->user_image)
                        <img src="{{ asset('storage/'.$user->user_image) }}" alt="Profile" class="profile-img ">
                        @else
                        <img src="{{ asset('admin/images/avatar.png') }}" alt="Profile" class="profile-img ">
                        @endif
                    </div>
                    <a href="{{ route('edit.profile') }}" class="btn btn-primary px-4 py-2">
                        ✏️ Edit
                    </a>
                </div>

                <div class="row gy-2">
                    <div class="col-md-6 mb-2">
                        <div class="label_title">First Name</div>
                        <div class="value">{{ $user->name }}</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="label_title">Last Name</div>
                        <div class="value">{{ $user->last_name }}</div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="label_title">Email</div>
                        <div class="value">{{ $user->email }}</div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="label_title">Country Code</div>
                        <div class="value"><img src="https://flagcdn.com/16x12/pk.png" class="me-1"> PK +92</div>
                    </div>
                    <div class="col-md-8 mb-2">
                        <div class="label_title">Mobile No</div>
                        <div class="value">{{ $user->contact_number }}</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="label_title">Address</div>
                        <div class="value">{{ $user->address }}</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="label_title">Account Type</div>
                        <div class="value">{{ $user->account_type }}</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="label_title">Province</div>
                        <div class="value">{{ $user->province }}</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="label_title">City</div>
                        <div class="value">{{ $user->city }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div> --}}

            {{-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        {{-- </div>
    </div> --}}
{{-- </x-app-layout> --}}
