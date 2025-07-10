{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section> --}}

@extends('admin.layouts.adminlayout')
@section('main-content')
    <div class="container-fluid d-flex g-0">


        <div class="main-content">


            <div class="row px-4">
                <div class="col-12 mb-4 ">
                    <!-- Title -->
                    <div class="fw-bold fs-4 me-3">Edit Profile</div>
                </div>
                <div class="col-md-5 card profile-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="profile-img-wrapper">
                            {{-- {{ dd($user->user_image) }} --}}
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
                <div class="col-md-7">
                    {{-- <form class="px-4"> --}}
                        <form method="post" action="{{ route('profile.update') }}" class="px-4">
                            @csrf
                            @method('patch')

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="profile-img-wrapper">
                                {{-- <img src="{{ asset('admin/images/avatar.png') }}" alt="Profile" class="profile-img "> --}}
                                @if($user->user_image)
                                <img src="{{ asset('storage/'.$user->user_image) }}" alt="Profile" class="profile-img ">
                                @else
                                <img src="{{ asset('admin/images/avatar.png') }}" alt="Profile" class="profile-img ">
                                @endif
                            </div>
                        </div>
                        <div class="row g-3">
                          <div class="col-md-4">

                            <x-input-label for="name" class="form-label" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />
                          </div>
                          <div class="col-md-4">
                            <x-input-label for="last_name" class="form-label" :value="__('Last Name')" />
                            <x-text-input id="last_name" name="last_name" type="text" class="form-control" :value="old('last_name', $user->last_name)" required />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('last_name')" />
                          </div>
                          <div class="col-md-4">
                            <label class="form-label">Account Type</label>
                            <select name="account_type" class="form-select">
                              <option selected>Select</option>
                              <option value="1">Type A</option>
                              <option value="2">Type B</option>
                            </select>
                          </div>

                          <div class="col-md-4">
                            {{-- <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Auto Fill"> --}}

                            <x-input-label for="email" class="form-label" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')" />
                          </div>
                          <div class="col-md-4">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="{{ @$user->address }}" class="form-control" placeholder="Address">
                          </div>
                          <div class="col-md-4">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" value="{{ @$user->contact_number }}" class="form-control" placeholder="Contact Number">
                          </div>

                          <div class="col-md-4">
                            <label class="form-label">Country</label>
                            <select name="country" class="form-select">
                              <option selected>Select</option>
                              <option value="1">Pakistan</option>
                              <option value="2">USA</option>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label class="form-label">Province</label>
                            <select name="province" class="form-select">
                              <option selected>Select</option>
                              <option value="1">Punjab</option>
                              <option value="2">Sindh</option>
                            </select>
                          </div>
                          <div class="col-md-4">
                            <label class="form-label">City</label>
                            <input type="text" name="city" value="{{ @$user->city }}" class="form-control" placeholder="City">
                          </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-2">
                          <a href="{{ route('profile.edit') }}" type="button" class="btn btn-cancel">Cancel</a>
                          <button type="submit" class="btn btn-primary px-5 py-2">Submit</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hamburger = document.getElementById("hamburger");
            const sidebar = document.getElementById("sidebar");
            const closeBtn = document.getElementById("closeBtn");

            hamburger.addEventListener("click", function () {
                sidebar.classList.add("active");
            });

            closeBtn.addEventListener("click", function () {
                sidebar.classList.remove("active");
            });
        });
    </script>

@endsection
