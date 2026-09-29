<style>
    /* Custom CSS for the Sidebar */
    .sidebar {
        min-height: 100vh;
        width: 260px;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1000;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
    }
    .sidebar .nav-link {
        color: #d1d5db;
        border-radius: 8px;
        margin-bottom: 5px;
        padding: 10px 15px;
    }
    .sidebar .nav-link:hover {
        background-color: #343a40;
        color: #fff;
    }
    .main-content {
        margin-left: 260px;
        padding: 20px;
        width: calc(100% - 260px);
    }
    @media (max-width: 992px) {
        .sidebar { margin-left: -260px; }
        .main-content { margin-left: 0; width: 100%; }
        .sidebar.active { margin-left: 0; }
    }
</style>

<!-- Sidebar -->
<nav class="sidebar bg-dark navbar-dark p-3 shadow">
    <a class="navbar-brand fw-bold text-danger mb-4 d-block text-center" href="{{ url('/home') }}">
        <i class="fas fa-life-ring me-1"></i> Disaster Relief
    </a>
    
    <ul class="nav flex-column flex-grow-1">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-tachometer-alt fa-fw me-2"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('disasters.index') }}"><i class="fas fa-map-marked-alt fa-fw me-2"></i> Disasters</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('missing.index') }}"><i class="fas fa-walking fa-fw me-2"></i> Missing Persons</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('relief.index') }}"><i class="fas fa-box-open fa-fw me-2"></i> Relief Materials</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('donations.index') }}"><i class="fas fa-hand-holding-usd fa-fw me-2"></i> Donations</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('alerts.index') }}"><i class="fas fa-bell fa-fw me-2"></i> Alerts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('weather.index') }}"><i class="fas fa-newspaper fa-fw me-2"></i> News & Weather</a>
        </li>
        <li class="nav-item">
    <a class="nav-link" href="{{ route('shelters.index') }}"><i class="fas fa-home fa-fw me-2"></i> Holding Centers</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('aid_requests.index') }}"><i class="fas fa-hands-helping fa-fw me-2"></i> Aid Requests</a>
</li>
    </ul>

    <!-- Bottom Section (User & Logout) -->
    <div class="mt-auto">
        @guest
            @if (Route::has('login'))
                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt fa-fw me-2"></i> Login</a>
            @endif
        @else
            <div class="text-light mb-2 small">
                <i class="fas fa-user-circle fa-fw me-2"></i> Hello admin
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        @endguest
    </div>
</nav>