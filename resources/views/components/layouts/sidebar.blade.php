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

        <a href="/campaign-setup"
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

    <div class="p-4 border-t border-gray-800 bg-[#0f1523]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-3 py-2 rounded-lg text-gray-400 transition-all duration-200 hover:bg-red-500/10 hover:text-red-500 group">
                <i class="fa-solid fa-right-from-bracket w-5 text-center text-sm transition-colors"></i>
                <span class="ml-3 text-sm font-medium">Sign Out</span>
            </button>
        </form>
    </div>
</aside>

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
</script>
