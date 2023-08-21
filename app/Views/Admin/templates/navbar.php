<nav class="navbar navbar-expand-lg py-4">
    <div class="container gap-5 px-4">
        <a href="#" class="navbar-brand">Dashboard</a>
        <div class="hamburger-wrapper">
            <div class="hamburger"></div>
        </div>
        <ul class="list-unstyled d-flex align-items-center gap-5 mb-0">
            <li class="nav-item">
                <div class="notif">
                    <i class='bx bx-bell' ></i>
                    <span class="notif-count">10</span>
                </div>
            </li>
            <li class="nav-item">
                <div class="notif">
                    <i class='bx bx-envelope'></i>
                    <span class="notif-count">10</span>
                </div>
            </li>
            <li class="nav-item">
                <div class="dropdown">
                    <div class="navbar-profile" data-bs-toggle="dropdown">
                        <div class="d-flex align-items-center gap-2">
                            <div>
                                <img src="/assets/admin/uploads/avatar/<?= session()->get('session_token')["image_url"] ?>">
                            </div>
                            <div class="profile-info d-none d-md-block">
                                <div><?= ucwords(session()->get('session_token')["fname"] . ' ' . session()->get('session_token')["lname"]) ?></div>
                                <div>#<?= session()->get('session_token')["id"] ?></div>
                            </div>
                            <span class="dropdown-toggle"></span>
                        </div>
                    </div>
                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuButton1" data-bs-popper="none">
                        <li><a class="dropdown-item" href="/admin/me">Profile</a></li>
                        <li><a class="dropdown-item" href="/admin/signout">Sign Out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>