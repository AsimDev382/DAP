<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
</div>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button>
            {{ __('Email Password Reset Link') }}
        </x-primary-button>
    </div>
</form>
</x-guest-layout>



{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('admin/css/style.css') }}">

</head>

<body>
    <div class="container  login-container d-flex">
        <div class="col-md-5 col-12 my-auto order-3 order-lg-1 text-center divider">
            <img src="{{ asset('admin/images/lock.jpg') }}" alt="Login-Image" class="p-lg-4" width="300px">
        </div>

        <div class="col-md-2 d-flex justify-content-center align-items-center divider order-2 order-lg-2">
            <div class="glow-divider"></div>

        </div>

        <div class="col-md-5 col-12 d-flex align-items-center justify-content-center order-1 order-lg-3">
            <div class="form-box pe-lg-5">
                <!-- Logo -->
                <div class="mb-4">
                    <img src="{{ asset('admin/images/dap_logo.jpg') }}" alt="Logo" width="200px" height="85px">
                </div>
                <!-- Heading -->
                <h1 class="forgot my-4">FORGET PASSWORD</h1>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <!-- Login Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">

                        <x-input-label for="email" class="form-label" :value="__('Email')" />
                        <x-text-input id="email" class="form-control form-control-lg custom-input" type="email" name="email" :value="old('email')" required placeholder="johnabraham@gmail.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                    </div>
                    <div class="d-grid  gap-2 d-md-flex justify-content-md-end">
                        <x-primary-button class="btn btn-primary px-5 py-2">
                            {{ __('Send') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html> --}}
