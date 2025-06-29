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
            @auth
                <x-nav-link-siswa href="/siswa/kelas?fitur=materi" :active="request()->is('/siswa/kelas?fitur=materi')">Materi</x-nav-link-siswa>
                {{-- <x-nav-link-siswa href="/siswa/pjbl" :active="request()->is('siswa/pjbl')">Project Based Learning</x-nav-link-siswa> --}}
                <x-nav-link-siswa href="/siswa/kelas?fitur=pjbl" :active="request()->is('/siswa/kelas?fitur=pjbl')">Project Based Learning</x-nav-link-siswa>
                <x-nav-link-siswa href="/siswa/kelas?fitur=kuis" :active="request()->is('/siswa/kelas?fitur=kuis')">Kuis</x-nav-link-siswa>
            @endauth

            @auth
                <div class="relative" x-data="{ isOpen: false }">
                    <button @click="isOpen = !isOpen" class="relative flex items-center text-sm focus:outline-none">
                        <!-- Foto Profil -->
                        <img class="w-8 h-8 rounded-full" src="{{ asset('img/' . (Auth::user()->foto ?? 'profile.png')) }}" alt="Profile Picture">
                    
                        <!-- Nama Pengguna -->
                        <h1 class="ml-2 bg-gray-800 text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                            {{ auth()->user()->nama }}
                        </h1>
                    </button>
                    
                    <div x-show="isOpen" x-transition class="absolute right-0 mt-2 w-48 rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5">
                        <a href="#" class="block px-3 py-2 text-gray-800 hover:bg-gray-700 hover:text-white">Edit Profile</a>
                        <form action="/logout" method="POST">
                            @csrf
                            <div>
                                <button type="submit" class="w-full h-full text-left block px-3 py-2 text-gray-800 hover:bg-gray-700 hover:text-white">
                                    Logout
                                </button>
                            </div>
                        </form>
                        {{-- <a href="#" class="block px-3 py-2 text-gray-800 hover:bg-gray-700 hover:text-white">Logout</a> --}}
                    </div>
                </div>
                
                @endauth       
                @guest
                    <div class="flex space-x-2">
                        <a href="/login" class="bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Login</a>
                        <a href="/register" class="bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Register</a>
                    </div>
                @endguest
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
        <a href="/siswa/pjbl/kelompok" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Project Based Learning</a>
        <a href="/siswa/kuis" class="block px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Kuis</a>
    </div>

    <div class="border-t border-gray-700 pt-4 pb-3 px-2">
        @auth
        <!-- Profil dan Logout -->
        <div class="flex items-center space-x-3 px-3">
            <img class="w-8 h-8 rounded-full" src="{{ asset('img/' . (Auth::user()->foto ?? 'profile.png')) }}" alt="Foto Profil">
            <div class="text-white font-medium">{{ Auth::user()->nama }}</div>
        </div>
        <div class="mt-3 space-y-1">
            <a href="#" class="block px-3 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">Edit Profile</a>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">Logout</button>
            </form>
        </div>
        @endauth

        @guest
        <!-- Login dan Register -->
        <div class="space-y-1">
            <a href="/login" class="block w-full bg-blue-600 text-white text-center py-2 rounded-md hover:bg-blue-700">Login</a>
            <a href="/register" class="block w-full bg-blue-600 text-white text-center py-2 rounded-md hover:bg-blue-700">Register</a>
        </div>
        @endguest
    </div>
</div>

</nav>
