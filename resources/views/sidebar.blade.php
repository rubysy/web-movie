<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-black bg-opacity-90 text-white z-50 transform -translate-x-full transition-transform duration-300">
    <div class="p-4 flex justify-between items-center">
        <h2 class="text-2xl font-bold">Menu</h2>
        <button id="close-sidebar" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <ul class="mt-4">
            <li class="p-4 border-b border-gray-700">
                <span class="block font-bold">{{ Auth::user()->name }}</span>
                <span class="block text-sm text-gray-400">{{ Auth::user()->email }}</span>
            </li>
            <li class="p-4 border-b border-gray-700 hover:bg-gray-800">
        <a href="/home" class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Home
        </a>
            </li>
            <li class="p-4 border-b border-gray-700 hover:bg-gray-800">
                <a href="/movies" class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                    </svg>
                    Movies
                </a>
            </li>
            <li class="p-4 border-b border-gray-700 hover:bg-gray-800">
                <a href="/tv-shows" class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    TV Shows
                </a>
            </li>
            <li class="p-4 border-b border-gray-700 hover:bg-gray-800">
                <a href="{{ route('watchlist.index') }}" class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    Watchlist
                </a>
            </li>
            <li class="p-4 border-b border-gray-700 hover:bg-gray-800">
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" onclick="confirmLogout()" class="w-full text-left text-develobe-10 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            Logout
        </button>
                </form>
            </li>

            <li class="p-4 border-b border-gray-700 hover:bg-gray-800">
                <form id="delete-account-form" method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="confirmDeleteAccount()" class="w-full text-left text-red-500 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Akun
                    </button>
                </form>
            </li>
    </ul>
</div>

<!-- Header dengan Hamburger Icon -->
<header class="w-full bg-black text-white p-4 flex items-center">
    <button id="hamburger" class="mr-4 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>
    <a href="/home" class="text-lg text-develobe-400 font-bold">{{ Auth::user()->name }}</a>
</header>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const sidebar = document.getElementById("sidebar");
    const hamburger = document.getElementById("hamburger");
    const closeSidebar = document.getElementById("close-sidebar");

    // Toggle sidebar open/close
    hamburger.addEventListener("click", () => {
        sidebar.classList.toggle("-translate-x-full");
    });

    // Close sidebar when clicking the close icon
    closeSidebar.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
    });

    function confirmLogout() {
    Swal.fire({
        title: 'Yakin mau logout?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#d20000',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Iya yakin',
        cancelButtonText: 'Batalin',
        background: '#1a1a1a',
        color: '#fff',
        iconColor: '#3085d6'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}

    function confirmDeleteAccount() {
        Swal.fire({
            title: 'Yakin ingin menghapus akun?',
            text: 'Tindakan ini tidak dapat dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d20000',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batalin',
            background: '#1a1a1a',
            color: '#fff',
            iconColor: '#d20000'
        });
    }

</script>
