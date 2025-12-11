<aside id="sidebar"
    class="w-64 bg-[#111827] border-r border-gray-800 text-gray-400 flex flex-col transition-all duration-300 ease-in-out fixed top-0 left-0 h-screen z-50 font-sans">

    <div id="sidebar-header" class="h-16 flex items-center px-6 border-b border-gray-800 bg-[#0f1523]">
        <a href="/" class="flex items-center gap-3 group">
            <img src="/images/images.png" alt="Logo"
                class="w-8 h-8 rounded-md object-contain transition-transform duration-200 group-hover:scale-105">

            <div class="flex flex-col">
                <span class="text-lg font-bold text-gray-100 tracking-tight leading-none">
                    Pacific Playa
                </span>
                <span class="text-[12px] uppercase tracking-wider text-gray-500 font-semibold mt-1">
                    Realty CRM
                </span>
            </div>
        </a>
    </div>

    <nav class="flex-1 py-6 px-3 space-y-1 overflow-y-auto custom-scrollbar">

        <div class="px-3 mb-2 mt-2">
            <span class="text-[10px] uppercase tracking-wider text-gray-600 font-bold">Overview</span>
        </div>

        <a href="/dashboard"
            class="nav-link flex items-center px-3 py-2 rounded-lg transition-all duration-200 hover:bg-gray-800 hover:text-gray-100 group">
            <i class="fa-solid fa-tachometer-alt w-5 text-center text-sm"></i>
            <span class="ml-3 text-sm font-medium">Dashboard</span>
        </a>

        <div class="px-3 mb-2 mt-6">
            <span class="text-[10px] uppercase tracking-wider text-gray-600 font-bold">Management</span>
        </div>

        <a href="/clients"
            class="nav-link flex items-center px-3 py-2 rounded-lg transition-all duration-200 hover:bg-gray-800 hover:text-gray-100 group">
            <i class="fa-solid fa-users w-5 text-center text-sm"></i>
            <span class="ml-3 text-sm font-medium">Clients</span>
        </a>

        <a href="/campaigns"
            class="nav-link flex items-center px-3 py-2 rounded-lg transition-all duration-200 hover:bg-gray-800 hover:text-gray-100 group">
            <i class="fa-solid fa-bullhorn w-5 text-center text-sm"></i>
            <span class="ml-3 text-sm font-medium">Campaign Setup</span>
        </a>

        <div class="px-3 mb-2 mt-6">
            <span class="text-[10px] uppercase tracking-wider text-gray-600 font-bold">Tools</span>
        </div>

        <a href="/templates"
            class="nav-link flex items-center px-3 py-2 rounded-lg transition-all duration-200 hover:bg-gray-800 hover:text-gray-100 group">
            <i class="fa-solid fa-envelope-open-text w-5 text-center text-sm"></i>
            <span class="ml-3 text-sm font-medium">Mail Templates</span>
        </a>

        <a href="/file-management"
            class="nav-link flex items-center px-3 py-2 rounded-lg transition-all duration-200 hover:bg-gray-800 hover:text-gray-100 group">
            <i class="fa-solid fa-folder-open w-5 text-center text-sm"></i>
            <span class="ml-3 text-sm font-medium">File Management</span>
        </a>

        <div class="px-3 mb-2 mt-6">
            <span class="text-[10px] uppercase tracking-wider text-gray-600 font-bold">System</span>
        </div>

        <a href="/profile"
            class="nav-link flex items-center px-3 py-2 rounded-lg transition-all duration-200 hover:bg-gray-800 hover:text-gray-100 group">
            <i class="fa-solid fa-user w-5 text-center text-sm"></i>
            <span class="ml-3 text-sm font-medium">Profile</span>
        </a>

        <a href="/settings"
            class="nav-link flex items-center px-3 py-2 rounded-lg transition-all duration-200 hover:bg-gray-800 hover:text-gray-100 group">
            <i class="fa-solid fa-cog w-5 text-center text-sm"></i>
            <span class="ml-3 text-sm font-medium">Settings</span>
        </a>
    </nav>

    {{-- <div class="p-4 border-t border-gray-800 bg-[#0f1523]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-3 py-2 rounded-lg text-gray-400 transition-all duration-200 hover:bg-red-500/10 hover:text-red-500 group">
                <i class="fa-solid fa-right-from-bracket w-5 text-center text-sm transition-colors"></i>
                <span class="ml-3 text-sm font-medium">Sign Out</span>
            </button>
        </form>
    </div> --}}

    @if (isset($currentUser) && $currentUser)
        @php
            $firstName = $currentUser->detail->first_name ?? '';
            $lastName = $currentUser->detail->last_name ?? '';
            $profilePicturePath = $currentUser->detail->profile_picture_path ?? null;

            $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
            if (empty($initials) && $firstName) {
                $initials = strtoupper(substr($firstName, 0, 1));
            } elseif (empty($initials)) {
                $initials = 'AG';
            }
        @endphp

        <a href="{{ route('profile.edit') }}" id="userProfileLink"
            class="p-4 border-t border-gray-800 bg-[#0f1523] block group transition-colors duration-200 hover:bg-gray-900">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12 h-12 relative">
                    @if ($profilePicturePath)
                        <img src="{{ asset('storage/' . $profilePicturePath) }}" alt="User Profile"
                            class="w-12 h-12 rounded-full object-cover border-2 border-transparent shadow-sm group-hover:border-[#B02A30] transition-all duration-300">
                    @else
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-700 to-gray-600 flex items-center justify-center text-gray-100 font-semibold text-base shadow-sm border-2 border-transparent group-hover:border-[#B02A30] transition-all duration-300">
                            {{ $initials }}
                        </div>
                    @endif
                </div>

                <div class="ml-4 text-sm font-medium text-gray-100 truncate leading-tight">
                    <div>Hello, {{ $firstName }}</div>
                    <span class="text-xs font-normal text-gray-400 block">View Profile</span>
                </div>
            </div>
        </a>
    @endif
</aside>


@if (isset($currentUser) && $currentUser)
    <div id="userContextMenu"
        class="hidden fixed z-[999] w-40 bg-[#0f1523] rounded-lg shadow-xl border border-gray-800 py-1">
        <a href="{{ route('profile.edit') }}"
            class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 transition-colors">
            <i class="fa-solid fa-user-circle mr-3 w-4 text-gray-500"></i> View Profile
        </a>

        <div class="border-t border-gray-800 my-1"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 transition-colors">
                <i class="fa-solid fa-right-from-bracket mr-3 w-4 text-red-500"></i> Sign Out
            </button>
        </form>
    </div>
@endif

<script>
    const navLinks = document.querySelectorAll('.nav-link');
    const currentPath = window.location.pathname;

    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');

        if (currentPath === linkPath || (linkPath !== '/' && currentPath.startsWith(linkPath))) {
            link.classList.remove('hover:bg-gray-800', 'text-gray-400');
            link.classList.add('bg-[#B02A30]', 'text-white', 'shadow-sm', 'font-semibold');
        }
    });

    const profileLink = document.getElementById('userProfileLink');
    const userContextMenuElement = document.getElementById('userContextMenu');

    const SIDEBAR_WIDTH = 256;
    const MARGIN = 20;

    function hideContextMenu() {
        if (userContextMenuElement && !userContextMenuElement.classList.contains('hidden')) {
            userContextMenuElement.classList.add('hidden');
            userContextMenuElement.style.cssText = '';
        }
    }

    if (profileLink && userContextMenuElement) {

        userContextMenuElement.removeAttribute('onclick');

        profileLink.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            e.stopPropagation();
            hideContextMenu();

            const menuWidth = userContextMenuElement.offsetWidth;
            const menuHeight = userContextMenuElement.offsetHeight;

            const linkRect = profileLink.getBoundingClientRect();

            let x = e.pageX;
            let y = e.pageY;

            x = linkRect.left + linkRect.width + 5;

            if (x + menuWidth > window.innerWidth - MARGIN) {
                x = window.innerWidth - menuWidth - MARGIN;
            }

            if (linkRect.bottom + menuHeight > window.innerHeight - MARGIN) {

                y = linkRect.top - menuHeight - MARGIN;

                if (y < MARGIN) y = MARGIN;
            } else {
                y = linkRect.bottom + MARGIN;
            }

            if (y < MARGIN) y = MARGIN;

            userContextMenuElement.style.left = x + 'px';
            userContextMenuElement.style.top = y + 'px';
            userContextMenuElement.classList.remove('hidden');
        });

        document.addEventListener('click', function(e) {
            if (!userContextMenuElement.classList.contains('hidden') && !userContextMenuElement.contains(e
                    .target) && !profileLink
                .contains(e.target)) {
                hideContextMenu();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === "Escape") hideContextMenu();
        });

        window.addEventListener('scroll', hideContextMenu);
    }
</script>
