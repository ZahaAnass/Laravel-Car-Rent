<header class="navbar admin-navbar">
    <div class="container navbar-content">
        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="logo-wrapper">
            <img src="{{ asset('/img/logoipsum-265.svg') }}" alt="Admin Logo" />
        </a>

        <!-- Mobile Toggle -->
        <button class="btn btn-default btn-navbar-toggle">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                style="width: 24px"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                />
            </svg>
        </button>

        <div class="navbar-auth">
            <!-- Admin Menu Dropdown -->
            <div class="navbar-menu" tabindex="-1">
                <a href="javascript:void(0)" class="navbar-menu-handler">
                    Admin Menu
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        style="width: 20px"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m19.5 8.25-7.5 7.5-7.5-7.5"
                        />
                    </svg>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}">Users</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.cars.index') }}">Cars</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile') }}">Profile</a>
                    </li>
                </ul>
            </div>

            <!-- Logout Button -->
            <a href="{{ route('admin.logout') }}" class="btn btn-primary flex items-center">
                <svg
                    style="width: 18px; fill: currentColor; margin-right: 4px"
                    viewBox="0 0 1024 1024"
                    version="1.1"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M426.666667 736V597.333333H128v-170.666666h298.666667V288L650.666667 512 426.666667 736M341.333333 85.333333h384a85.333333 85.333333 0 0 1 85.333334 85.333334v682.666666a85.333333 85.333333 0 0 1-85.333334 85.333334H341.333333a85.333333 85.333333 0 0 1-85.333333-85.333334v-170.666666h85.333333v170.666666h384V170.666667H341.333333v170.666666H256V170.666667a85.333333 85.333333 0 0 1 85.333333-85.333334z"
                        fill=""
                    />
                </svg>
                Logout
            </a>
        </div>
    </div>
</header>
