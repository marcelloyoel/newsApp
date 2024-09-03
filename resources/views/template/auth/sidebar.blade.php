<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-left">
    <div class="sidebar-brand-icon">
        {{-- <i class="fas fa-house-user"></i> --}}
        <img src="{{ asset('images/LogoWeb.jpg') }}">
    </div>
    <div class="sidebar-brand-text">News App Dashboard</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider">
@if (Auth::user()->role == 1)
    <!-- Heading User -->
    <div class="sidebar-heading">
        Author
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userhome" aria-expanded="true"
            aria-controls="userhome">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <div id="userhome" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Home:</h6>
                <a class="collapse-item" href="/">Home</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-store"></i>
            <span>Author Dashboard</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Author Dashboard:</h6>
                <a class="collapse-item" href="/posts">Post List</a>
                <a class="collapse-item" href="/posts/create">Add New Post</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
@endif
@if (Auth::user()->role == 2)
    <!-- Heading Laundry Sepatu -->
    <div class="sidebar-heading">
        Admin
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="/home" data-toggle="collapse" data-target="#laundryhome"
            aria-expanded="true" aria-controls="laundryhome">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <div id="laundryhome" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Home:</h6>
                <a class="collapse-item" href="/">Home</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transactionCollapsePages"
            aria-expanded="true" aria-controls="transactionCollapsePages">
            <i class="fas fa-list-ul"></i>
            <span>Admin Dashboard</span>
        </a>
        <div id="transactionCollapsePages" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Dashboard:</h6>
                <a class="collapse-item" href="/users">User List</a>
                <a class="collapse-item" href="/users/create">Add New User</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    {{-- <hr class="sidebar-divider"> --}}
@endif
<!-- Nav Item - Admin -->

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
