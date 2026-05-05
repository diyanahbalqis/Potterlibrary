{{-- resources/views/partials/topbar.blade.php --}}

<header class="topbar">

    {{-- Mobile hamburger --}}
    <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    {{-- Page title (pages can override via @section or pass $pageTitle) --}}
    <div class="topbar-title">
        @yield('page_title', 'Dashboard')
        <span>/ @yield('page_breadcrumb', 'Overview')</span>
    </div>

    {{-- Search --}}
    <div class="search-bar">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" id="searchInput" placeholder="Search tickets, articles…" autocomplete="off">
    </div>

    {{-- Action buttons --}}
    <div class="topbar-actions">

        {{-- Notifications --}}
        <div class="icon-btn" title="Notifications" id="notifBtn">
            <i class="fa-solid fa-bell"></i>
            @if(isset($unreadNotifications) && $unreadNotifications > 0)
                <span class="notif-dot"></span>
            @endif
        </div>

        {{-- Help --}}
        <a href="{{ route('user.knowledge-base') }}" class="icon-btn" title="Help">
            <i class="fa-solid fa-circle-question"></i>
        </a>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
            @csrf
            <button type="submit" class="icon-btn" title="Sign out">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>

    </div>

</header>
