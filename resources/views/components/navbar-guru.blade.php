<nav class="fixed w-full top-0 z-50 bg-gray-800 text-white p-3 flex justify-between items-center shadow-md">
    <button class="md:hidden text-white" onclick="document.querySelector('aside').classList.toggle('hidden')">
        ☰
    </button>
    <h1 class="text-lg font-semibold">Admin Panel</h1>
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
            <span class="hidden md:block text-sm">Admin</span>
            <img src="https://via.placeholder.com/32" alt="Admin Profile" class="w-8 h-8 rounded-full border-2 border-white">
        </button>
        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white text-gray-800 shadow-lg rounded-lg hidden md:block">
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-200">Settings</a>
            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-200">Logout</a>
        </div>
    </div>
</nav>