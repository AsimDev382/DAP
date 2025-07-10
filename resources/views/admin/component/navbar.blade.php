<div class="d-flex justify-content-between align-items-center mb-4 content py-2">
    <span class="mob-hide"></span>
    <div class="hamburger" id="hamburger">
        &#9776; <!-- Hamburger Icon -->
    </div>
    <nav class="main-header navbar navbar-expand navbar-light">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-white" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fas fa-bell text-white"></i>
                    <img src="{{ Auth::user()->image ?? asset('admin/images/avatar.png') }}" class="rounded me-2" alt="User" width="40" height="40">
                    <span class="d-none d-lg-inline text-white">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a href="{{ route('profile.edit') }}" class="dropdown-item has-icon">
                            <i class="far fa-user"></i> Profile
                        </a>
                    </li>
                    {{-- <li><hr class="dropdown-divider"></li> --}}
                    {{-- <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> {{ __('Log Out') }}
                            </button>
                        </form>
                    </li> --}}
                </ul>
            </li>
        </ul>
    </nav>

</div>
