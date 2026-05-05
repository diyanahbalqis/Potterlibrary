{{-- resources/views/partials/sidebar.blade.php --}}

@php
    $currentRoute = request()->route()->getName() ?? '';
@endphp

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">

    {{-- Logo --}}
    <div class="sidebar-logo">
        <div class="logo-mark">
            <div class="logo-icon"><i class="fa-solid fa-ticket"></i></div>
            <div class="logo-text">
                <span class="brand">eTicketSupport</span>
                <span class="sub">Help Center</span>
            </div>
        </div>
    </div>

    {{-- User card --}}
    <div class="sidebar-user">
        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
        <div>
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-plan">{{ auth()->user()->plan ?? 'Standard Plan' }}</div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        <div class="nav-label">Main</div>

        <a href="{{ route('user.dashboard') }}"
           class="nav-item {{ Str::startsWith($currentRoute, 'user.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i> Dashboard
        </a>

        <a href="{{ route('user.tickets') }}"
           class="nav-item {{ Str::startsWith($currentRoute, 'user.tickets') && !Str::contains($currentRoute, 'create') ? 'active' : '' }}">
            <i class="fa-solid fa-ticket"></i> My Tickets
            @if(isset($openCount) && $openCount > 0)
                <span class="nav-badge">{{ $openCount }}</span>
            @endif
        </a>

        <a href="{{ route('user.tickets.create') }}"
           class="nav-item {{ $currentRoute === 'user.tickets.create' ? 'active' : '' }}">
            <i class="fa-solid fa-plus-circle"></i> New Ticket
        </a>

        <div class="nav-label">Resources</div>

        <a href="{{ route('user.knowledge-base') }}"
           class="nav-item {{ Str::startsWith($currentRoute, 'user.knowledge-base') ? 'active' : '' }}">
            <i class="fa-solid fa-book-open"></i> Knowledge Base
        </a>

        <a href="{{ route('user.announcements') }}"
           class="nav-item {{ Str::startsWith($currentRoute, 'user.announcements') ? 'active' : '' }}">
            <i class="fa-solid fa-bullhorn"></i> Announcements
            @if(isset($unreadAnnouncements) && $unreadAnnouncements > 0)
                <span class="nav-badge warn">{{ $unreadAnnouncements }}</span>
            @endif
        </a>

        <div class="nav-label">Account</div>

        <a href="{{ route('user.profile') }}"
           class="nav-item {{ Str::startsWith($currentRoute, 'user.profile') ? 'active' : '' }}">
            <i class="fa-solid fa-user"></i> Profile
        </a>

        <a href="{{ route('user.settings') }}"
           class="nav-item {{ Str::startsWith($currentRoute, 'user.settings') ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i> Settings
        </a>

    </nav>

    {{-- Footer CTA --}}
    <div class="sidebar-footer">
        <a href="{{ route('user.tickets.create') }}" class="btn-new-ticket">
            <i class="fa-solid fa-plus"></i> Submit New Ticket
        </a>
    </div>

</aside>
