<div class="sidebar d-flex flex-column" id="sidebar">
    <div class="close-btn" id="closeBtn">&times;</div>
    <div class="logo mb-4">
        <img src="{{ asset('admin/images/transparent_logo.png') }}" alt="DAP Logo" width="130">
    </div>

    @php
        $permission = auth()->user()->getPermissionNames();

        // Active
        $companyActive = request()->is('company*') || request()->is('product*') || request()->is('brand*');
        $investActive = request()->is('investigation*') || request()->is('tasks*') || request()->is('evidence*') || request()->is('assign-tasks*');
        $userActive = request()->is('department*') || request()->is('sub-department*') || request()->is('user*') || request()->is('group*');
        $enforcementActive = request()->is('raid-plaining*') || request()->is('raid-doc*');
        $destructionActive = request()->is('pending-destruction*') || request()->is('completed-destruction*');
        $financeActive = request()->is('pending-finance*') || request()->is('completed-finance*');
        $reportActive = request()->is('case-report*') || request()->is('client-report*') || request()->is('finance-report*');
    @endphp

    <nav class="nav flex-column text-start">

        <!-- Dashboard -->
        <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>

        {{-- @if(auth()->user()->getPermissionNames() == 'company management') --}}
        @if($permission->contains('view company') || $permission->contains('view product') || $permission->contains('view brand'))
        <a class="nav-link d-flex justify-content-between align-items-center {{ $companyActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#company" role="button" aria-expanded="{{ $companyActive ? 'true' : 'false' }}" aria-controls="company">
            <span>Company Management</span>
        </a>
        <div class="collapse ps-3 {{ $companyActive ? 'show' : '' }}" id="company">
            @if($permission->contains('view company'))
                <a class="nav-link {{ request()->is('company*') ? 'active' : '' }}" href="{{ route('company.index') }}">Company</a>
            @endif

            @if($permission->contains('view brand'))
                <a class="nav-link {{ request()->is('brand*') ? 'active' : '' }}" href="{{ route('brand.index') }}">Brands</a>
            @endif

            @if($permission->contains('view product'))
                <a class="nav-link {{ request()->is('product*') ? 'active' : '' }}" href="{{ route('product.index') }}">Products</a>
            @endif

        </div>
        @endif


        @if($permission->contains('view case management'))
        @can('view case management')
        <a class="nav-link {{ request()->is('case*') ? 'active' : '' }}" href="{{ route('case.index') }}"> Case Management</a>
        @endcan
        @endif

        @if($permission->contains('view investigation') || $permission->contains('view tasks') || $permission->contains('view evidence') || $permission->contains('view assign task'))
        <a class="nav-link d-flex justify-content-between align-items-center  {{ $investActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#caseMenu" role="button" aria-expanded="{{ $investActive ? 'true' : 'false' }}" aria-controls="caseMenu">
            <span> Investigation Management</span>

        </a>
        <div class="collapse ps-3 {{ $investActive ? 'show' : '' }}" id="caseMenu">

            @if($permission->contains('view investigation'))
            <a class="nav-link {{ request()->is('investigation*') ? 'active' : '' }}" href="{{ route('investigation.index') }}">Investigation</a>
            @endif

            @if($permission->contains('view tasks'))
            <a class="nav-link {{ request()->is('tasks*') ? 'active' : '' }}" href="{{ route('tasks.index') }}">Tasks</a>
            @endif

            @if($permission->contains('view evidence'))
            <a class="nav-link {{ request()->is('evidence*') ? 'active' : '' }}" href="{{ route('evidence.index') }}">Evidence</a>
            @endif

            @if($permission->contains('view assign task'))
            <a class="nav-link {{ request()->is('assign-tasks*') ? 'active' : '' }}" href="{{ route('assign.tasks.index') }}">Assign Task</a>
            @endif
        </div>
        @endif


        @if($permission->contains('view department') || $permission->contains('view sub department') || $permission->contains('view user') || $permission->contains('view groups'))
        <!-- User Management -->
        <a class="nav-link d-flex justify-content-between align-items-center {{ $userActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#userMenu" role="button" aria-expanded="{{ $userActive ? 'true' : 'false' }}" aria-controls="userMenu">
            <span>User Management</span>

        </a>
        <div class="collapse ps-3 {{ $userActive ? 'show' : '' }}" id="userMenu">
            @if($permission->contains('view department'))
            <a class="nav-link {{ request()->is('department*') ? 'active' : '' }}" href="{{ route('department.index') }}">Departments</a>
            @endif

            @if($permission->contains('view sub department'))
            <a class="nav-link {{ request()->is('sub-department*') ? 'active' : '' }}" href="{{ route('sub-department.index') }}">Sub Departments</a>
            @endif

            @if($permission->contains('view user'))
            <a class="nav-link {{ request()->is('user*') ? 'active' : '' }}" href="{{ route('user.index') }}">User</a>
            @endif

            @if($permission->contains('view groups'))
            <a class="nav-link {{ request()->is('group*') ? 'active' : '' }}" href="{{ route('group.index') }}">Groups</a>
            @endif

        </div>
        @endif



        @if($permission->contains('view raid plaining & execution') || $permission->contains('view raid documentation'))
            <!-- Enforcement / Raid Actions -->
            <a class="nav-link d-flex justify-content-between align-items-center {{ $enforcementActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#Raid" role="button" aria-expanded="{{ $enforcementActive ? 'true' : 'false' }}" aria-controls="userMenu">
                <span>Enforcement / Raid Actions</span>

            </a>
            <div class="collapse ps-3 {{ $enforcementActive ? 'show' : '' }}" id="Raid">
                @if($permission->contains('view raid plaining & execution'))
                <a class="nav-link {{ request()->is('raid-plaining*') ? 'active' : '' }}" href="{{ route('raid.plaining.index') }}">Raid Plaining & Execution</a>
                @endif

                @if($permission->contains('view raid documentation'))
                <a class="nav-link {{ request()->is('raid-doc*') ? 'active' : '' }}" href="{{ route('raid.doc.index') }}">Raid Documentation</a>
                @endif

            </div>
        @endif


        @if($permission->contains('view pending destruction') || $permission->contains('view completed destruction'))
            <!-- Destruction Management -->
            <a class="nav-link d-flex justify-content-between align-items-center {{ $destructionActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#Destruction" role="button" aria-expanded="{{ $destructionActive ? 'true' : 'false' }}" aria-controls="userMenu">
                <span>Destruction Management</span>
            </a>
            <div class="collapse ps-3 {{ $destructionActive ? 'show' : '' }}" id="Destruction">
                @if($permission->contains('view pending destruction'))
                <a class="nav-link {{ request()->is('pending-destruction*') ? 'active' : '' }}" href="{{ route('pending.destruction.index') }}">Pending Destruction</a>
                @endif

                @if($permission->contains('view completed destruction'))
                <a class="nav-link {{ request()->is('completed-destruction*') ? 'active' : '' }}" href="{{ route('completed.destruction.index') }}">Completed Destruction</a>
                @endif

            </div>
        @endif


        @if($permission->contains('view currency') || $permission->contains('view recieved payments') || $permission->contains('view due tracking') || $permission->contains('view profit & expences') || $permission->contains('view disbursement') || $permission->contains('view invoices'))
        <!-- Finance -->
        <a class="nav-link d-flex justify-content-between align-items-center {{ $financeActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#Finance" role="button" aria-expanded="{{ $financeActive ? 'true' : 'false' }}" aria-controls="userMenu">
            <span>Finance</span>

        </a>
        <div class="collapse ps-3 {{ $financeActive ? 'show' : '' }}" id="Finance">
            @if($permission->contains('view currency'))
            <a class="nav-link {{ request()->is('currency*') ? 'active' : '' }}" href="{{ route('currency.index') }}">Currency</a>
            @endif

            @if($permission->contains('view recieved payments'))
            <a class="nav-link {{ request()->is('recieved-payments*') ? 'active' : '' }}" href="#">Recieved Payments</a>
            @endif

            @if($permission->contains('view due tracking'))
            <a class="nav-link {{ request()->is('due-tracking*') ? 'active' : '' }}" href="#">Due Tracking</a>
            @endif

            @if($permission->contains('view profit & expences'))
            <a class="nav-link {{ request()->is('expenses*') ? 'active' : '' }}" href="{{ route('expenses.index') }}">Profit & Expenses</a>
            @endif

            @if($permission->contains('view disbursement'))
            <a class="nav-link {{ request()->is('disbursement*') ? 'active' : '' }}" href="#">Disbursement</a>
            @endif

            @if($permission->contains('view invoices'))
            <a class="nav-link {{ request()->is('invoice*') ? 'active' : '' }}" href="{{ route('invoice.index') }}">Invoices</a>
            @endif

        </div>
        @endif

        @if($permission->contains('view case report') || $permission->contains('view client reports') || $permission->contains('view finance reports'))
        <!-- Reports -->
        <a class="nav-link d-flex justify-content-between align-items-center {{ $reportActive ? 'active' : '' }}" data-bs-toggle="collapse" href="#Report" role="button" aria-expanded="{{ $reportActive ? 'true' : 'false' }}" aria-controls="userMenu">
            <span>Reports</span>

        </a>
        <div class="collapse ps-3 {{ $reportActive ? 'show' : '' }}" id="Report">
            @if($permission->contains('view case report'))
            <a class="nav-link {{ request()->is('case-report*') ? 'active' : '' }}" href="{{ route('case-report.index') }}">Case Report</a>
            @endif

            @if($permission->contains('view client reports'))
            <a class="nav-link {{ request()->is('client-report*') ? 'active' : '' }}" href="{{ route('client-report.index') }}">Client Reports</a>
            @endif

            {{-- @if($permission->contains('due tracking'))
            <a class="nav-link" href="#">Due Tracking</a>
            @endif

            @if($permission->contains('profit & expences'))
            <a class="nav-link" href="#">Profit & Expences</a>
            @endif

            @if($permission->contains('disbursement'))
            <a class="nav-link" href="#">Disbursement</a>
            @endif --}}

            @if($permission->contains('view finance reports'))
            <a class="nav-link {{ request()->is('client-report*') ? 'active' : '' }}" href="{{ route('finance-report.index') }}">Finance Reports</a>
            @endif

        </div>
        @endif

        @if($permission->contains('follow-up'))

        <!-- Follow Up -->
        <a class="nav-link" href="#">Follow Up</a>
        @endif

        @if(auth()->user()->hasRole('superadmin'))
        <a class="nav-link" href="{{ route('permission.index') }}"> Permission</a>
        @endif
        {{-- @if(auth()->user()->hasRole('superadmin'))
        <a class="nav-link" href="{{ route('role.index') }}"> Role</a>
        @endif --}}


        @if($permission->contains('settings'))
            <a class="nav-link" href="#"> Settings</a>
        @endif
        <!-- Sign Out -->
        {{-- <a class="nav-link" href="login.html"><i class="fas fa-sign-out-alt me-2"></i> Sign Out</a> --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                this.closest('form').submit();" class="position-relative">
                <button type="submit" class="nav-link position-absolute bottom-40 text-nowrap"> Sign Out</button>
            </x-responsive-nav-link>
        </form>
    </nav>
</div>
