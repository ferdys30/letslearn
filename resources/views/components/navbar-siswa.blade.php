<nav class="bg-gray-800" x-data="{ isOpen: false, isLoggedIn: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <div class="shrink-0">
                <img class="size-8" src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
            </div>

            <!-- Menu + Login (Mepet Kanan) -->
            <div class="hidden md:flex items-center ml-auto space-x-4">
                <x-nav-link-siswa href="/" :active="request()->is('/')">Home</x-nav-link-siswa>
                <x-nav-link-siswa href="/siswa/materi" :active="request()->is('siswa/materi')">Materi</x-nav-link-siswa>
                {{-- <x-nav-link-siswa href="/siswa/pjbl" :active="request()->is('siswa/pjbl')">Project Based Learning</x-nav-link-siswa> --}}
                <x-nav-link-siswa href="/siswa/pjbl/kelompok" :active="request()->is('siswa/pjbl')">Project Based Learning</x-nav-link-siswa>
                <x-nav-link-siswa href="/siswa/kuis" :active="request()->is('siswa/kuis')">Kuis</x-nav-link-siswa>

                <!-- Login/Register -->
                <template x-if="!isLoggedIn">
                    <div class="flex space-x-2">
                        <button @click="isLoggedIn = true" class="bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Login</button>
                        <button class="bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Register</button>
                    </div>
                </template>

                <!-- Jika sudah login, tampilkan Profile -->
                <template x-if="isLoggedIn">
                    <div class="relative">
                        <button @click="isOpen = !isOpen" class="relative flex items-center text-sm focus:outline-none">
                            <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>
                        <div x-show="isOpen" x-transition class="absolute right-0 mt-2 w-48 rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700">Edit Profile</a>
                            <a href="#" @click="isLoggedIn = false" class="block px-4 py-2 text-sm text-gray-700">Logout</a>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="isOpen = !isOpen" class="text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                    <svg x-show="!isOpen" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="isOpen" class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="isOpen" x-transition class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Home</a>
            <a href="/siswa/materi" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Materi</a>
            {{-- <a href="/siswa/pjbl" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Project Based Learning</a> --}}
            <a href="/siswa/pjbl/kelompok" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Project Based Learning</a>
            <a href="/siswa/kuis" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Kuis</a>
        </div>
        <div class="border-t border-gray-700 pt-4 pb-3 px-2">
            <template x-if="!isLoggedIn">
                <div class="space-y-1">
                    <button @click="isLoggedIn = true" class="block w-full bg-blue-600 text-white text-center py-2 rounded-md hover:bg-blue-700">Login</button>
                    <button class="block w-full bg-blue-600 text-white text-center py-2 rounded-md hover:bg-blue-700">Register</button>
                </div>
            </template>
            <template x-if="isLoggedIn">
                <div class="space-y-1">
                    <a href="#" class="block px-3 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">Edit Profile</a>
                    <a href="#" @click="isLoggedIn = false" class="block px-3 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">Logout</a>
                </div>
            </template>
        </div>
    </div>
</nav>
