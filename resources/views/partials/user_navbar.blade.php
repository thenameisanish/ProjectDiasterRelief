<style>
    /* Custom CSS for the User Sidebar */
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
    body.has-sidebar .main-content {
        margin-left: 260px;
        width: calc(100% - 260px);
    }
    @media (max-width: 992px) {
        .sidebar { margin-left: -260px; }
        .main-content { margin-left: 0; width: 100%; }
        .sidebar.active { margin-left: 0; }
    }
</style>

<!-- User Sidebar -->
<nav class="sidebar bg-dark navbar-dark p-3 shadow">
    <a class="navbar-brand fw-bold text-danger mb-4 d-block text-center" href="{{ url('/') }}">
        <i class="fas fa-life-ring me-1"></i> Disaster Relief
    </a>
    
    <ul class="nav flex-column flex-grow-1">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-tachometer-alt fa-fw me-2"></i> Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('disasters.create') }}"><i class="fas fa-map-marked-alt fa-fw me-2"></i> Report Disaster</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('missing.create') }}"><i class="fas fa-walking fa-fw me-2"></i> Report Missing</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('aid_requests.create') }}"><i class="fas fa-hands-helping fa-fw me-2"></i> Request Aid</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('donations.create') }}"><i class="fas fa-hand-holding-usd fa-fw me-2"></i> Donate</a>
        </li>
        <li class="nav-item">
    <a class="nav-link" href="{{ route('missing.index') }}"><i class="fas fa-users fa-fw me-2"></i> View Missing</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('user.shelters') }}"><i class="fas fa-home fa-fw me-2"></i> Holding Centers</a>
</li>
  <li class="nav-item">
            <a class="nav-link" href="{{ route('user.news') }}"><i class="fas fa-newspaper fa-fw me-2"></i> News & Weather</a>
        </li>
        <li class="nav-item">
    <a class="nav-link" href="{{ route('user.disasters') }}"><i class="fas fa-map-marked-alt fa-fw me-2"></i> View Disaster Map</a>
</li>
    </ul>

    <!-- Bottom Section (Admin Login) -->
    <div class="mt-auto">
        <a href="{{ route('login') }}" class="btn btn-danger w-100">
            <i class="fas fa-user-shield me-1"></i> Admin Login
        </a>
    </div>
</nav>