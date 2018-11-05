<nav class="col-md-2 d-none d-md-block bg-light sidebar" id="nav-employee">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('home') }}">
                    <span data-feather="home"></span>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile.index') }}">
                    <span data-feather="file"></span>
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('notifications.index') }}">
                    <span data-feather="shopping-cart"></span>
                    Notifications
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('events.index') }}">
                    <span data-feather="users"></span>
                    Events
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('breakfast') }}">
                    <span data-feather="users"></span>
                    Breakfast
                </a>
            </li>
        </ul>
    </div>
</nav>