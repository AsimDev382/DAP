{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

</head>

<body>
<div class="container  login-container d-flex">
    <div class="col-md-5 col-12 my-auto order-3 order-lg-1 divider">
        <img src="{{ asset('admin/images/DapLoginImage-01.svg') }}" alt="Login-Image" class="img-fluid p-lg-4">
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
            <h6>Well Come to</h6>
            <h5 style="color: var(--secondary-color);">DAP Case Management Suit.</h5>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />


            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <!-- Email Address -->
                    <x-input-label for="email" :value="__('Email')"  class="form-label"/>
                    <x-text-input id="email" class="form-control form-control-lg custom-input" type="email" name="email" :value="old('email')" required  placeholder="Enter email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <div class="mb-3 position-relative">

                    <x-input-label for="password" :value="__('Password')" class="form-label" />
                    <div class="input-group">
                        <x-text-input id="password" class="form-control form-control-lg custom-input" type="password"
                            name="password"
                            required placeholder="Enter password" />
                        <span class="input-group-text password-toggle" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>


                <!-- Remember Me -->
                {{-- <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div> --}}



                <div class="mb-3">
                    @if (Route::has('password.request'))
                        <a class="text-decoration-underline" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif

                    <x-primary-button class="d-grid  gap-2 d-md-flex justify-content-md-end btn btn-primary px-5 py-2">
                        {{ __('Sign In') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        toggleIcon.classList.toggle('bi-eye');
        toggleIcon.classList.toggle('bi-eye-slash');
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"></script>
</body>
</html>

