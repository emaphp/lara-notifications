<nav class="col-md-2 d-none d-md-block bg-light sidebar" id="nav-admin">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('home') }}">
                    <span data-feather="home"></span>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.employees.index') }}">
                    <span data-feather="file"></span>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.events.index') }}">
                    <span data-feather="shopping-cart"></span>
                    Events
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Places
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.tags.index') }}">
                    <span data-feather="users"></span>
                    Tags
                </a>
            </li>
        </ul>
    </div>
</nav>