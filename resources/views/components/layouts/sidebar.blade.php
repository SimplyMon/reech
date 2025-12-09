<aside id="sidebar"
    class="w-64 bg-gray-900 text-gray-300 flex flex-col transition-all duration-300 ease-in-out fixed top-0 left-0 h-screen z-50 font-sans shadow-lg">

    <div id="sidebar-header" class="mb-6 h-20 flex items-center px-6 border-b border-gray-800">
        <a href="/" class="flex items-center gap-3 group">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white/10">
                <img src="/images/logo.jpeg" alt="Logo"
                    class="w-10 h-10 object-contain transition-transform duration-200 group-hover:scale-110">
            </div>
            <span class="text-xl font-semibold text-white tracking-tight whitespace-nowrap">
                Pacific Playa Realty

            </span>
        </a>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 py-6 px-3 space-y-2 overflow-y-auto custom-scrollbar">
        <a href="/dashboard"
            class="nav-link flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white group">
            <i class="fa-solid fa-tachometer-alt w-5 text-center text-gray-400 group-hover:text-white"></i>
            <span class="ml-4 text-sm font-medium">Dashboard</span>
        </a>

        <a href="/clients"
            class="nav-link flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white group">
            <i class="fa-solid fa-users w-5 text-center text-gray-400 group-hover:text-white"></i>
            <span class="ml-4 text-sm font-medium">Clients</span>
        </a>

        <a href="/mail-templates"
            class="nav-link flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white group">
            <i class="fa-solid fa-envelope-open-text w-5 text-center text-gray-400 group-hover:text-white"></i>
            <span class="ml-4 text-sm font-medium">Mail Templates</span>
        </a>

        <a href="/file-management"
            class="nav-link flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white group">
            <i class="fa-solid fa-folder-open w-5 text-center text-gray-400 group-hover:text-white"></i>
            <span class="ml-4 text-sm font-medium">File Management</span>
        </a>

        <a href="/campaign-setup"
            class="nav-link flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white group">
            <i class="fa-solid fa-bullhorn w-5 text-center text-gray-400 group-hover:text-white"></i>
            <span class="ml-4 text-sm font-medium">Campaign Setup</span>
        </a>


        <a href="/profile"
            class="nav-link flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white group">
            <i class="fa-solid fa-user w-5 text-center text-gray-400 group-hover:text-white"></i>
            <span class="ml-4 text-sm font-medium">Profile</span>
        </a>

        <a href="/settings"
            class="nav-link flex items-center px-4 py-3 rounded-xl transition-all duration-200 hover:bg-gray-800 hover:text-white group">
            <i class="fa-solid fa-cog w-5 text-center text-gray-400 group-hover:text-white"></i>
            <span class="ml-4 text-sm font-medium">Settings</span>
        </a>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-gray-800">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-4 py-3 rounded-xl text-red-400 transition-all duration-200 hover:bg-red-600/10 hover:text-red-500 group">
                <i class="fa-solid fa-right-from-bracket w-5 text-center text-red-400 group-hover:text-red-500"></i>
                <span class="ml-4 text-sm font-medium">Logout</span>
            </button>
        </form>
    </div>
</aside>

<script>
    const navLinks = document.querySelectorAll('.nav-link');
    const currentPath = window.location.pathname;

    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if (currentPath === linkPath || currentPath.startsWith(linkPath + '/')) {
            link.classList.add('bg-red-600', 'text-white', 'shadow-md');
            const icon = link.querySelector('i');
            if (icon) icon.classList.add('text-white');
        }
    });
</script>
