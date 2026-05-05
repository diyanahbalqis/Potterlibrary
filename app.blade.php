{{-- resources/views/layouts/app.blade.php --}}
{{-- Drop-in replacement for AdminLTE master layout --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'eTicketSupport')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Custom skin (extracted from userdashboard) --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    {{-- Per-page styles --}}
    @stack('styles')
</head>
<body>

    {{-- ── Sidebar ── --}}
    @include('partials.sidebar')

    {{-- ── Topbar ── --}}
    @include('partials.topbar')

    {{-- ── Flash toasts ── --}}
    @if(session('success'))
    <div class="toast-container">
        <div class="toast success">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="toast-container">
        <div class="toast error">
            <i class="fa-solid fa-circle-xmark"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    {{-- ── Main content area ── --}}
    <main class="main">
        @yield('content')
    </main>

    {{-- ── Toast container for JS-triggered toasts ── --}}
    <div class="toast-container" id="toastContainer"></div>

    {{-- ── Shared JS (sidebar toggle, toast helper) ── --}}
    <script>
        // Mobile sidebar toggle
        const sidebar       = document.getElementById('sidebar');
        const overlay       = document.getElementById('sidebarOverlay');
        const mobileToggle  = document.getElementById('mobileToggle');

        if (mobileToggle) {
            mobileToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('open');
            });
        }
        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
            });
        }

        // Auto-dismiss session flash toasts after 4 s
        document.querySelectorAll('.toast-container .toast').forEach(t => {
            setTimeout(() => t.remove(), 4000);
        });

        // Global toast helper — call from any page script
        function showToast(msg, type = 'success') {
            const container = document.getElementById('toastContainer');
            if (!container) return;
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            const icon = type === 'success' ? 'circle-check' : 'circle-xmark';
            toast.innerHTML = `<i class="fa-solid fa-${icon}"></i><span>${msg}</span>`;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 4000);
        }
    </script>

    {{-- Per-page scripts --}}
    @stack('scripts')

</body>
</html>
