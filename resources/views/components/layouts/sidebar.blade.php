<aside id="sidebar"
    class="w-64 bg-[#2D2D30] border-r border-[#3C3C3F] text-[#E5E5E5] flex flex-col transition-[width] duration-300 ease-in-out overflow-hidden relative shadow-[4px_0_24px_rgba(0,0,0,0.02)]">

    <div id="sidebar-header"
        class="mb-10 flex flex-row items-center justify-between px-4 py-6 border-b border-[#3C3C3F] transition-all duration-300 min-h-[80px]">

        <div id="sidebar-logo-container" class="flex flex-col items-center justify-center w-full h-full space-y-2">
            <div class="flex items-center space-x-3">
                <img src="/images/images.png" alt="Logo" class="w-10 h-10 flex-shrink-0 object-contain">
                <span
                    class="sidebar-text text-2xl font-bold text-[#E5E5E5] whitespace-nowrap transition-opacity duration-300">
                    REECH CRM
                </span>
            </div>


        </div>

    </div>

    <nav class="flex-1 px-2 py-4 space-y-2">
        <a href="/dashboard"
            class="nav-link group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-[#3C3C3F] hover:text-[#F56565]">
            <i
                class="fa-solid fa-tachometer-alt w-6 text-center text-xl transition-colors duration-300 group-hover:text-[#F56565]"></i>
            <span
                class="sidebar-text ml-3 font-medium whitespace-nowrap transition-opacity duration-300">Dashboard</span>
        </a>

        <a href="/departments"
            class="nav-link group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-[#3C3C3F] hover:text-[#F56565]">
            <i
                class="fa-solid fa-briefcase w-6 text-center text-xl transition-colors duration-300 group-hover:text-[#F56565]"></i>
            <span
                class="sidebar-text ml-3 font-medium whitespace-nowrap transition-opacity duration-300">Departments</span>
        </a>

        <a href="/reports"
            class="nav-link group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-[#3C3C3F] hover:text-[#F56565]">
            <i
                class="fa-solid fa-chart-line w-6 text-center text-xl transition-colors duration-300 group-hover:text-[#F56565]"></i>
            <span class="sidebar-text ml-3 font-medium whitespace-nowrap transition-opacity duration-300">Reports</span>
        </a>

        <a href="/profile"
            class="nav-link group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-[#3C3C3F] hover:text-[#F56565]">
            <i
                class="fa-solid fa-user w-6 text-center text-xl transition-colors duration-300 group-hover:text-[#F56565]"></i>
            <span class="sidebar-text ml-3 font-medium whitespace-nowrap transition-opacity duration-300">Profile</span>
        </a>

        <a href="/settings"
            class="nav-link group flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-[#3C3C3F] hover:text-[#F56565]">
            <i
                class="fa-solid fa-cog w-6 text-center text-xl transition-colors duration-300 group-hover:text-[#F56565]"></i>
            <span
                class="sidebar-text ml-3 font-medium whitespace-nowrap transition-opacity duration-300">Settings</span>
        </a>
    </nav>

    <div class="px-4 py-4 border-t border-[#3C3C3F]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-4 py-3 rounded-xl transition-all duration-300 hover:bg-[#3C3C3F] hover:text-[#F56565] group">
                <i class="fa-solid fa-right-from-bracket w-6 text-center text-xl"></i>
                <span
                    class="sidebar-text ml-3 font-medium whitespace-nowrap transition-opacity duration-300">Logout</span>
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
            link.classList.add('bg-[#B02A30]', 'text-white', 'shadow-md');
            link.querySelector('i')?.classList.add('text-white');
            link.classList.remove('hover:bg-[#3C3C3F]', 'hover:text-[#F56565]');
        }
    });
</script>
